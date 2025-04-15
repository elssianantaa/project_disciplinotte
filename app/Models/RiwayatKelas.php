<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKelas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function kelasLama()
    {
        return $this->belongsTo(Kelas::class, 'kelas_lama_id');
    }
    
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


}
