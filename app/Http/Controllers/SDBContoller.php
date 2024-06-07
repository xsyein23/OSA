<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeOfConductImages;

class SDBContoller extends Controller
{
   
    public function index()
    {
        return view('sdb.index');
    }

}
