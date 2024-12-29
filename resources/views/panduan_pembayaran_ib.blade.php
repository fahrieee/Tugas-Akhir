@extends('layouts.app_sneat_blank') 
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pembayaran Lewat Internet Banking</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        ol {
            padding-left: 20px;
        }

        li {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .note {
            background-color: #f39c12;
            padding: 15px;
            border-radius: 8px;
            margin-top: 25px;
            font-size: 16px;
            color: #fff;
        }

        .note p {
            margin: 0;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #aaa;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsif */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            li {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Panduan Pembayaran Lewat Internet Banking</h1>

        <p>Ikuti langkah-langkah berikut untuk melakukan pembayaran menggunakan layanan Internet Banking:</p>

        <ol>
            <li><strong>Login ke Akun Internet Banking</strong><br>
                Masukkan username dan password untuk login ke akun Internet Banking Anda pada situs resmi bank yang digunakan.
            </li>
            <li><strong>Pilih Menu Pembayaran</strong><br>
                Setelah berhasil login, pilih menu <strong>"Pembayaran"</strong> pada halaman utama. Biasanya ada beberapa jenis pembayaran yang bisa dipilih, seperti tagihan listrik, air, atau kartu kredit.
            </li>
            <li><strong>Pilih Jenis Pembayaran</strong><br>
                Pilih jenis pembayaran yang ingin Anda lakukan, misalnya tagihan listrik, PDAM, atau transaksi lainnya.
            </li>
            <li><strong>Masukkan Informasi Pembayaran</strong><br>
                Isikan informasi yang diperlukan, seperti nomor pelanggan atau nomor tagihan yang ingin dibayar. Pastikan semua data yang dimasukkan sudah benar.
            </li>
            <li><strong>Masukkan Jumlah Pembayaran</strong><br>
                Ketikkan jumlah yang akan dibayar sesuai dengan tagihan yang Anda terima. Periksa kembali jumlahnya agar tidak terjadi kesalahan.
            </li>
            <li><strong>Periksa Rincian Pembayaran</strong><br>
                Sistem akan menampilkan rincian pembayaran, seperti nama, nomor pelanggan, jumlah tagihan, dan biaya administrasi (jika ada). Periksa semua informasi dengan teliti.
            </li>
            <li><strong>Konfirmasi Pembayaran</strong><br>
                Setelah memastikan semua informasi sudah benar, klik tombol <strong>"Konfirmasi"</strong> untuk menyelesaikan transaksi pembayaran.
            </li>
            <li><strong>Transaksi Selesai</strong><br>
                Setelah transaksi berhasil, Anda akan menerima konfirmasi pembayaran dan bukti transaksi berupa struk digital atau email.
            </li>
        </ol>

        <div class="note">
            <p>Catatan Penting:</p>
            <p>Pastikan Anda selalu menjaga kerahasiaan username dan password Anda untuk menghindari penipuan.</p>
        </div>

    </div>

</body>
</html>

@endsection

