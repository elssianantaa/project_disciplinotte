<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['nama_kelas', 'wali_kelas', 'jurusan'];
    
    //1!!!!!!!!!!!!!!!!!!!!!1 student sama kelas
    public function students(){
        return $this->hasMany(Student::class, 'kelas_id', 'id');
    }

    // >> pelanggaran sama kelas
    public function pelanggarans(){
        return $this->hasMany(Pelanggaran::class, 'kelas_id', 'id');
    }

}
