@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                <a href="{{ route( $routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                <div class="table-responsive mt-3">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th>No</th>
                                <th width="18%">Nama Bank</th>
                                <th width="17%">Kode Transfer</th>
                                <th width="20%">Pemilik Rekening</th>
                                <th width="17%">Nomor Rekening</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords(strtolower($item->nama_bank)) }}</td> <!-- Huruf pertama setiap kata menjadi besar -->
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama_rekening }}</td>
                                <td>{{ $item->nomor_rekening }}</td>
                                <td>
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                                    ]) !!}
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                        class="btn btn-warning btn-sm ">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                    {!! Form::close() !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Data Tidak Ada</td>
                        </tr> 
                    @endforelse
                </tbody>
            </table>
                    <div class="mt-6">
                        {!! $models->links() !!}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
