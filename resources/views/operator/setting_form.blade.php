@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">PENGATURAN APLIKASI</h5>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'setting.store', 
                        'method' => 'POST',
                        'files' => true
                    ]) !!}
                    <h5>Pengaturan Instansi</h5>
                    <div class="form-group mt-1">
                        <label for="app_logo">Logo Instansi (format:jpg, png, ukuran file maks: 5mb)</label>
                        {!! Form::file('app_logo', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('app_logo') }}</span>
                        <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="100">
                    </div>
                    <div class="form-group mt-1">
                        <label for="app_name">Nama Instansi</label>
                        {!! Form::text('app_name', settings()->get('app_name'), 
                        ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('app_name') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="app_email">Email Instansi</label>
                        {!! Form::text('app_email', settings()->get('app_email'),
                        ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('app_email') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="app_phone">Nomor Telepon Instansi</label>
                        {!! Form::text('app_phone', settings()->get('app_phone'),
                        ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('app_phone') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="app_address">Alamat Instansi</label>
                        {!! Form::textarea('app_address', settings()->get('app_address'), [
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('app_address') }}</span>
                    </div>
                    <hr>
                    <h5>Pengaturan Penanggung Jawab atau Adm Keuangan</h5>
                    <div class="alert alert-info" role="alert">
                        Data Penanggung jawab yang akan diinput di form ini akan tampil di kwitansi, invoice dan kartu pembayaran
                    </div>
                    <div class="form-group mt-3">
                        <label for="pj_nama">Nama Penanggung Jawab (ex:nama Adm.Keuangan)</label>
                        {!! Form::text('pj_nama', settings()->get('pj_nama'),
                        ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('pj_nama') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="pj_jabatan">Nama Jabatan (ex: Adm.Keuangan)</label>
                        {!! Form::text('pj_jabatan', settings()->get('pj_jabatan'),
                        ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('pj_jabatan') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="pj_ttd">Upload Tanda Tangan (format:jph, png, ukuran file maks: 5mb)</label>
                        {!! Form::file('pj_ttd', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('pj_ttd') }}</span>
                        <img src="{{ \Storage::url(settings()->get('pj_ttd')) }}" width="200">
                    </div>
                    <hr>
                    <h5>Pengaturan Aplikasi</h5>
                    <div class="form-group mt-3">
                        <label for="app_pagination">Data Per Halaman</label>
                        {!! Form::number('app_pagination', settings()->get('app_pagination'), 
                        ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('app_pagination') }}</span>
                    </div>
                    {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
