<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasMandorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengawas_id' => 'required|exists:users,id',
            'mandor_id' => 'required'
        ]);

        $mandor = \App\Models\Mandor::find($request->mandor_id);
        $mandor->pengawas_id = $request->pengawas_id;
        $mandor->pengawas_status = 'ok';
        $mandor->save();
        $title = 'Data Mandor';
        flash('Data sudah ditambahkan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mandor = \App\Models\Mandor::findOrFail($id);
        $mandor->pengawas_id = null;
        $mandor->save();
        flash('Data sudah dihapus');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
