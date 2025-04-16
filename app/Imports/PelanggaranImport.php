<?php

namespace App\Imports;

use App\Models\Pelanggaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PelanggaranImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Lewati jika nama_pelanggaran kosong (baris kosong)
    if (!isset($row['nama_pelanggaran']) || $row['nama_pelanggaran'] === null) {
        return null;
    }

        return new Pelanggaran([
            'nama_pelanggaran' => $row['nama_pelanggaran'],
            'kategori' => $row['kategori'],
            'point'    => $row['point'],
        ]);
    }
}
