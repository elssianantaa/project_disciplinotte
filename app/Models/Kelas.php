<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['nama_kelas', 'wali_kelas', 'jurusan'];

    // student sama kelas
    public function students(){
        return $this->hasMany(Student::class, 'kelas_id', 'id');
    }

    // catatan pelanggaran sama kelas   
    public function catatanpelanggarans(){
        return $this->hasMany(CatatanPelanggaran::class, 'kelas_id', 'id');
    }

    // skorsing sama kelas
    public function skorsings(){
        return $this->hasMany(Skorsing::class, 'kelas_id', 'id');
    }

}
