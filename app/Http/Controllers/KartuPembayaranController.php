<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mandor;
use App\Models\Tagihan;
use Auth;
use Illuminate\Http\Request;

class KartuPembayaranController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->akses == 'pengawas') {
            $mandor = Mandor::where('pengawas_id', Auth::user()->id)
                ->where('id', $request->mandor_id)
                ->firstOrFail();
        } else {
            $mandor = Mandor::with('tagihan')->findOrFail($request->mandor_id);
        }

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
                'bulan' => ubahNamaBulan($bulan),
                'tahun' => $tahun, // Tahun dihitung dinamis
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'tanggal_bayar' => $tanggalBayar,
            ];
        }

        if ($request->output == 'pdf') {
            $pdf = Pdf::loadView('kartupembayaran_index', [
                'kartuPembayaran' => collect($arrayData),
                'mandor' => $mandor,
            ]);
            $namaFile = "kartu pembayaran " . $mandor->nama . '.pdf';
            return $pdf->download($namaFile);
        }

        return view('kartupembayaran_index', [
            'kartuPembayaran' => collect($arrayData),
            'mandor' => $mandor,
        ]);
    }
}
