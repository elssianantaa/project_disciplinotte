<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dasboardController extends Controller
{
    //
    public function showDasboard(){
        return view('admin.index');
    }

    
}
