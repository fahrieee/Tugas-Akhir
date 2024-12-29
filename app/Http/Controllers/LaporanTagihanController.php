<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanTagihanController extends Controller
{
    public function index(Request $request)
    {
        $tagihan = Tagihan::query();
        $title =  "";
        if ($request->filled('bulan')) {
            $tagihan = $tagihan->whereMonth('tanggal_tagihan', $request->bulan);
            $title = $title . " Bulan " . ubahNamaBulan($request->bulan);
        }
        if ($request->filled('tahun')) {
            $tagihan = $tagihan->whereYear('tanggal_tagihan', $request->tahun);
            $title = $title . " " . $request->tahun;
        }
        if ($request->filled('status')) {
            $tagihan = $tagihan->where('status', $request->status);
            $title = $title . " Status Tagihan " . $request->status;
        }
        if ($request->filled('kategori')) {
            $tagihan = $tagihan->whereHas('mandor', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
            $title = $title . " Kategori " . $request->kategori;
        }
        if ($request->filled('periode')) {
            $tagihan = $tagihan->whereHas('mandor', function ($q) use ($request) {
                $q->where('periode', $request->kategori);
            });
            $title = $title . " Periode " . $request->kategori;
        }
        
        $tagihan = $tagihan->get();
        return view('operator.laporantagihan_index', compact('tagihan', 'title'));
    }
}
