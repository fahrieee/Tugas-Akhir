<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengawasOperatorController extends Controller
{
    public function index()
    {
        $data['models'] = Auth::user()->mandor;
        return view('pengawas.mandor_index', $data);
    }

    public function show($id)
    {
        $data['title'] = "Detail Data Mandor";
        $data['model'] = \App\Models\Mandor::with('hutang', 'hutang.children')
        ->where('id', $id)
        ->where('pengawas_id', Auth::user()->id)->firstOrFail();
        return view('pengawas.mandor_show', $data);
    }
}
