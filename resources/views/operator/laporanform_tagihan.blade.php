{!! Form::open(['route' => 'laporantagihan.index', 'method' => 'GET', 'target' => 'blank']) !!}
<div class="row gx-2">
   
    <div class="col-md-2 col-sm-12">
        <label for="kategori">Kategori</label>
        {!! Form::select('kategori', getNamaKategori(), null, [
            'class' => 'form-control', 'placeholder' => 
            'Pilih kategori'
        ]) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="">Status Tagihan</label>
       {!! Form::select(
        'status', [
            '' =>  'Pilih Status',
            'lunas' => 'Lunas',
            'baru' => 'Baru',
            'Angsur' => 'Angsur',
       ],
        request('status'), ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="bulan">bulan</label>
        {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 
        'Pilih Bulan']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="tahun">Tahun</label>
        {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 
        'Pilih Tahun']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <button class="btn btn-primary mt-4" type="submit">Tampil</button>
    </div>
</div>
{!! Form::close() !!}