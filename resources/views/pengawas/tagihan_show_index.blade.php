@extends('layouts.app_sneat_pengawas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card"> 
            <h5 class="card-header">DATA TAGIHAN HUTANG</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mandor</th>
                                <th>Kategori</th>
                                <th>Tanggal Tagihan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tagihan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mandor->nama }}</td>
                                    <td>{{ $item->mandor->kategori }}</td>
                                    <td>{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</td>
                                    <td>{{ $item->getStatusTagihanPengawas() }}</td>
                                    <td>
                                        @if ($item->status == 'baru' || $item->status == 'angsur')
                                            <a href="{{ route('pengawas.tagihan.show', $item->id) }}" 
                                                class="btn btn-primary">Lakukan Pembayaran</a>
                                        @else
                                            <a href="" class="btn btn-success">Pembayaran Sudah Lunas</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Data Tidak Ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
