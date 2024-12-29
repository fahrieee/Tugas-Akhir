{!! Form::open(['route' => 'laporanpembayaran.index', 'method' => 'GET', 'target' => 'blank']) !!}
<div class="row gx-2">
    <div class="col-md-2 col-sm-12">
        <label for="metode_pembayaran">Metode Pembayaran</label>
        {!! Form::select('metode_pembayaran', [
            '' => 'Pilih Metode',
            'transfer' => 'Transfer',
            'manual' => 'Manual',
        ], request('metode_pembayaran'), ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="kategori">Kategori</label>
        {!! Form::select('kategori', getNamaKategori(), null, [
            'class' => 'form-control', 'placeholder' => 'Pilih Kategori'
        ]) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="status_konfirmasi">Status Konfirmasi</label>
        {!! Form::select('status_konfirmasi', [
            '' => 'Pilih Status',
            'sudah' => 'Sudah Dikonfirmasi',
            'belum' => 'Belum Dikonfirmasi',
        ], request('status_konfirmasi'), ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="bulan">Bulan</label>
        {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Pilih Bulan']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="tahun">Tahun</label>
        {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 'Pilih Tahun']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <button class="btn btn-primary mt-4" type="submit">Tampil</button>
    </div>
</div>
{!! Form::close() !!}
