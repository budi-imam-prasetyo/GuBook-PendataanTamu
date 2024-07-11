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
        // $kurir = 'hello';
        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,29,22,23,24,25,26,27,28,29,30])
            ->setDataset('Tamu', 'area', [5,8,4,9,7,8,4,10,3,9,3,9,9,3,10,12,12,9,3,6,9,7,3,10,9,7,4,9,6,7])
            ->setDataset('Kurir', 'area', [9,3,6,8,3,10,4,7,5,4,9,5,9,12,6,12,5,7,4,9,5,5,7,6,7,9,8,4,9,8]);

        return view('admin.dashboard', compact('chart'));
    }
}