<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class customlogincontroller extends Controller
{
    public function customlogin(Request $request)
    {
        $mobile=$request->mobile;
        $checkuser=User::where('mobile',$mobile)->first();
        if($checkuser !==null && $checkuser->status =='1')
        {
            $otp="123456";
            User::where('mobile',$mobile)->update(['otp'=>$otp]);
           return response()->json(['status'=>1 ,'mobile'=>$mobile]);
        }
        if($checkuser !==null && $checkuser->status =='0')
        {
            return response()->json(['status'=>2]);
        }
        else
        {
            return response()->json(['status'=>0]);
        }
    }

    public function otpverify(Request $request)
    {
        $user=User::where('mobile',$request->mobile)
                    ->where(['status'=>1])
                    ->where('otp',$request->otp)->
                    first();
        if($user!==null)
        {
            if($user->emailverify !=="verify" && $user->mobileverify !=="verify")
            {
                return response()->json(['status'=>2,]);
            }else
            {
                Auth::login($user);
                return response()->json(['status'=>1]);
            }
            
        }else{
             return response()->json(['status'=>0]);
        }
    }
}
