@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card"> 
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                <div class="form-group mt-3">
                    <label for="pengawas">Pengawas</label>
                    {!! Form::select('pengawas_id', $pengawas, null, ['class' => 'form-control select2', 'placeholder' => 'Pilih pengawas']) !!}
                    <span class="text-danger">{{ $errors->first('pengawas_id') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="hutang_id">Hutang</label>
                    {!! Form::select('hutang_id', $listHutang, null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('hutang_id') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="nama">Nama Mandor</label>
                    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="kategori">Kategori</label>
                    {!! Form::select('kategori', getNamaKategori(), null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="periode">Periode</label>
                    {!! Form::selectRange('periode', 2024, date('Y') + 1, null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('periode') }}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
