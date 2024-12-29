<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMandorRequest;
use App\Http\Requests\UpdateMandorRequest;
use App\Models\Hutang;
use Illuminate\Http\Request;
use \App\Models\Mandor as Model;
use App\Models\User;


class MandorController extends Controller
{
    private $viewIndex = 'mandor_index';
    private $viewCreate = 'mandor_form';
    private $viewEdit = 'mandor_form';
    private $viewShow = 'mandor_show';
    private $routePrefix = 'mandor';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Model::with('pengawas', 'user')->latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q);
        }
        return view('operator.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Mandor'
        ]);
    }

    public function create()
    {
        $data = [
            'listHutang' => Hutang::has('children')->whereNull('biaya_id')->pluck('nama', 'id'),
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Mandor',
            'pengawas' => User::where('akses', 'pengawas')->pluck('name', 'id')
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    public function store(StoreMandorRequest $request)
    {
        $requestData = $request->validated();

        if ($request->filled('pengawas_id')){
            $requestData['pengawas_status'] = 'ok';
        }

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
        return view ('operator.' . $this->viewShow, [
            'model' => Model::findOrFail($id),
            'title' => 'Detail Data Mandor'
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
            'listHutang' => Hutang::has('children')->whereNull('biaya_id')->pluck('nama', 'id'),
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Edit Data Mandor',
            'pengawas' => User::where('akses', 'pengawas')->pluck('name', 'id')
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
    public function update(UpdateMandorRequest $request, $id)
    {
        $requestData = $request->validated();

        $model = Model::findOrFail($id);
        $requestData['pengawas_status'] = 'ok';

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
    // Ambil data mandor berdasarkan ID
    $mandor = Model::findOrFail($id);

    // Cek apakah mandor memiliki tagihan yang terkait dan masih ada tagihan
    if ($mandor->tagihan()->exists()) {
        // Jika ada tagihan, tampilkan pesan error
        flash()->addError('Data tidak bisa dihapus karena masih memiliki tagihan');
        return back();
    }

    // Jika tidak ada tagihan, hapus data mandor
    $mandor->delete();

    // Kirim pesan sukses setelah penghapusan
    flash('Data berhasil dihapus');
    return back();
}
    
}
