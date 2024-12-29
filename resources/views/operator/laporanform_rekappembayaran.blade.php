{!! Form::open(['route' => 'laporanrekappembayaran.index', 'method' => 'GET', 'target' => 'blank']) !!}
                            <div class="row gx-2">
                                {{-- <div class="col-md-2 col-sm-12">
                                    <label for="periode">Periode</label>
                                    {!! Form::selectRange('periode', 2022, date('Y') + 1, null, [
                                        'class' => 'form-control', 'placeholder' => 
                                        'Pilih Periode'
                                    ]) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="kategori">Kategori</label>
                                    {!! Form::select('kategori', getNamaKategori(), null, [
                                        'class' => 'form-control', 'placeholder' => 
                                        'Pilih kategori'
                                    ]) !!}
                                </div> --}}
                                {{-- <div class="col-md-2 col-sm-12">
                                    <label for="">Status Pembayaran</label>
                                   {!! Form::select(
                                    'status', [
                                        '' =>  'Pilih Status',
                                        'sudah-konfirmasi' => 'Sudah Dikonfirmasi',
                                        'belum-konfirmasi' => 'Belum Dikonfirmasi',
                                   ],
                                    request('status'), ['class' => 'form-control']) !!}
                                </div> --}}
                                {{-- <div class="col-md-2 col-sm-12">
                                    <label for="bulan">Bulan</label>
                                    {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 
                                    'Pilih Bulan']) !!}
                                </div> --}}
                                <div class="col-md-2 col-sm-12">
                                    <label for="bulan">Tahun</label>
                                    {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), 
                                    ['class' => 'form-control', 'placeholder' => 
                                    'Pilih Tahun']) !!}
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <button class="btn btn-primary mt-4" type="submit">Tampil</button>
                                </div>
                            </div>
                            {!! Form::close() !!}