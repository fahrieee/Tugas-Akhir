@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">Form Laporan</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Laporan Tagihan</h4>
                            @include('operator.laporanform_tagihan')
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4>Laporan Pembayaran</h4>
                            @include('operator.laporanform_pembayaran')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
