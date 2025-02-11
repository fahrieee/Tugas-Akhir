@extends('layouts.app_sneat_pengawas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">DATA PEMABAYARAN</h5>
                <div class="card-body">
                    <div class="col-md-6">
                    {!! Form::open(['route' => 'pengawas.pembayaran.index', 'method' => 'GET']) !!}
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-4 col-sm-12">
                            {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">Tampil</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mandor</th>
                            <th>Tanggal Tagihan</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Konfirmasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tagihan->mandor->nama }}</td>
                                <td>{{ optional($item->tanggal_bayar)->translatedFormat('d-M-Y') }}</td>
                                <td>{{ $item->metode_pembayaran }}</td>
                                <td>{{ $item->status_konfirmasi }}</td>
                                <td>
                                    <a href="{{ route('pengawas.pembayaran.show', $item->id)}}" 
                                        class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Data Tidak Ada</td>
                            </tr> 
                        @endforelse
                    </tbody>
                </table>
                {!! $models->links() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
