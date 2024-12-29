<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasNotifikasiController extends Controller
{
    public function update(Request $request, $id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->first()?->markAsRead();
        flash('Data sudah diubah.');
        return back();
    }
}
