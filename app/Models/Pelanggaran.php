<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    // //pelanggaran sama siswa
    // public function student(){
    //     return $this->belongsTo(Student::class, 'student_id');
    // }

    // //pelanggaran sama kelas
    // public function kelas(){
    //     return $this->belongsTo(Kelas::class, 'kelas_id');
    // }

    // //pelanggaran sama staff
    // public function staff(){
    //     return $this->belongsTo(Staff::class, 'staff_id');
    // }

    // ini?? gtau yg mana
    // public function students(){
    //     return $this->hasMany(Student::class, 'pelanggaran_id', 'id');
    // }

    // >> catatan pelanggaran sama pelanggaran
    public function catatanPelanggarans(){
        return $this->hasMany(CatatanPelanggaran::class, 'pelanggaran_id', 'id');
    }



}
