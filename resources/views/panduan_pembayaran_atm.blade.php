@extends('layouts.app_sneat_blank') 
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Transfer Lewat Mesin ATM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ol {
            padding-left: 20px;
        }
        li {
            margin-bottom: 15px;
        }
        .note {
            background-color: #f1c40f;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .note p {
            margin: 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Cara Transfer Lewat Mesin ATM</h1>

        <p>Untuk melakukan transfer lewat mesin ATM, ikuti langkah-langkah berikut:</p>

        <ol>
            <li><strong>Masukkan Kartu ATM</strong><br>
                Masukkan kartu ATM ke mesin dengan posisi yang benar (sesuaikan dengan tanda yang ada di mesin ATM).<br>
                Pilih bahasa yang diinginkan (biasanya ada pilihan Bahasa Indonesia atau Inggris).
            </li>
            <li><strong>Masukkan PIN</strong><br>
                Ketikkan PIN ATM kamu dengan hati-hati. Pastikan kamu tidak terlihat oleh orang lain saat mengetik PIN.<br>
                Tekan "OK" atau "Enter" setelah memasukkan PIN.
            </li>
            <li><strong>Pilih Menu Transfer</strong><br>
                Setelah berhasil login, pilih menu "Transfer" pada layar utama.<br>
                Ada beberapa pilihan jenis transfer, seperti:<br>
                &nbsp;&nbsp;&nbsp;- Transfer Antar Bank (untuk transfer ke rekening bank lain)<br>
                &nbsp;&nbsp;&nbsp;- Transfer Sesama Bank (untuk transfer ke rekening yang ada di bank yang sama)
            </li>
            <li><strong>Masukkan Nomor Rekening Tujuan</strong><br>
                Masukkan nomor rekening tujuan. Pastikan nomor rekening yang kamu masukkan benar.<br>
                Beberapa mesin ATM akan meminta kamu untuk memilih jenis rekening tujuan (misalnya: Tabungan, Giro, atau Deposito). Pilih yang sesuai.
            </li>
            <li><strong>Masukkan Jumlah Uang yang Akan Ditransfer</strong><br>
                Ketikkan jumlah uang yang ingin ditransfer. Pastikan jumlah yang kamu masukkan sudah benar.<br>
                Beberapa mesin ATM mungkin meminta konfirmasi jumlah transfer sebelum melanjutkan.
            </li>
            <li><strong>Periksa dan Konfirmasi Transaksi</strong><br>
                Mesin ATM akan menampilkan rincian transfer, seperti nama pemilik rekening tujuan, jumlah transfer, dan biaya administrasi (jika ada).<br>
                Periksa kembali apakah semua informasi sudah benar.<br>
                Jika sudah yakin, pilih "Ya" atau "Konfirmasi" untuk melanjutkan.
            </li>
            <li><strong>Transaksi Selesai</strong><br>
                Mesin ATM akan memproses transaksi dan memberikan struk sebagai bukti transfer.<br>
                Jangan lupa untuk mengambil kartu ATM dan struk transaksi, serta pastikan kamu sudah selesai sebelum meninggalkan mesin.
            </li>
            <li><strong>Cek Saldo</strong><br>
                Kamu bisa memilih untuk mengecek saldo setelah melakukan transfer, untuk memastikan bahwa saldo kamu sudah terpotong sesuai dengan jumlah transfer.
            </li>
        </ol>

        <div class="note">
            <p>Catatan Penting:</p>
            <p>Pastikan kamu selalu menjaga kerahasiaan PIN dan informasi rekening kamu untuk menghindari penipuan.</p>
        </div>
    </div>

</body>
</html>

@endsection
