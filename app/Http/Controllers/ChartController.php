<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\DB;
use Akaunting\Apexcharts\Chart;

class ChartController extends Controller
{
    public function index()
    {
        // Ambil data dari database dan hitung jumlah per bulan
        $data = Data::select(DB::raw('month, COUNT(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data sesuai kebutuhan chart
        $formattedData = [
            'labels' => $data->pluck('month'),
            'datasets' => [
                [
                    'label' => 'Jumlah Data per Bulan',
                    'tension' => 0.4,
                    'borderWidth' => 3,
                    'pointRadius' => 3,
                    'borderColor' => "#5e72e4",
                    'backgroundColor' => 'rgba(94, 114, 228, 0.2)',
                    'fill' => true,
                    'data' => $data->pluck('count'),
                ]
            ]
        ];

        return response()->json($formattedData);
    }

    public function chart()
    {
        $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $dates[] = strval($i);
        }
        $kurir = 'hello';
        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels([1,2,3,4,5,6,7])
            ->setDataset($kurir, 'area', [250, 700, 100, 172, 916, 910, 700])
            ->setDataset('New User', 'area', [1000, 1124, 200, 916, 513, 1124, 200]);

        return view('dashboard', compact('chart'));
    }
}