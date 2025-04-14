<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Student([
            'nisn'          => $row['nisn'],
            'name'          => $row['name'],
            'kelas_id'      => (int) $row['kelas_id'],
            'password'      => Hash::make($row['password']),
            'jenis_kelamin' => $row['jenis_kelamin'],
            'status'        => $row['status'],
            'point'         => $row['point'],
            'foto'          => $row['foto'] ?? 'default.png',
        ]);
    }
}
