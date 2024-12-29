@extends('layouts.app_sneat_pengawas')
@section('js')
    <script>
        $(function() {
                $("#checkboxtoggle").click(function() {
                    if ($(this).is(":checked")) {
                        $("#pilihan_bank").fadeOut();
                        $("#form_bank_pengirim").fadeIn();
                    } else {
                        $("#pilihan_bank").fadeIn();
                        $("#form_bank_pengirim").fadeOut();
                    }
                });
            });
        $(document).ready(function() {
            @if (count($listPengawasBank) >= 1)
                $("#form_bank_pengirim").hide();
                //Baru pertama Bayar
            @else
                $("#form_bank_pengirim").show();
            @endif
            $("#pilih_bank").change(function(e) {
                var bankId = $(this).find(":selected").val();
                window.location.href = "{!! $url !!}&bank_perusahaan_id=" + bankId;
            });
        });
    </script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card"> 
            <h5 class="card-header">Kofirmasi Pembayaran</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                {!! Form::hidden('tagihan_id', request('tagihan_id'), []) !!}
                <div class="divider text"> 
                    <h6 class="divider-text m-0 p-0 mt-4 mb-0 pb-0"><i class="fa fa-info-circle"></i> INFORMASI PENGIRIM</h6>
                </div>

                @if (count($listPengawasBank) >= 1)
                <div class="form-group" id="pilihan_bank">
                    <label for="pengawas_bank_id">Nama Bank Pengirim</label>
                    {!! Form::select('pengawas_bank_id', $listPengawasBank, null, [
                        'class' => 'form-control select2',
                        'placeholder' => 'Pilih Nomor Rekekning Pengirim']) !!}
                    <span class="text-danger">{{ $errors->first('pengawas_bank_id') }}</span>
                </div>
                <div class="form-group mt-2">
                    {!! Form::checkbox('pilihan_bank', 1, false, ['class' => 'form-check-input', 
                    'id' => 'checkboxtoggle']) !!}
                    <label class="form-check-label" for="checkboxtoggle">
                        Saya Punya Rekening Baru
                    </label>
                </div>
                @endif
                    <div class="informasi-pengirim" id="form_bank_pengirim">
                        <div class="form-group mt-2">
                            <label for="bank_id">Nama Bank Pengirim</label>
                            {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2']) !!}
                            <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                        </div>
                        <div class="form-group mt-2">
                            <label for="nama_rekening">Nama Pemilik Pengirim</label>
                            {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                        </div>
                        <div class="form-group mt-2">
                            <label for="nomor_rekening">No Rekening</label>
                            {!! Form::text('nomor_rekening', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                        </div>
                        <div class="form-group mt-2">
                            {!! Form::checkbox('simpan_data_rekening', 1, true, ['class' => 'form-control-input', 
                            'id' => 'defaultCheck3']) !!}
                            <label class="form-check-label" for="defaultCheck3">
                                Simpan Data
                            </label>
                        </div>
                    </div>
                <div class="divider text"> 
                    <h6 class="divider-text m-0 p-0 mt-4 mb-0 pb-0"><i class="fa fa-info-circle"></i> INFORMASI TUJUAN</h6>
                </div>
                <div class="informasi-bank-tujuan">
                    <div class="form-group mt-0">
                        <label for="bank_perusahaan_id">Rekening Tujuan Pembayaran</label>
                        {!! Form::select('bank_perusahaan_id', $listBankPerusahaan, request('bank_perusahaan_id'), [
                            'class' => 'form-control',
                            'placeholder' => 'Pilih Bank Tujuan',
                            'id' => 'pilih_bank',
                            ]) !!}
                         <span class="text-danger">{{ $errors->first('bank_perusahaan_id') }}</span>
                    </div>
                    @if (request('bank_perusahaan_id') != '')
                        <div class="alert alert-dark mt-2 mb-2" role="alert">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="30%">Rekening Tujuan</td>
                                        <td>: {{ ucwords(strtolower($bankYangDipilih->nama_bank)) }}</td> <!-- Huruf awal kapital -->
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td>: {{ $bankYangDipilih->nomor_rekening }}</td>
                                    </tr>
                                    <tr>
                                        <td>Atas Nama</td>
                                        <td>: {{ $bankYangDipilih->nama_rekening }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="divider text"> 
                    <h6 class="divider-text m-0 p-0 mt-4 mb-0 pb-0"><i class="fa fa-info-circle"></i> INFORMASI PEMBAYARAN</h6>
                </div>
                <div class="informasi-pengirim">
                <div class="form-group mt-0">
                    <label for="tanggal_bayar">Tanggal Pembayaran</label>
                    {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? date('Y-m-d'),
                    ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="jumlah_bayar">Jumlah Yang Dibayarkan</label>
                    {!! Form::text('jumlah_bayar', $tagihan->tagihanDetails->sum('jumlah_hutang'), 
                    ['class' => 'form-control rupiah']) !!}
                     <span class="text-danger">{{ $errors->first('jumlah_bayar') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="bukti_bayar">Bukti Pembayaran
                        <span class="text-danger">(File harus jpg, jpeg, png, Ukuran file maksimal 5MB)</span>
                    </label>
                    {!! Form::file('bukti_bayar', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('bukti_bayar') }}</span>
                </div>
                {!! Form::submit('SUBMIT', ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
