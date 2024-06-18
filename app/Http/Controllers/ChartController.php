<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\DB;

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
}