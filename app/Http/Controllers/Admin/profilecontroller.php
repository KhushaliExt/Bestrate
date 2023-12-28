<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class profilecontroller extends Controller
{
    public function adminprofile()
    {
        $user = Auth::user();
        return view('admin.profile.profile',compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $user=User::find($request->id);
        $user->name=$request->input('name');
        $user->mobile=$request->input('mobile');
        if($request->input('password')){
            $user->password=Hash::make($request->input('password'));
        }
        $user->save();
        return redirect()->route('adminprofile');
    }
}
