<table class="table table-bordered table-sm">
    <thead class="table table-primary">
        <tr style="height: 40px">
            <th style="text-align: center" width="1%">No</th>
            <th style="text-align: center" width="8%">Bulan</th>
            <th style="text-align: center" width="8%">Jumlah Tagihan</th>
            <th style="text-align: center" width="8%">Tanggal Bayar</th>
        </tr>
    </thead>

    @foreach ($kartuPembayaran as $item)
    <tr class="">
        <td style="text-align: center">{{ $loop->iteration }}</td>
        <td style="text-align: start">{{ $item['bulan'] . ' ' . $item['tahun'] }}</td>
        <td style="text-align: end">{{ formatRupiah($item['total_tagihan']) }}</td>
        <td style="text-align: end">{{ $item['tanggal_bayar'] }}</td>
    </tr>
    @endforeach
</table>
