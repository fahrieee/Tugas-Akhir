<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankPerusahaan;
use App\Models\Pembayaran;
use App\Models\PengawasBank;
use App\Models\Tagihan;
use App\Models\User;
use App\Notifications\PembayaranNotification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Notification;
use PhpParser\Node\Stmt\TryCatch;

class PengawasPembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::where('pengawas_id', auth()->user()->id)
            ->latest()
            ->orderBy('tanggal_konfirmasi', 'desc')
            ->paginate(50);
        $data['models'] = $pembayaran;
        return view('pengawas.pembayaran_index', $data);
    }

    public function show(Pembayaran $pembayaran)
    { 
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('pengawas.pembayaran_show', [
            'model' => $pembayaran,
        ]);
    }

    public function create(Request $request)
    {
        $data['listPengawasBank'] = PengawasBank::where('pengawas_id', Auth::user()->id)->get()->pluck('nama_bank_full', 'id');
        $data['tagihan'] = Tagihan::pengawasMandor()->findOrFail($request->tagihan_id);
        $data['model'] = new Pembayaran();
        $data['method'] = 'POST';
        $data['route'] = 'pengawas.pembayaran.store';
        $data['listBankPerusahaan'] = BankPerusahaan::pluck('nama_bank', 'id');
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        if ($request->bank_perusahaan_id != ''){
            $data['bankYangDipilih'] = BankPerusahaan::findOrFail($request->bank_perusahaan_id);
        }
        $data['url'] = route('pengawas.pembayaran.create', [
            'tagihan_id' => $request->tagihan_id,
        ]);
        return view('pengawas.pembayaran_form', $data);
    }

    public function store(Request $request)
    {
        if ($request->pengawas_bank_id == '' && $request->nomor_rekening == '') {
            flash()->addError('Silahkan pilih nama bank pengirim');
            return back();
        }

        if($request->nama_rekening != '' && $request->nomor_rekening != ''){
            //Pengawas membuat rekening baru
            $bankId = $request->bank_id;
            $bank = Bank::findOrFail($bankId);
            if ($request->filled('simpan_data_rekening')) {
                $requestDataBank = $request->validate([
                    'nama_rekening' => 'required',
                    'nomor_rekening' => 'required',
                ]);
                $pengawasBank = PengawasBank::firstOrCreate(
                    $requestDataBank,
                    [
                        'nama_rekening' => $requestDataBank['nama_rekening'],
                        'pengawas_id' => Auth::user()->id,
                        'kode' => $bank->sandi_bank,
                        'nama_bank' => $bank->nama_bank,

                    ]
                );
            }
        } else {
            $pengawasBankId = $request->pengawas_bank_id;
            $pengawasBank = PengawasBank::findOrFail($pengawasBankId);
        }

        $jumlahBayar = str_replace('.', '', $request->jumlah_bayar);

        $validasiPembayaran = Pembayaran::where('jumlah_bayar', $jumlahBayar)
            ->where('tagihan_id', $request->tagihan_id)
            ->first();
        if ($validasiPembayaran != null) {
            flash('Data Pembayaran ini sudah ada dan akan segera dikonfirmasi oleh Operator');
            return back();
        }

        //Validasi input
        $request->validate([
            'tanggal_bayar' => 'required',
            'jumlah_bayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png,pdf|max:5048',
        ]);

        

    // Simpan file bukti bayar
    $buktiBayar = $request->file('bukti_bayar')->store('public');
    // Siapkan data pembayaran
    $dataPembayaran = [
        'bank_perusahaan_id' => $request->bank_perusahaan_id,
        'pengawas_bank_id' => $pengawasBank->id,
        'tagihan_id' => $request->tagihan_id,
        'pengawas_id' => auth()->user()->id,
        'tanggal_bayar' => $request->tanggal_bayar . ' ' . date('H:i:s'),
        'jumlah_bayar' => $jumlahBayar,
        'bukti_bayar' => $buktiBayar,
        'metode_pembayaran' => 'transfer',
        'user_id' => 0,
    ];
    $tagihan = Tagihan::findOrFail($request->tagihan_id);
    if ($jumlahBayar >= $tagihan->total_tagihan) {
    DB::beginTransaction();
    try {

        // Simpan data pembayaran ke database
        //$pembayaran = Pembayaran::create($dataPembayaran);
        $pembayaran = new Pembayaran();
        $pembayaran->fill($dataPembayaran);
        $pembayaran->saveQuietly();

        $userOperator = User::where('akses', 'operator')->get();
        Notification::send($userOperator, new PembayaranNotification($pembayaran));
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        flash()->addError('Gagal menyimpan data pembayaran, ' . $th->getMessage());
        return back();
    }
    } else {
        flash()->addError('Jumlah Pembayaran tidak boleh kurang dari total tagihan');
        return back();
    }

    // Berikan pesan sukses
    flash('Pembayaran Berhasil disimpan dan akan segera dikonfirmasi oleh Operator');
    return redirect()->route('pengawas.pembayaran.show', $pembayaran->id);
    
}


    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->tanggal_konfirmasi != null) {
            flash()->addError('Data pembayaran ini sudah dikonfirmasi, tidak bisa dihapus');
            return back();
        }
        \Storage::delete($pembayaran->bukti_pembayaran);
        $pembayaran->delete();
        flash('Data pembayaran berhasil dihapus');
        return redirect()->route('pengawas.pembayaran.index');
    }
}
