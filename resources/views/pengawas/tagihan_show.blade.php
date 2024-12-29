@extends('layouts.app_sneat_pengawas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card"> 
            <h5 class="card-header">TAGIHAN {{ strtoupper($mandor->nama) }}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Tagihan</th>
                                <th class="text-end">Jumlah Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan->tagihanDetails as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_hutang }}</td>
                                    <td class="text-end">{{ formatRupiah($item->jumlah_hutang) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end fw-bold">Total Pembayaran</td>
                                <td class="text-end fw-bold">
                                    <a href="{{ route('invoice.show', $tagihan->id) }}"
                                            class="btn btn-primary btn-sm">
                                    {{ formatRupiah($tagihan->tagihanDetails->sum('jumlah_hutang')) }}
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="alert alert-secondary mt-4" role="alert" style="color:black">
                        Pembayaran bisa dilakukan dengan cara langsung ke Bagian Keuangan 
                        atau di transfer melalui rekening milik Perusahaan dibawah ini. <br />
                        <u><i>Jangan melakukan transfer ke rekening selein dari rekening dibawah ini</i></u>
                        <br />
                        Silahkan lihat tata cara melakukan pembayaran melalui 
                        <a href="{{ route('panduan.pembayaran', 'atm') }}" target="blank">ATM</a> atau
                        <a href="{{ route('panduan.pembayaran', 'internet-banking') }}" target="blank">Internet Banking</a> <br />
                        Setelah melakukan pembayaran, silahkan upload bukti pembayaran melalui tombol 
                        konfirmasi yang ada di bawah ini:
                    </div>
                    <ul>
                        <li><a href="{{ route('panduan.pembayaran', 'atm') }}" target="blank">Lihat Cara Pembayaran Melalui ATM</a></li>
                        <li><a href="{{ route('panduan.pembayaran', 'internet-banking') }}" target="blank">Lihat Cara Pembayaran Melalui Internet Banking</a></li>
                    </ul>
                    <div class="row">
                        @foreach ($bankPerusahaan as $itemBank)
                        <div class="col-md-6">
                            <div class="alert alert-dark" role="alert">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="30%">Nama Bank</td>
                                                <td>: {{ ucwords(strtolower($itemBank->nama_bank)) }}</td> <!-- Huruf awal kapital -->
                                            </tr>
                                            <tr>
                                                <td>Nomor Rekening</td>
                                                <td>: {{ $itemBank->nomor_rekening }}</td>
                                            </tr>
                                            <tr>
                                                <td>Atas Nama</td>
                                                <td>: {{ $itemBank->nama_rekening }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('pengawas.pembayaran.create', [
                                        'tagihan_id' => $tagihan->id,
                                        'bank_perusahaan_id' => $itemBank->id,
                                    ]) }}" 
                                        class="btn btn-primary btn-sm mt-2">Konfirmasi Pembayaran</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
