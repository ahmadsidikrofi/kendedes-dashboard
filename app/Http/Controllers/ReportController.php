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

        try {
            $collection = Excel::toCollection(new \stdClass, $request->file('report_file'))->first();

            // Debug: Lihat struktur data
            // dd($collection->take(5)->toArray());

            $reportData = $collection->skip(1) // Skip header
                ->filter(function ($row) {
                    // Filter baris yang memiliki data kecamatan (index 3)
                    return !empty($row[3]) && $row[3] !== null;
                })
                ->groupBy(function ($row) {
                    // Group berdasarkan kolom Kec (index 3)
                    return $row[3];
                })
                ->map(function ($group, $kecamatan) {
                    return [
                        'kecamatan' => $kecamatan,
                        'jumlah' => $group->count(),
                    ];
                })
                ->sortBy('kecamatan')
                ->values();

            // dd($reportData->toArray());

            $chartData = [
                'labels' => $reportData->pluck('kecamatan')->toArray(),
                'values' => $reportData->pluck('jumlah')->toArray(),
            ];

            // Store ke session dengan flash
            session()->flash('chartData', $chartData);
            session()->flash('success', 'Data berhasil diproses! Ditemukan ' . $reportData->count() . ' kecamatan.');

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error memproses file: ' . $e->getMessage());
        }
    }
}
