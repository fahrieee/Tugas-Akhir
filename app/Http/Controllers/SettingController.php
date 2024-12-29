<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function create()
    {
        return view('operator.setting_form');
    }

    public function store(Request $request)
    {
        $dataSettings = $request->except('_token');
        if ($request->hasFile('pj_ttd')) {
            $request->validate([
                'pj_ttd' => 'required|mimes:jpeg,png,jpg|max:5000'
            ]);
            $dataSettings['pj_ttd'] = $request->file('pj_ttd')->store('public');
        }

        if ($request->hasFile('app_logo')) {
            $request->validate([
                'app_logo' => 'required|mimes:png,jpg,jpeg|max:5000'
            ]);
            $dataSettings['app_logo'] = $request->file('app_logo')->store('public');
        }
        settings()->set($dataSettings);
        flash('Data berhasil disimpan');
        return back();
    }
}
