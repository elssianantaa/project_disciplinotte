<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use HasFactory;
    protected $guard = 'student';
    protected $fillable = [
        'nisn', 'name', 'password', 'kelas_id', 'jenis_kelamin', 'status', 'point', 'foto',
    ];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'nisn';
    }

    // student sama kelas
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


    // >>pelanggaran sama siswa
    // public function pelanggarans(){
    //     return $this->hasMany(Pelanggaran::class, 'student_id', 'id');
    // }

    // public function pelanggarans(){
    //     return $this->hasMany(Pelanggaran::class, 'kelas_id', 'id');
    // }

    //>> Riwayat kelas sama siswa
    public function riwayatkelas(){
        return $this->hasMany(RiwayatKelas::class, 'student_id', 'id');
    }


    // >> catatan pelanggaran sama siswa
    public function catatanPelanggarans(){
        return $this->hasMany(CatatanPelanggaran::class, 'student_id', 'id');
    }

    // student sama evaluasisiswa
    public function evaluasiSiswas(){
        return $this->hasMany(EvaluasiSiswa::class, 'student_id', 'id');
    }

    public function catatan_pelanggarans(){
        return $this->belongsTo(CatatanPelanggaran::class, 'pelanggaran_id');
    }

    // public function pelanggaran(){
    //     return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    // }

    // skorsing sama siswa
    public function skorsings(){
        return $this->hasMany(Skorsing::class, 'student_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
