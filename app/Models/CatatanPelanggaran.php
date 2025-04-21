<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPelanggaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function student(){
    //     return $this->belongsTo(Student::class, 'student_id');
    // }

    // public function staff(){
    //     return $this->belongsTo(Staff::class, 'staff_id');
    // }

    //catatan pelanggaran sama pelanggaran
    public function pelanggaran(){
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }

    //catatan pelanggaran sama siswa
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    //catatan pelanggaran sama kelas
     public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function students(){
        return $this->hasMany(Student::class, 'pelanggaran_id', 'id');
    }
   
}

