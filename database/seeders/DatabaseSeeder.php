<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'admin',
            'nohp' => '08212234436x',
            'address' => 'singaparna',
        ]);


        User::create([
            'name' => 'Staff',
            'email'=> 'guru@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'staff',
            'nohp' => '08212288344',
            'address' => 'tawang',
        ]);

        Kelas::create([
            'nama_kelas' => 'XI RPL 1',
            'wali_kelas' => 'Bapak Fahmi',
            'Jurusan' => 'RPL'
        ]);

        Kelas::create([
            'nama_kelas' => 'XI RPL 2',
            'wali_kelas' => 'Ibu Feby',
            'Jurusan' => 'RPL'
        ]);

        Student::create([
            'nisn' => '00737456',
            'name' => 'Elssi',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto' => '-'
        ]);

        Student::create([
            'nisn' => '0076346790',
            'name' => 'Siti Aisyah',
            'kelas_id' => 2,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto'=> '-'
        ]);

        Pelanggaran::create([
            'nama_pelanggaran' => 'Bolos',
            'Kategori' => 'Ringan',
            'point' => '10'
        ]);

        Staff::create([
            'nama' => 'Aiden',
            'email' => 'aiden@gmail.com',
            'password' => bcrypt('12345'),
            'alamat' => 'Tawang',
            'nohp' => '081234567892',
            'role' => 'satpam',
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

}
