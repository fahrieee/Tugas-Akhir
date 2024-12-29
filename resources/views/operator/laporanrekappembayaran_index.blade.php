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
                    <div class="table-responsive mt-3">
                       <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mandor</th>
                                        @foreach ($header as $bulan)
                                            <th>{{ ubahNamaBulan($bulan) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRekap as $item )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['mandor']['nama'] }}</td>
                                            @foreach ($item['dataTagihan'] as $itemTagihan )
                                                <td class="text-center">
                                                    @if($itemTagihan['tanggal_lunas'] != '-')
                                                        {{ optional($itemTagihan['tanggal_lunas'])->format('d') }}/
                                                        {{ optional($itemTagihan['tanggal_lunas'])->format('m') }}
                                                        <div>
                                                            {{ optional($itemTagihan['tanggal_lunas'])->format('Y') }}
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
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
