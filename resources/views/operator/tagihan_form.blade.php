@extends('layouts.app_sneat')

@section('js')
    <script>
        $(document).ready(function() {
            // Menyembunyikan spinner dan overlay saat halaman pertama kali dimuat
            $("#loading-spinner").hide();
        });
    </script>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <!-- Menampilkan pesan alert jika ada -->
                    <div id="alert-message" class="alert d-none" role="alert"></div>
                    
                    <!-- Formulir input data -->
                    {!! Form::model($model, [
                        'route' => $route, 
                        'method' => $method,
                        'id' => 'form-ajax']) !!}
                    
                    <div class="form-group">
                        <label for="mandor_id">Pilih Mandor</label>
                        {!! Form::select('mandor_id', $mandorList, null, [
                            'class' => 'form-control select2',
                            'placeholder' => 'Pilih Mandor']) !!}
                        <span class="text-danger">{{ $errors->first('mandor_id') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-') . '01', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_tagihan') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo ?? date('Y-m-') . '10', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>
                    
                    <!-- Tombol kirim -->
                    <button class="btn btn-primary mt-3" type="submit">
                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ $button }}
                    </button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
