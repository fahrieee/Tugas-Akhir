@extends('layouts.app_sneat_pengawas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <h5 class="card-header">Data Pembayaran</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-secondary text-white fw-bold">INFORMASI MANDOR</td>
                                </tr>
                                <tr>
                                    <td>Nama Mandor</td>
                                    <td>: {{ $model->tagihan->mandor->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pengawas</td>
                                    <td>: {{ $model->pengawas->name }}</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="bg-secondary text-white fw-bold">INFORMASI TAGIHAN</td>
                                </tr>
                                <tr>
                                    <td width="22%">No</td>
                                    <td>: {{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice Tagihan</td>
                                    <td>
                                        <a href="{{ route('invoice.show', $model->tagihan_id) }}"
                                        target="blank">
                                            : <i class="fa fa-file-pdf"></i>Cetak</a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Total Tagihan</td>
                                    <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_hutang')) }}</td>
                                </tr>
                                @if ($model->metode_pembayaran != 'manual')
                                    
                              
                                
                                <tr>
                                    <td colspan="2" class="bg-secondary text-white fw-bold">INFORMASI BANK PENGIRIM</td>
                                </tr>
                                <tr>
                                    <td>Bank Pengirim</td>
                                    <td>: {{ $model->pengawasBank->nama_bank }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Rekening</td>
                                    <td>: {{ $model->pengawasBank->nomor_rekening }}</td>
                                </tr>
                                <tr>
                                    <td>Pemilik Rekening</td>
                                    <td>: {{ $model->pengawasBank->nama_rekening }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-secondary text-white fw-bold">INFORMASI BANK TUJUAN TRANSFER</td>
                                </tr>
                                <td>Bank Tujuan Transfer</td>
                                <td>: {{ optional($model->bankPerusahaan)->nama_bank ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Rekening</td>
                                    <td>: {{ optional($model->bankPerusahaan)->nomor_rekening ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama</td>
                                    <td>: {{ optional($model->bankPerusahaan)->nama_rekening ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                @endif
                                
                                <tr>
                                    <td colspan="2" class="bg-secondary text-white fw-bold">INFORMASI PEMBAYARAN</td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>: {{ $model->metode_pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran</td>
                                    <td>: {{ optional($model->tanggal_bayar)->translatedFormat('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan</td>
                                    <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_hutang')) }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Yang Dibayar</td>
                                    <td>: {{ formatRupiah($model->jumlah_bayar) }}</td>
                                </tr>
                                <tr>
                                    <td>Bukti Pembayaran</td>
                                    <td>: 
                                        <a href="javascript:void[0]"
                                            onclick="popupCenter({url: '{{ \Storage::url
                                            ($model->bukti_bayar) }}', title: 'Bukti Pembayaran', w: 900, h: 700}); ">
                                            Lihat Bukti Bayar
                                        </a>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Konfirmasi</td>
                                    <td>: {{ $model->status_konfirmasi }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>: {{ $model->tagihan->getStatusTagihanPengawas() }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Konfirmasi</td>
                                    <td>: {{ optional($model->tanggal_konfirmasi)
                                    ->translatedFormat('d F Y H:i') }}</td>
                                </tr> 
                                
                            </thead>
                        </table>
                        @if ($model->tanggal_konfirmasi != null)
                            <div class="alert alert-primary" role="alert">
                                SUDAH LUNAS
                            </div>
                            <a href="{{ route('kwitansipembayaran.show', $model->id) }}" target="blank">
                                <i class="fa fa-file-pdf"></i>Dowload Kwitansi
                            </a>
                        @else
                        {!! Form::open([
                            'route' => ['pengawas.pembayaran.destroy', $model->id],
                            'method' => 'DELETE',
                            'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                        ]) !!}
                        <button type="submit" class="btn btn-danger mt-3">
                            Batalkan Konfirmasi
                        </button>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
