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
                                <td width="15%">STATUS</td>
                                <td>: 
                                    <span class="badge {{ $model->status == 'aktif' ? 'bg-primary' : 'bg-danger' }}">
                                        {{ $model->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>NAMA MANDOR</td>
                                <td>: {{ $model->nama }}</td>
                            </tr>
                            <tr>
                                <td>KATEGORI</td>
                                <td>: {{ $model->kategori }}</td>
                            </tr>
                            <tr>
                                <td>PERIODE</td>
                                <td>: {{ $model->periode }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL BUAT</td>
                                <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL UBAH</td>
                                <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>DIBUAT OLEH</td>
                                <td>: {{ optional($model->user)->name ?? 'Tidak Ada User' }}</td>
                            </tr>
                            <tr>
                                <td>PENGAWAS</td>
                                <td>: {{ optional($model->pengawas)->name ?? 'Tidak Ada Pengawas' }}</td>
                            </tr>
                        </thead>
                    </table>

                    <h6 class="mt-3">TAGIHAN HUTANG</h6>

                    @if($model->hutang && $model->hutang->children && $model->hutang->children->isNotEmpty())
                        <!-- Tabel Tagihan jika ada children -->
                        <div class="col-md-5">
                            <table class="table table-bordered table-sm">
                                <thead class="table table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Item Tagihan</th>
                                        <th>Jumlah Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->hutang->children as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td class="text-end">{{ formatRupiah($item->jumlah) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2">TOTAL TAGIHAN</td>
                                    <td class="text-end fw-bold">
                                        {{ formatRupiah($model->hutang->children->sum('jumlah')) }}
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <!-- Jika tidak ada children atau null, tampilkan "KOSONG" -->
                        <p>KOSONG</p>
                    @endif

                    <a href="{{ route('status.update', [
                        'model' => 'mandor',
                        'id' => $model->id,
                        'status' => $model->status == 'aktif' ? 'non-aktif' : 'aktif',
                    ]) }}" 
                        class="btn btn-primary btn-sm mt-3" onclick="return confirm('Anda yakin ?')">
                        {{ $model->status == 'aktif' ? 'Non-Aktifkan Mandor ini' : 'Aktifkan mandor ini' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
