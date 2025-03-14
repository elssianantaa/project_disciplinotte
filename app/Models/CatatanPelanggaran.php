<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPelanggaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function pelanggaran(){
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }
}
