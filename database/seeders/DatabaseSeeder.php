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
            'foto' => '-'

        ]);


        User::create([
            'name' => 'Staff',
            'email'=> 'guru@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'staff',
            'nohp' => '08212288344',
            'address' => 'tawang',
            'foto' => '-'
        ]);

        User::create([
            'name' => 'Oliv',
            'email'=> 'oliv@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'student',
            'nohp' => '08212288394',
            'address' => 'bandung',
            'foto' => '-'
        ]);

        Kelas::create([
            'nama_kelas' => 'X DKV 1',
            'wali_kelas' => 'Ibu Vera',
            'Jurusan' => 'DKV'
        ]);

        Kelas::create([
            'nama_kelas' => 'XI DKV 1',
            'wali_kelas' => 'Ibu Dian',
            'Jurusan' => 'DKV'
        ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TKR 2',
        //     'wali_kelas' => 'Pak Muna',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TKR 3',
        //     'wali_kelas' => 'Ibu Dian',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 1',
        //     'wali_kelas' => 'Ibu Eva',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 2',
        //     'wali_kelas' => 'Ibu Pipit',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 2',
        //     'wali_kelas' => 'Ibu Irma',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 2',
        //     'wali_kelas' => 'Pak Beni',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 2',
        //     'wali_kelas' => 'Pak Helmi',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'X TBSM 2',
        //     'wali_kelas' => 'Pak Helmi',
        //     'Jurusan' => 'DKV'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'XI RPL 1',
        //     'wali_kelas' => 'Bapak Fahmi',
        //     'Jurusan' => 'RPL'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'XI RPL 2',
        //     'wali_kelas' => 'Ibu Feby',
        //     'Jurusan' => 'RPL'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'XII TO 1',
        //     'wali_kelas' => 'Ibu Ajeng',
        //     'Jurusan' => 'Teknik Otomotif'
        // ]);

        // Kelas::create([
        //     'nama_kelas' => 'XII TO 2',
        //     'wali_kelas' => 'Bapak Ridwan',
        //     'Jurusan' => 'Teknik Otomotif'
        // ]);

        Student::create([
            'nisn' => '0073722407',
            'name' => 'Elsi Ananta',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto' => '-'
        ]);

        Student::create([
            'nisn' => '0076247016',
            'name' => 'Oliviandra Safitri',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto'=> '-'
        ]);
        Student::create([
            'nisn' => '0074186716',
            'name' => 'Silvia Cintani Asri',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto'=> '-'
        ]);
        Student::create([
            'nisn' => '3063590310',
            'name' => 'Alya Devika Maharani',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Perempuan',
            'password' => bcrypt('12345'),
            'status' => 'aktif',
            'point' => 0,
            'foto'=> '-'
        ]);

        Pelanggaran::create([

            'nama_pelanggaran' => 'Tawuran',
            'Kategori' => 'Berat',
            'point' => '40'
        ]);
        
        Pelanggaran::create([
            'nama_pelanggaran' => 'Bolos',
            'Kategori' => 'Ringan',
            'point' => '10'
        ]);

        Pelanggaran::create([
            'nama_pelanggaran' => 'Tawuran',
            'Kategori' => 'Berat',
            'point' => '30'
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
