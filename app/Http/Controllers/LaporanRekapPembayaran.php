<?php

namespace App\Http\Controllers;

use App\Models\Mandor;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanRekapPembayaran extends Controller
{
    public function index(Request $request)
    {
      
        $mandor = Mandor::with('tagihan')->orderBy('nama', 'asc');
        if ($request->filled('kategori_id')) {
            $mandor->where('kategori', $request->kategori_id);
        }
        $mandor = $mandor->get();
        
        foreach ($mandor as $itemMandor){
            $dataTagihan = [];
            $tahun = $request->tahun;
            //Perulangan berdasarkan bulan tagihan
            foreach (bulanHutang() as $bulan) {
                //jika bulan 1 maka tahun ditambah 1  karena tagihan dari bulan novenmber sampai Oktobrt
                if ($bulan == 1) {
                    $tahun++;
                }
                $tagihan = $itemMandor->tagihan->filter(function ($value) use ($bulan, $tahun) {
                    return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
                })->first();
                
           
            $dataTagihan[] = [
                'bulan' =>  ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'status_pembayaran' => ($tagihan == null) ? 'Bulan Bayar' : $tagihan->status,
                'tanggal_lunas' => $tagihan->tanggal_lunas ?? '-',

            ];
        }
        $dataRekap[] = [
            'mandor' => $itemMandor,
            'dataTagihan' => $dataTagihan
        ];

        }
        $data['header'] = bulanHutang();
        $data['dataRekap'] = $dataRekap;
        $data['title'] = "Rekap Tagihan";
        return view('operator.laporanrekappembayaran_index', $data);
    }
}
