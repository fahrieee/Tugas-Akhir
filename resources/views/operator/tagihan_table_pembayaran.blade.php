<table class="table table-striped table-bordered" >
    <thead class="table table-primary">
        <tr>
            <th >Tanggal</th>
            <th >Metode</th>
            <th class="text-end">Jumlah</th>
            <th>#</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($tagihan->pembayaran as $item)
            <tr>
                <td>{{ $item->tanggal_bayar->translatedFormat('d-m-Y') }}</td>
                <td>{{ $item->metode_pembayaran }}</td>
                <td class="text-end">{{ formatRupiah($item->jumlah_bayar) }}</td>
                <td >
                    {!! Form::open([
                        'route' => ['pembayaran.destroy', $item->id],
                        'method' => 'DELETE',
                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                    ]) !!}
                    
                    <button type="submit" class="btn m-0 p-0 mx-2">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{ route('kwitansipembayaran.show', $item->id) }}" target="blank">
                        <i class="fa fa-print"></i>
                    </a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-end" colspan="2">Total Pembayaran</td>
            <td class="text-end">{{ formatRupiah($tagihan->total_pembayaran) }}</td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
</table>