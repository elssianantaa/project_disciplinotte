<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    //

    public function show(){
        $data['student'] = Student::all();
        return view('Staff.daftarSiswa', $data);
    }
}
