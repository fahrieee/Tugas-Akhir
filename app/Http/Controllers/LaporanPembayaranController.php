<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::query();
        $title = "";

        // Filter by month
        if ($request->filled('bulan')) {
            $pembayaran = $pembayaran->whereMonth('tanggal_bayar', $request->bulan);
            $title = " Bulan " . ubahNamaBulan($request->bulan);
        }

        // Filter by year
        if ($request->filled('tahun')) {
            $pembayaran = $pembayaran->whereYear('tanggal_bayar', $request->tahun);
            $title = $title . " " . $request->tahun;
        }

        // Filter by status konfirmasi
        if ($request->filled('status_konfirmasi')) {
            $status = $request->status_konfirmasi;
            if ($status == 'sudah') {
                $pembayaran = $pembayaran->whereNotNull('tanggal_konfirmasi');
                $title = $title . " Status Pembayaran: Sudah Dikonfirmasi";
            } elseif ($status == 'belum') {
                $pembayaran = $pembayaran->whereNull('tanggal_konfirmasi');
                $title = $title . " Status Pembayaran: Belum Dikonfirmasi";
            }
        }

        // Filter by metode pembayaran
        if ($request->filled('metode_pembayaran')) {
            $pembayaran = $pembayaran->where('metode_pembayaran', $request->metode_pembayaran);
            $title = $title . " Metode Pembayaran: " . $request->metode_pembayaran;
        }

        // Filter by periode
        if ($request->filled('periode')) {
            $pembayaran = $pembayaran->whereHas('tagihan', function ($q) use ($request) {
                $q->whereHas('mandor', function ($q) use ($request) {
                    $q->where('periode', $request->periode); // Pastikan kolom 'periode' ada
                });
            });
            $title = $title . " Periode " . $request->periode;
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $pembayaran = $pembayaran->whereHas('tagihan', function ($q) use ($request) {
                $q->whereHas('mandor', function ($q) use ($request) {
                    $q->where('kategori', $request->kategori);
                });
            });
            $title = $title . " Kategori " . $request->kategori;
        }

        // Get the data
        $pembayaran = $pembayaran->get();

        // Return the view
        return view('operator.laporanpembayaran_index', compact('pembayaran', 'title'));
    }
}
