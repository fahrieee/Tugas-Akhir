@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">DETAIL DATA TAGIHAN MANDOR {{ strtoupper($periode) }}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td width="15%">Nama Mandor</td>
                                <td>: {{ $mandor->nama }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>: {{ $mandor->kategori }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">DATA TAGIHAN {{ strtoupper($periode) }}</h5>
            <div class="card-body">
               @include('operator.tagihan_table_tagihan')
                <a href="{{ route('invoice.show', $tagihan->id) }}" target="_blank"
                    class="btn btn-primary btn-sm mt-1"> 
                    <i class="fa fa-file-pdf"></i>
                    Dowload Invoice
                </a>
            </div>
        </div>
        <div class="card mt-2">
            <h5 class="card-header">DATA PEMBAYARAN</h5>
            <div class="card-body"> 
                @include('operator.tagihan_table_pembayaran')
                <h5>Status Pembayaran: {{ strtoupper($tagihan->status) }}</h5>
                <h5 class="card-header">FORM PEMBAYARAN</h5>
                 @include('operator.tagihan_table_formpembayaran')
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card">
                <h5 class="card-header">KARTU PEMBAYARAN</h5>
                <div  class="card-body">
                    @include('operator.tagihan_table_kartupembayaran')
                    <a href="{{ route('kartupembayaran.index', [
                        'mandor_id' => $mandor->id,
                        'tahun' => request('tahun'),
                    ]) }}" class="btn btn-primary btn-sm mt-1">
                        <i class="fa fa-print"></i> Cetak Kartu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection