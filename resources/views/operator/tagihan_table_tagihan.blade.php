<table class="table table-sm table-bordered">
    <thead class="table table-primary">
        <tr>
            <th>No</th>
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
            <td class="text-end" colspan="2">Total Tagihan</td>
            <td class="text-end">{{ formatRupiah($tagihan->total_tagihan) }}</td>
        </tr>
    </tfoot>
</table>