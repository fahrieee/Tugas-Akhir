<?php

namespace App\Http\Controllers;

use App\Charts\PembayaranStatusChart;
use App\Charts\TagihanBulananChart;
use App\Charts\TagihanStatusChart;
use App\Models\Mandor;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;


class BerandaOperatorController extends Controller
{
    public function index(
        TagihanBulananChart $tagihanBulananChart,
        TagihanStatusChart $tagihanStatusChart,
        PembayaranStatusChart $pembayaranStatusChart,
    ) 
    {
        $tahun = date('Y');
        $bulan = date('m');
        $data['mandor'] = Mandor::get();
        $pembayaran = Pembayaran::whereYear('tanggal_bayar', $tahun)
            ->whereMonth('tanggal_bayar', $bulan)->get();

        
        $data['totalPembayaran'] = $pembayaran->sum('jumlah_bayar');
        $data['totalMandorSudahBayar'] = $pembayaran->count();

        $tagihan = Tagihan::with('mandor')->whereYear('tanggal_tagihan', $tahun)
            ->whereMonth('tanggal_tagihan', $bulan)->get();
        $tagihanPerKategori = $tagihan->groupBy('mandor.kategori')->sortKeys();

        $tagihanBelumBayar = $tagihan->where('status', '<>', 'lunas');
        $tagihanSudahBayar = $tagihan->where('status', 'lunas');

        $data['tagihanPerKategori'] = $tagihanPerKategori;
        $data['totalTagihan'] = $tagihan->count();
        $data['tagihanBelumBayar'] = $tagihanBelumBayar;
        $data['tagihanSudahBayar'] = $tagihanSudahBayar;

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['bulanTeks'] = ubahNamaBulan($bulan);
        $data['dataPembayaranBelumKonfirmasi'] = Pembayaran::whereNull('tanggal_konfirmasi')->get();

        $data['tagihanChart'] = $tagihanBulananChart->build([
            $tagihanBelumBayar->count(),
            $tagihanSudahBayar->count(),
        ]);


        $labelTagihanStatusChart = ['lunas', 'angsur', 'baru'];
        $dataTagihanStatusChart = [
            $tagihan->where('status', 'lunas')->count(),
            $tagihan->where('status', 'angsur')->count(),
            $tagihan->where('status', 'baru')->count(),
        ];
        $data['tagihanStatusChart'] = $tagihanStatusChart->build($labelTagihanStatusChart, $dataTagihanStatusChart);
        
        $labelTagihanStatusChart=['Sudah Dikonfirmasi', 'Belum Dikonfirmasi'];
        $dataPembayaranSChart = [
            $pembayaran->whereNotNull('tanggal_konfirmasi')->count(),
            $pembayaran->whereNull('tanggal_konfirmasi')->count(),
        ];
        $data['pembayaranStatusChart'] = $pembayaranStatusChart->build($labelTagihanStatusChart, $dataTagihanStatusChart);
        return view('operator.beranda_index', $data);
    }
}
