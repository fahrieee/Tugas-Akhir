<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\DonutChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TagihanBulananChart
{
    protected $chart;
    protected array $data = [];
    protected array $labels = [];

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(array $data): DonutChart
    {
        return $this->chart->donutChart()
            ->setDataLabels(true)
            ->setWidth(165)
            ->setHeight(155)
            ->setSparkline(true)
            ->addData($data);
    }
}
