@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary ">Tambah Data</a>
                        </div>
                        <div class="col-md-10">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row justify-content-end gx-2">
                                <div class="col-md-3 col-sm-12">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 
                                    'Cari Tagihan Mandor']) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                   {!! Form::select(
                                    'status', [
                                        '' =>  'Pilih Status',
                                        'lunas' => 'Lunas',
                                        'baru' => 'Baru',
                                        'Angsur' => 'Angsur',
                                   ],
                                    request('status'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 
                                    'Pilih Bulan']) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 
                                    'Pilih Tahun']) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <button class="btn btn-primary" type="submit">Tampil</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            </div>
                    </div>
                </div>
            <div class="table-responsive" style="padding: 20px">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Tagihan</th>
                            <th>Status</th>
                            <th>Total Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mandor->nama }}</td>
                                <td>{{ $item->tanggal_tagihan->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $item->status_style }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>{{ formatRupiah($item->tagihanDetails->sum('jumlah_hutang')) }}</td>
                                <td>
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                                    ]) !!}
                                    
                                    {{--  
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm ml-2 mr-2">Edit</a>
                                    --}}
                                    <a href="{{ route($routePrefix . '.show', [
                                        $item->id,
                                        'mandor_id' => $item->mandor_id,
                                        'bulan' => $item->tanggal_tagihan->format('m'),
                                        'tahun' => $item->tanggal_tagihan->format('Y'),
                                    ]) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                    Detail</a>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>Hapus
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
                <div class="mt-3">
                    {!! $models->links() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
