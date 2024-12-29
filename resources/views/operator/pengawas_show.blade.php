@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td width="15%">ID</td>
                                <td>: {{ $model->id }}</td>
                            </tr>
                            <tr>
                                <td>NAMA</td>
                                <td>: {{ $model->name }}</td>
                            </tr>
                            <tr>
                                <td>NO. HP</td>
                                <td>: {{ $model->nohp }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ $model->email }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL BUAT</td>
                                <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL UBAH</td>
                                <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </thead>
                    </table>
                    <h5 class="my-4">TAMBAH DATA MANDOR</h5>
                    {!! Form::open(['route' => 'pengawasmandor.store', 'method' => 'POST']) !!}
                    {!! Form::hidden('pengawas_id', $model->id, []) !!}
                    <div class="form-group">
                        <label for="mandor_id">Pilih Data Mandor</label>
                        {!! Form::select('mandor_id', $mandor, null, ['class' => 'form-control select2']) !!}
                        <span class="text-danger" >{{ $errors->first('mandor_id') }}</span>
                    </div>
                    {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary my-2']) !!}
                    {!! Form::close() !!}
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mandor</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model->mandor as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>
                                        {!! Form::open([
                                            'route' => ['pengawasmandor.update', $item->id],
                                            'method' => 'PUT',
                                            'onsubmit' => 'return confirm("yakin ingin menghapus data ini?")',
                                        ]) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection