<?php

namespace App\Charts;

use App\Models\Mandor;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MandorKategoriChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
{
    $mandorKategori = Mandor::get();
    $data = [
        $mandorKategori->where('kategori','Microtunneling Contractor')->count(),
        $mandorKategori->where('kategori', 'General Contractor')->count(),
    ];
    $label = [
        'Microtunneling Contractor',
        'General Contractor',
    ];

    return $this->chart->pieChart()
        ->setTitle('Data Mandor PerKategori')
        ->setSubtitle(date('Y'))
        ->addData($data)
        ->setLabels($label);
}
}
