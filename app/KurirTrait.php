<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;

trait KurirTrait
{
    /**
     * Apply daily date filter to query
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @param string $dateField default 'waktu_kedatangan'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyDailyFilterKurir($query, $startDate, $endDate, $dateField = 'waktu_kedatangan')
    {
        return $query->whereBetween($dateField, [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    /**
     * Apply monthly date filter to query
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $month
     * @param int $year
     * @param string $dateField default 'waktu_kedatangan'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyMonthlyFilterKurir($query, $month, $year, $dateField = 'waktu_kedatangan')
    {
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        return $query->whereBetween($dateField, [$startDate, $endDate]);
    }

    /**
     * Apply yearly date filter to query
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $year
     * @param string $dateField default 'waktu_kedatangan'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyYearlyFilterKurir($query, $year, $dateField = 'waktu_kedatangan')
    {
        $startDate = Carbon::createFromDate($year, 1, 1)->startOfYear();
        $endDate = $startDate->copy()->endOfYear();

        return $query->whereBetween($dateField, [$startDate, $endDate]);
    }

    /**
     * Generate filename based on filter type and parameters
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $prefix default 'laporan'
     * @return string
     */
    protected function generateFilteredFilenameKurir(Request $request, $prefix = 'laporan')
    {
        $filename = $prefix;

        if ($request->filterType === 'daily' && $request->filled(['startDate', 'endDate'])) {
            $filename .= '-' . $request->startDate . '-sampai-' . $request->endDate;
        } elseif ($request->filterType === 'monthly' && $request->filled(['month', 'monthYear'])) {
            $filename .= '-bulan-' . $request->month . '-' . $request->monthYear;
        } elseif ($request->filterType === 'yearly' && $request->filled('year')) {
            $filename .= '-tahun-' . $request->year;
        }

        return $filename;
    }

    /**
     * Apply date filter based on filter type
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @param string $dateField default 'waktu_kedatangan'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyDateFilterKurir($query, Request $request, $dateField = 'waktu_kedatangan')
    {
        if (!$request->filled('filterType')) {
            return $query;
        }

        switch ($request->filterType) {
            case 'daily':
                if ($request->filled(['startDate', 'endDate'])) {
                    $query = $this->applyDailyFilterKurir($query, $request->startDate, $request->endDate, $dateField);
                }
                break;

            case 'monthly':
                if ($request->filled(['month', 'monthYear'])) {
                    $query = $this->applyMonthlyFilterKurir($query, $request->month, $request->monthYear, $dateField);
                }
                break;

            case 'yearly':
                if ($request->filled('year')) {
                    $query = $this->applyYearlyFilterKurir($query, $request->year, $dateField);
                }
                break;
        }

        return $query;
    }
}
