@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">DATA PEMBAYARAN</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'pembayaran.index', 'method' => 'GET']) !!}
                            <div class="row gx-2">
                                <div class="col-md-3 col-sm-12">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 
                                    'Cari Tagihan Mandor']) !!}
                                </div>
                                <div class="col-md-3 col-sm-12">
                                   {!! Form::select(
                                    'status', [
                                        '' =>  'Pilih Status',
                                        'sudah-konfirmasi' => 'Sudah Dikonfirmasi',
                                        'belum-konfirmasi' => 'Belum Dikonfirmasi',
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
                            <th >Nama Mandor</th>
                            <th>Tanggal Bayar</th>
                            <th width="8%">Metode Pembayaran</th>
                            <th>Tanggal Konfirmasi</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tagihan->mandor->nama }}</td>
                                <td>{{ optional($item->tanggal_bayar)->translatedFormat('d-m-Y') }}</td>
                                <td>{{ $item->metode_pembayaran }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $item->status_style }}">
                                        
                                        @if  ($item->tanggal_konfirmasi == null)
                                            Belum Dikonfirmasi
                                        @else
                                            {{ $item->tanggal_konfirmasi->format('d-m-Y') }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'route' => ['pembayaran.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                                    ]) !!}
                                  
                                    <a href="{{ route('pembayaran.show', $item->id)}}" 
                                        class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        Detail
                                    </a>
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
                {!! $models->links() !!}
            </div>
        </div>
        </div>
    </div>
@endsection
