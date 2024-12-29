<?php

namespace App\Http\Controllers;

use App\Models\BankPerusahaan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengawasTagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::pengawasMandor()->latest();
        if (request()->filled('q')) {
            $tagihan = $tagihan->search(request('q'));
        }

        $data['tagihan'] = $tagihan->get();
        return view('pengawas.tagihan_index', $data);
    }

    public function show($id)
    {
        $tagihan = Tagihan::pengawasMandor()->findOrFail($id);
        if ($tagihan->status == 'lunas') {
            $pembayaranId = $tagihan->pembayaran->last()->id;
            return redirect()->route('pengawas.pembayaran.show', $pembayaranId);
        }
        $data['bankPerusahaan'] = BankPerusahaan::all();
        $data['tagihan'] = $tagihan;
        $data['mandor'] = $tagihan->mandor;
        return view('pengawas.tagihan_show', $data);
    }
}
