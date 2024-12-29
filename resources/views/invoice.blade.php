<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>
        {{ @$title != '' ? "$title |" : '' }}
        {{ settings()->get('app_name', 'My APP') }}
    </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /* Sembunyikan tombol dalam mode cetak */
        @media print {
            .action-buttons {
                display: none;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        /* Styling for the buttons */
        .action-buttons {
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .btn-pdf {
            background-color: #1703ce;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #45a049;
        }

        .btn-print {
            background-color: #0feb34;
            color: white;
        }

        .btn-print:hover {
            background-color: #007bb5;
        }
    </style>
</head>

<body>
    
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td width="80">
                        @if (request('output') =='pdf')
                            <img src="{{ storage_path() . '/app/' . settings()->get('app_logo') }}" alt="" width="170" height="50">
                        @else
                            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="170" height="50">
                        @endif
                    </td>
                    <td style="text-align:left;vertical-align: middle;">
                        <div style="font-size: 28px;font-weight:bold">{{ settings()->get('app_name', 'My App') }}</div>
                        <div>{{ settings()->get('app_address') }}</div>
                    </td>
                </tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Tagihan Untuk: {{ $tagihan->mandor->nama }}<br />
                                    Periode: {{ $tagihan->mandor->periode }}<br />
                                    Kategori: {{ $tagihan->mandor->kategori }}<br />
                                </td>

                                <td>
                                    Invoice #: {{ $tagihan->id }}<br />
                                    Created: {{ $tagihan->tanggal_tagihan->translatedFormat('d F Y') }}<br />
                                    Due: {{ $tagihan->tanggal_jatuh_tempo->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Item Tagihan</td>
                    <td>Sub Total</td>
                </tr>

                @foreach ($tagihan->tagihanDetails as $item)
                    <tr class="item">
                        <td>{{ $item->nama_hutang }}</td>
                        <td>{{ formatRupiah($item->jumlah_hutang) }}</td>
                    </tr>
                @endforeach

                <tr class="heading">
                    <td>Total</td>
                    <td>{{ formatRupiah($tagihan->total_tagihan) }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div>
                            Terbilang: <i>{{ ucwords(terbilang($tagihan->total_tagihan)) }}</i>
                        </div>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <div style="width: 120%;">
                            Jakarta, {{ now()->translatedFormat('d, F Y') }} <br />
                        </div>
                        Mengetahui,<br />
                        
                        <!-- Gambar tanda tangan penanggung jawab -->
                        @if (request('output') == 'pdf')
                            <img src="{{ storage_path() . '/app/' . settings()->get('pj_ttd') }}" alt="" width="130" style="display: block; margin: 0 auto;">
                        @else
                            <img src="{{ Storage::url(settings()->get('pj_ttd')) }}" width="130" style="display: block; margin: 0 auto;">
                        @endif
                        
                        <!-- Div untuk garis bawah dan nama penanggung jawab -->
                        <div style="width: 200px; border-bottom: 1px solid black; margin: 0 auto; text-align: center;">
                            {{ settings()->get('pj_nama') }}
                        </div>
                        
                        <!-- Jabatan penanggung jawab -->
                        <div style="text-align: center;">{{ settings()->get('pj_jabatan') }}</div>
                    </td>
                </tr>
            </table>

            <div class="action-buttons" style="{{ request('output') == 'pdf' ? 'display: none;' : '' }}">
                <a href="{{ url()->current() . '?output=pdf' }}">
                    <button class="btn btn-pdf">Download PDF</button>
                </a>
                <button class="btn btn-print" onclick="window.print()">Cetak</button>
            </div>
        </div>
</body>
</html>


