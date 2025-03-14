<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'nohp',
        'role',
    ];

    //pelanggaran sama staff
    public function pelanggarans(){
        return $this->hasMany(Pelanggaran::class, 'staff_id', 'id');
    }

    // public function staffs(){
    //     return $this->hasMany(Staff::class, 'staff_id', 'id');
    // }

    //catatan pelanggaran sama staff
    public function catatanPelanggarans(){
        return $this->hasMany(CatatanPelanggaran::class, 'pelanggaran_id', 'id');
    }

}
