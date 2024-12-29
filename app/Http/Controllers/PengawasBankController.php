<?php

namespace App\Http\Controllers;

use App\Models\PengawasBank;
use App\Http\Requests\StorePengawasBankRequest;
use App\Http\Requests\UpdatePengawasBankRequest;

class PengawasBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePengawasBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengawasBankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengawasBank  $pengawasBank
     * @return \Illuminate\Http\Response
     */
    public function show(PengawasBank $pengawasBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengawasBank  $pengawasBank
     * @return \Illuminate\Http\Response
     */
    public function edit(PengawasBank $pengawasBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengawasBankRequest  $request
     * @param  \App\Models\PengawasBank  $pengawasBank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengawasBankRequest $request, PengawasBank $pengawasBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengawasBank  $pengawasBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengawasBank $pengawasBank)
    {
        //
    }
}
