<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['nama_kelas', 'wali_kelas', 'jurusan'];
    
    public function students(){
        return $this->hasMany(Student::class, 'student_id', 'id');
    }

    public function pelanggarans(){
        return $this->hasMany(Pelanggaran::class, 'kelas_id', 'id');
    }

}
