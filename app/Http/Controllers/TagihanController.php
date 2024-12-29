<?php

namespace App\Http\Controllers;


use App\Models\Tagihan as Model;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Hutang;
use App\Models\Mandor;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Notifications\TagihanNotification;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Notification;

class TagihanController extends Controller
{
    private $viewIndex = 'tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewShow = 'tagihan_show';
    private $routePrefix = 'tagihan';

    public function index(Request $request)
    {
        $models = Model::latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q, null, true);
        }
        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_tagihan', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_tagihan', $request->tahun);
        }
        if ($request->filled('status')) {
            $models = $models->where('status', $request->status);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Tagihan',
        ]);
    }

    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Tagihan',
            'mandorList' => Mandor::pluck('nama', 'id'),
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagihanRequest  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(StoreTagihanRequest $request)
{
    // Validasi dan penggabungan data request dengan informasi user
    $requestData = array_merge($request->validated(), ['user_id' => auth()->user()->id]);
    DB::beginTransaction();

    // Ambil mandor yang aktif
    $mandor = Mandor::currentStatus('aktif')->find($requestData['mandor_id']);
    
    if ($mandor) {
        // Menentukan bulan dan tahun dari tanggal tagihan yang dipilih
        $tanggalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
        $bulanTagihan = $tanggalTagihan->format('m');
        $tahunTagihan = $tanggalTagihan->format('Y');

        // Mengecek apakah sudah ada tagihan untuk mandor ini pada bulan dan tahun yang sama
        $cekTagihan = Model::where('mandor_id', $mandor->id)
            ->whereMonth('tanggal_tagihan', $bulanTagihan)
            ->whereYear('tanggal_tagihan', $tahunTagihan)
            ->first();

        if ($cekTagihan == null) {
            // Membuat tagihan baru
            $requestData['status'] = 'baru'; // Status tagihan masih baru
            $tagihan = Tagihan::create($requestData);

            // Mengirim notifikasi ke pengawas mandor, jika ada
            if ($tagihan->mandor->pengawas != null) {
                Notification::send($tagihan->mandor->pengawas, new TagihanNotification($tagihan));
            }

            // Mengecek apakah hutang ada dan memiliki children
            if (!$mandor->hutang || $mandor->hutang->children->isEmpty()) {
                DB::rollBack(); // Batalkan transaksi
                flash()->addError("Tagihan kosong. Tidak ada detail hutang untuk mandor ini.");
                return back();
            }

            // Menambahkan detail hutang berdasarkan hutang mandor
            $hutang = $mandor->hutang->children;
            foreach ($hutang as $itemHutang) {
                TagihanDetail::create([
                    'tagihan_id' => $tagihan->id,
                    'nama_hutang' => $itemHutang->nama,
                    'jumlah_hutang' => $itemHutang->jumlah,
                ]);
            }

            DB::commit(); // Menyelesaikan transaksi
            flash("Data tagihan berhasil disimpan");
            return redirect()->route($this->routePrefix . '.index');
        } else {
            // Jika tagihan sudah ada, berikan notifikasi
            flash()->addError("Tagihan untuk mandor ini sudah ada untuk bulan dan tahun yang sama.");
            return back();
        }
    } else {
        flash()->addError("Mandor yang dipilih tidak ditemukan atau tidak aktif.");
        return back();
    }
}
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */ 
    public function show(Request $request, $id)
    {
        $mandor = Mandor::with('tagihan')->findOrFail($request->mandor_id);
        $tagihanCollection = $mandor->tagihan->where('id', $id)->first();
        // Ambil tahun awal dari request atau default ke tahun sekarang
        $tahun = $request->tahun ?? now()->year;
        $arrayData = [];

        foreach (bulanHutang() as $bulan) {
            // Jika bulan adalah Januari, tambahkan 1 ke tahun
            if ($bulan == 1 && !empty($arrayData)) {
                $tahun++;
            }
            $tagihan = $mandor->tagihan->filter(function ($value) use ($bulan, $tahun) {
                return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
            })->first();
                
            $tanggalBayar = '';
            if ($tagihan != null && $tagihan->status != 'baru') {
                $tanggalBayar = $tagihan->pembayaran->first()->tanggal_bayar->format('d/m/y');
            }
            $arrayData[] = [
                'bulan' =>  ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'tanggal_bayar' => $tanggalBayar,
            ];
        }
        $data['kartuPembayaran'] = collect($arrayData);
        $data['tagihan'] = $tagihanCollection->where('id', $id)->first();
        $data['mandor'] = $mandor;
        $data['periode'] = Carbon::parse($tagihanCollection->tanggal_tagihan)->translatedFormat('F Y');
        $data['model'] = new Pembayaran();
        return view('operator.' . $this->viewShow, $data);
    }

    
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        if ($tagihan->status == 'lunas') {
            flash("Data tagihan tidak bisa dihapus karena sudah lunas");
            return back();
        }
        TagihanDetail::where('tagihan_id', $id)->delete();
        Tagihan::destroy($id);
        Pembayaran::where('tagihan_id', $id)->delete();
        flash("Data tagihan berhasil dihapus");
        return back();
    }
}
