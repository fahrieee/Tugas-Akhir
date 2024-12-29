<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class PengawasProfilController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => \App\Models\User::findOrFail(Auth::user()->id),
            'method' => 'POST',
            'route' => 'pengawas.profil.store',
            'button' => 'UBAH',
            'title' => 'Form Data Profil'
        ];
        return view('profil_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,nohp,' . $id,
            'password' => 'nullable'
           ]);
           $model = \App\Models\User::findOrFail($id);
           if ($requestData['password'] == "") {
            unset($requestData['password']);
           } else {
            $requestData['password'] = bcrypt($requestData['password']);
           }
           $model->fill($requestData);
           $model->save();
           flash('Data Berhasil diubah');
           return back();
           
    }

}
