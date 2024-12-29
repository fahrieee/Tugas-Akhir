@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Cari Nama" aria-label="cari nama"
                                aria-describedby="button-addon2" value="{{ request('q') }}">
                            <button type="submit" class="btn btn-outline-primary" id="button-addon2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th width="37%">Nama Hutang</th>
                                <th>Total Hutang</th>
                                <th>Dibuat Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ formatRupiah($item->total_tagihan) }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("yakin ingin menghapus data ini?")',
                                    ]) !!}

                                    <a  href="{{ route($routePrefix . '.create', [
                                        'biaya_id' => $item->id
                                        ]) }}" 
                                        class="btn btn-info btn-sm mx-1">
                                        <i class="fa fa-edit"></i>
                                        Items
                                    </a>
                                    <a  href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                        class="btn btn-warning btn-sm ml-2 mr-2">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>Hapus
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                               <tr>
                                    <td colspan="4"> Data Tidak Ada<td>
                               </tr> 
                            @endforelse
                        <tbody>
                    </table>
                    {!! $models->links() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
