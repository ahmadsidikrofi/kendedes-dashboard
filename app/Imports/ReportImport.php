<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class ReportImport implements OnEachRow
{
    private $kecamatanCounts = [];

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        // Lewati baris pertama (header)
        if ($rowIndex == 1) {
            return;
        }

        // Asumsikan kolom 'Kec' ada di index 2 (kolom C)
        $kecamatan = $row[2] ?? null;

        if ($kecamatan) {
            // Jika kecamatan ini belum ada di daftar, buat entri baru dengan nilai 1
            if (!isset($this->kecamatanCounts[$kecamatan])) {
                $this->kecamatanCounts[$kecamatan] = 0;
            }
            // Tambahkan hitungan untuk kecamatan ini
            $this->kecamatanCounts[$kecamatan]++;
        }
    }

    // Fungsi untuk mengambil hasil agregasi setelah selesai
    public function getKecamatanCounts(): array
    {
        return $this->kecamatanCounts;
    }
}