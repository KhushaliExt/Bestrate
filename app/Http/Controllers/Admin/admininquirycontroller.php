<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sellerquery;

class admininquirycontroller extends Controller
{
    public function admininquiry()
    {
        $sellerquery=sellerquery::with('seller','keyword','inquery' ,'inquirystatus')->get();
        return view('admin.inquirey.list',compact('sellerquery'));
    }
}
