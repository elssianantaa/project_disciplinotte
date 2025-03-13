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

}
