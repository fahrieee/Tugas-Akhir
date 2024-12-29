<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;

class PengawasController extends Controller
{
    private $viewIndex = 'pengawas_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'pengawas_show';
    private $routePrefix = 'pengawas';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('q');  // Mengambil input pencarian

        // Menggunakan fungsi search() yang sudah didefinisikan di model
        $models = Model::pengawas()
                       ->search($searchTerm) // Memanggil scope search
                       ->latest()
                       ->paginate(settings()->get('app_pagination', 50));

        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Pengawas'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Pengawas'
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'password' => 'required',
            
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['akses'] = 'pengawas';
        Model::create($requestData);
        flash('Data Berhasil Disimpan');
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
        return view('operator.' . $this->viewShow, [
            'mandor' => \App\Models\Mandor::whereNotIn('pengawas_id', [$id])->pluck('nama', 'id'),
            'model' => Model::pengawas()->where('id', $id)->firstOrFail(),
            'title' => 'DETAIL DATA PENGAWAS'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Edit Form Data User'
        ];
        return view('operator.' . $this->viewEdit, $data);
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
       $requestData = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,' . $id,
        'nohp' => 'required|unique:users,nohp,' . $id,
        'password' => 'nullable'
       ]);
       $model = Model::findOrFail($id);
       if ($requestData['password'] == "") {
        unset($requestData['password']);
       } else {
        $requestData['password'] = bcrypt($requestData['password']);
       }
       $model->fill($requestData);
       $model->save();
       flash('Data Berhasil disimpan');
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
        $model = Model::where('akses', 'pengawas')->findOrFail($id);
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
