<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'nohp' => '082122344',
            'foto' => '-',
        ]);

        // Staff::create([
        //     'name' => 'Staff',
        //     'email'=> 'Guru@gmail.com',
        //     'password' => bcrypt('12345'),
        //     'alamat' => 'Singaparna',
        //     'nohp' => '082392392',
        //     'role' => 'guru',
        // ]);

        User::create([
            'name' => 'Staff',
            'email'=> 'guru@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'guru',
            'nohp' => '08212288344',
            'foto' => '-',
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
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto' => '-'
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }




}
