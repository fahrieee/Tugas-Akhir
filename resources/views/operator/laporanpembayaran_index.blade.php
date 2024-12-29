@extends('layouts.app_sneat_blank')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card"> 
                    <h5 class="card-header"></h5>
                            <table>
                                <tr>
                                    <td width="80" style="padding-left: 20px;">
                                        @if (request('output') =='pdf')
                                            <img src="{{ storage_path() . '/app/' . settings()->get('app_logo') }}" alt="" width="170" height="50">
                                        @else
                                            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="170" height="50">
                                        @endif
                                    </td>
                                    <td style="text-align:left;vertical-align: middle;padding-left: 7px;">
                                        <div style="font-size: 28px;font-weight:bold">{{ settings()->get('app_name', 'My App') }}</div>
                                        <div>{{ settings()->get('app_address') }}</div>
                                    </td>
                                </tr>
                            </table>
                    <hr class="p-0 m-0">
                <div class="table-responsive" style="padding: 20px">
                    <h4>Laporan Pembayaran</h4>
                    Laporan Berdasarkan: {{ $title }}
                    <table class="table table-bordered">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th width="15%">Nama</th>
                                <td>Kategori Mandor</td>
                                <th>Tanggal Bayar</th>
                                <td>Tanggal Konfirmasi</td>
                                <th>Metode Pembayaran</th>
                                <th>Status Konfirmasi</th>
                                <th>Jumlah Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembayaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tagihan->mandor->nama }}</td>
                                    <td>{{ $item->tagihan->mandor->kategori }}</td> 
                                    <td>{{ optional($item->tanggal_bayar)->translatedFormat(config('app.format_tanggal')) }}</td>
                                    <td>{{ optional($item->tanggal_konfirmasi)->translatedFormat(config('app.format_tanggal')) }}</td>
                                    <td>{{ $item->metode_pembayaran }}</td>
                                    <td>{{ $item->status_konfirmasi }}</td>
                                    <td>{{ formatRupiah($item->jumlah_bayar) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Data Tidak Ada</td>
                                </tr> 
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
