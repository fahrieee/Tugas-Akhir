@extends('layouts.app_sneat_pengawas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card"> 
            <h5 class="card-header">Daftar Data Mandor</h5>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th>No</th>
                                <th>Nama Pengawas</th>
                                <th>Nama Mandor</th>
                                <th>Kategori</th>
                                <th>Periode</th>
                                <th>Jumah Hutang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pengawas->name }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->periode }}</td>
                                    <td class="text-end">
                                        
                                        <a href="{{ route('pengawas.mandor.show', $item->id) }}">
                                            {{ formatRupiah($item->hutang->total_tagihan) }}
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </a>
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
