<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\area;
class Registercontroller extends Controller
{
    public function customregister()
    {
        $area=area::get();
        return view('register.index',compact('area'));
    }
}
