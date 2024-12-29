<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHutangRequest;
use App\Models\Hutang as Model;
use App\Http\Requests\UpdateHutangRequest;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    private $viewIndex = 'hutang_index';
    private $viewCreate = 'hutang_form';
    private $viewEdit = 'hutang_form';
    private $viewShow = 'hutang_show';
    private $routePrefix = 'hutang';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            // Jika ada query pencarian
            $models = Model::with('user')
                            ->whereNull('biaya_id') // Menyaring berdasarkan biaya_id null
                            ->search($request->q) // Memanggil method search() yang telah ditambahkan
                            ->paginate(settings()->get('app_pagination', '50'));
        } else {
            // Jika tidak ada query pencarian, ambil data terbaru
            $models = Model::with('user')
                            ->whereNull('biaya_id')
                            ->latest()
                            ->paginate(settings()->get('app_pagination', '50'));
        }
    
        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Hutang'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hutang = new Model();
        if ($request->filled('biaya_id')) {
            $hutang = Model::with('children')->findOrFail($request->biaya_id);
        }
        $data = [
            'biayaData' => $hutang,
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Hutang',
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHutangRequest $request)
    {
        Model::create($request->validated());
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
            'model' => Model::findOrFail($id),
            'title' => 'Detail Mandor'
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
            'title' => 'Edit Data Hutang',
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
    public function update(UpdateHutangRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data Berhasil Disimpan');
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
    $model = Model::findOrFail($id);

    if (optional($model->children)->count() >= 1) {
        flash()->addError('Data tidak bisa dihapus karena masih memiliki item biaya, Hapus item biaya terlebih dahulu');
        return back();
    }

    if (optional($model->mandor)->count() >= 1) {
        flash()->addError('Data tidak bisa dihapus karena masih memiliki relasi ke data mandor');
        return back();
    }

    $model->delete();
    flash('Data berhasil dihapus');
    return back();
}

    public function deleteItem($id)
    {
        $model = Model::findOrFail($id);
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
