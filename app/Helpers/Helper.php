<?php

function getNamaKategori()
{
  return[
    'General Contractor' => 'General Contractor',
    'Microtunneling Contractor' => 'Microtunneling Contractor',
  ];
}

function bulanHutang()
{
  return [
     1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 
  ];
}

function ubahNamaBulan($angka)
{
    $namaBulan = [
      '' => '',
      '1' => 'Januari',
      '2' => 'Februari',
      '3' => 'Maret',
      '4' => 'April',
      '5' => 'Mei',
      '6' => 'Juli',
      '7' => 'Juni',
      '8' => 'Agustus',
      '9' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember',

    ];
    return $namaBulan[$angka];
}

function getTahunPembayaran()
{
  $bulanAwal = bulanHutang()[0];
  $bulanSekarang = intval(date('m'));
  if ($bulanSekarang >= $bulanAwal) {
    return date('Y');
  }
  return date('Y') - 1;
}

function getTahunPembayaranFull()
{
  return getTahunPembayaran() . '/' . (getTahunPembayaran() + 1);
}

function formatRupiah($nominal, $prefix = null)
{
    $prefix = $prefix ? $prefix : 'Rp. ';
    return $prefix . number_format($nominal, 0, ',', '.');
} 

function terbilang($x) {
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
  
    if ($x < 12)
      return " " . $angka[$x];
    elseif ($x < 20)
      return terbilang($x - 10) . " belas";
    elseif ($x < 100)
      return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200)
      return "seratus" . terbilang($x - 100);
    elseif ($x < 1000)
      return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000)
      return "seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
      return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
      return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
  }