<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;


class PegawaiController extends Controller
{
    public function index()
    {
        $chart = (new Chart)->setType('bar')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,29,22,23,24,25,26,27,28,29,30])
            ->setDataset('Tamu', 'bar', [1,0,2,1,1,0,0,0,1,2,1,3,0,1,0,0,1,1,2,3,1,1,0,1,2,1,1,0,2,3])
            ->setDataset('Kurir', 'bar', [1,0,1,2,1,1,0,2,3,1,0,2,1,1,0,0,0,1,2,1,3,0,1,0,0,1,1,2,3,1])
            ->setOptions([
                'colors' => ['#EF5F4C', '#CD5A36'],
                'stroke' => [
                    'show' => true,
                    'width' => 2,
                    'colors' => ['#EF5F4C', '#CD5A36']  // Warna outline
                ],
                'legend' => [
                    'markers' => [
                        'fillColors' => ['#EF5F4C', '#CD5A36'],
                        'strokeColor' => '#000000',
                    ],
                ],
    
            ]);
            

        return view('pegawai.dashboard', compact('chart'));
    }
}