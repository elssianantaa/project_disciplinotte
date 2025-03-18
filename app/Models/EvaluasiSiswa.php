<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiSiswa extends Model
{
    use HasFactory;

    protected $guarded= [];

    // sama siswa
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
