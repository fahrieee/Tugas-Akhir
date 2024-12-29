<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pembayaran as Model;
use App\Http\Requests\StorePembayaranRequest;
use App\Models\Tagihan;
use App\Notifications\PembayaranKonfirmasiNotification;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $models = Model::latest();

        if ($request->filled('q')) {
            $models = $models->whereHas('tagihan', function ($q) {
                $q->whereHas('mandor', function ($q) {
                    $q->where('nama', 'like', '%' . request('q') . '%');
                });
            });
        }
        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_tagihan', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_tagihan', $request->tahun);
        }
        if ($request->filled('status')) {
            if ($request->status == 'sudah-konfirmasi') {
                $models = $models->whereNotNull('tanggal_konfirmasi');
            }

            if ($request->status == 'belum-konfirmasi') {
                $models = $models->whereNull('tanggal_konfirmasi');
            }
        }

        $data['models'] = $models->orderBy('tanggal_konfirmasi', 'desc')->paginate(50);
        $data['title'] = 'Data Pembayaran';
        return view('operator.pembayaran_index', $data);
    }

    
    public function store(StorePembayaranRequest $request)
    {
    $requestData = $request->validated();
    //$requestData['status_konfirmasi'] = 'sudah';
    $requestData['tanggal_konfirmasi'] = now();
    $requestData['metode_pembayaran'] = 'manual';
    $tagihan = Tagihan::findOrFail($requestData['tagihan_id']);
    $requestData['pengawas_id'] = $tagihan->mandor->pengawas_id ?? 0;
    //SimpanPembayaran
    $pembayaran = Pembayaran::create($requestData);
    

    $pengawas = $pembayaran->pengawas;
    if ($pengawas != null) {
        $pengawas->notify(new PembayaranKonfirmasiNotification($pembayaran));
    }
    flash('Pembayaran berhasil disimpan');
    return back();
    }

    public function update(Pembayaran $pembayaran)
    {
        //$pembayaran->status_konfirmasi = 'sudah';
        $pengawas = $pembayaran->pengawas;
        $pengawas->notify(new PembayaranKonfirmasiNotification($pembayaran));
        $pembayaran->tanggal_konfirmasi = now();
        $pembayaran->user_id = auth()->user()->id;
        $pembayaran->save();
        flash('Data Pembayaran Berhasil disimpan');
        return back();
    }

    public function show(Pembayaran $pembayaran)
    { 
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('operator.pembayaran_show', [
            'title' => 'Detail Pembayaran',
            'model' => $pembayaran,
            'route' => ['pembayaran.update', $pembayaran->id]
             
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        flash('Data pembayaran berhasil dihapus');
        return back();
    }
}
