<?php

namespace App\Http\Controllers;

use App\Models\Mandor;
use Illuminate\Http\Request;

class BerandaPengawasController extends Controller
{
    public function index()
    {
        $mandor = Mandor::with('tagihan')->where('pengawas_id', auth()->user()->id)
            ->orderBy('nama', 'asc')->get();

        $dataRekap = [];
        foreach ($mandor as $itemMandor) {
            $dataTagihan = [];

            // Mulai dari November 2024 hingga Oktober 2025
            $tahun = 2024;
            $bulan = 11; // Bulan mulai dari November
            $jumlahBulan = 12; // Iterasi untuk 12 bulan ke depan

            for ($i = 0; $i < $jumlahBulan; $i++) {
                // Jika bulan > 12, reset ke 1 dan tambah tahun
                if ($bulan > 12) {
                    $bulan = 1;
                    $tahun++;
                }

                $tagihan = $itemMandor->tagihan->filter(function ($value) use ($bulan, $tahun) {
                    return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
                })->first();

                // Menentukan status pembayaran
                $statusBayarTeks = "baru";
                if ($tagihan == null) {
                    $statusBayarTeks = "-";
                } elseif ($tagihan->status != '') {
                    $statusBayarTeks = $tagihan->status;
                    $pembayaran = $tagihan->pembayaran->whereNull('tanggal_konfirmasi');
                    if ($pembayaran->count() >= 1) {
                        $statusBayarTeks = "belum dikonfirmasi";
                    }
                }

                $dataTagihan[] = [
                    'bulan' => ubahNamaBulan($bulan),
                    'tahun' => $tahun,
                    'tagihan' => $tagihan,
                    'tanggal_lunas' => $tagihan?->tanggal_lunas ?? '-',
                    'status_bayar' => $tagihan?->status == 'baru' ? false : true,
                    'status_bayar_teks' => $statusBayarTeks,
                ];

                $bulan++; // Tambahkan bulan
            }

            $dataRekap[] = [
                'mandor' => $itemMandor,
                'dataTagihan' => $dataTagihan,
            ];
        }

        $data['header'] = bulanHutang(); // Header untuk tabel bulan
        $data['dataRekap'] = $dataRekap;

        return view('pengawas.beranda_index', $data);
    }
}
