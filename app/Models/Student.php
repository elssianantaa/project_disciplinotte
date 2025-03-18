<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'nisn', 'name', 'kelas_id', 'jenis_kelamin', 'password', 'status', 'point', 'foto'
    ];

    protected $hidden = [
        'password',
    ];

    //!!!!!!!!!!!1 ini teh student sama kelas
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

   
    // >>pelanggaran sama siswa
    public function pelanggarans(){
        return $this->hasMany(Pelanggaran::class, 'student_id', 'id');
    }

    // public function pelanggarans(){
    //     return $this->hasMany(Pelanggaran::class, 'kelas_id', 'id');
    // }

    public function catatanPelanggarans(){
        return $this->hasMany(CatatanPelanggaran::class, 'student_id', 'id');
    }

    public function evaluasiSiswas(){
        return $this->hasMany(EvaluasiSiswa::class, 'student_id', 'id');
    }

    public function pelanggaran(){
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }
}
