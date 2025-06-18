<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function GetBusinessReportData()
    {
        $chartData = session('chartData', [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'values' => [195000, 210000, 230000, 235000, 250000, 272268],
        ]);

        return view('dashboard', ['chartData' => $chartData]);
    }

    public function UploadBusinessReport(Request $request)
    {
        $request->validate([
            'report_file' => 'required|mimes:xlsx,xls'
        ]);

        $collection = Excel::toCollection(new \stdClass, $request->file('report_file'))->first();

        $reportData = $collection->skip(1)
        ->filter(fn ($row) => !empty($row[2]))
        ->groupBy(2)
        ->map(function ($group, $kecamatan) {
            return [
                'kecamatan' => $kecamatan,
                'jumlah' => $group->count(), // Hitung jumlah usaha di kecamatan tsb
            ];
        })
        ->sortBy('kecamatan') // Urutkan berdasarkan nama kecamatan
        ->values();

        $chartData = [
            'labels' => $reportData->pluck('kecamatan'),
            'values' => $reportData->pluck('jumlah'),
        ];
        return redirect()->route('dashboard')->with('chartData', $chartData);
    }
}
