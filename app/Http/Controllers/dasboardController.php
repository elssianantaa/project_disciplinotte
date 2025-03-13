<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dasboardController extends Controller
{
    //
    public function showDasboard(){
        return view('admin.index');
        
    }

}
