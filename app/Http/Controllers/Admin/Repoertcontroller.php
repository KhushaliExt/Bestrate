<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Repoertcontroller extends Controller
{
    public function keywordrepoert()
    {
        return view('admin.repoerts.keywordrepoert');
    }

    public function sellerrepoert()
    {
        return view('admin.repoerts.sellerrepoerts');
    }
    public function buyerrepoert()
    {
        return view('admin.repoerts.buyerrepoert');
    }

    public function inquieryrepoert()
    {
        return view('admin.repoerts.inquiery');
    }
}
