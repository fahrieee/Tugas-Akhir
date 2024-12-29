<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($id)
    {
        if (Auth::user()->akses == 'pengawas') {
            $tagihan = Tagihan::pengawasMandor()->findOrFail($id);
        } else {
            $tagihan = Tagihan::findOrFail($id);
        }
        
        $title = 'Cetak Invoice Tagihan ' . $tagihan->mandor->nama;
        if (request('output') == 'pdf') {
            $pdf = Pdf::loadView('invoice', compact('tagihan', 'title'));
            $namaFile = "invoice tagihan " . $tagihan->mandor->nama . '.pdf';
            return $pdf->download($namaFile);
        }
        return view('invoice', compact('tagihan', 'title'));
    }   
}
