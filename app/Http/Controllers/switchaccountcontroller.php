<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\seller;
use App\Models\buyer;
use Auth;

class switchaccountcontroller extends Controller
{
    public function switchseller()
    {
        $user = Auth::user();
        $buyer=buyer::where('email',$user->email)->first();

        if($buyer != null)
        {
            $seller=seller::where('email',$user->email)->first();

            if($seller == null)
            {
                $seller = new seller();
                $seller->first_name=$buyer->first_name;
                $seller->last_name=$buyer->last_name;
                $seller->mobile=$buyer->mobile_number;
                $seller->email=$buyer->email;
                $seller->save();

                $buyer=buyer::where('id',$buyer->id)->update(['status'=>2]);
                User::where('id',$user->id)->update(['role'=>3]);
                  Auth::logout();
                  return redirect('/login');
            }
            else
            {
                $seller=seller::where('id',$seller->id)->update(['status'=>1]);
                $buyer=buyer::where('id',$buyer->id)->update(['status'=>2]);
                User::where('id',$user->id)->update(['role'=>3]);
                  Auth::logout();
                  return redirect('/login');
            }

                
        }
    }


    public function switchbuyer()
    {
        $user = Auth::user();
        $seller=seller::where('email',$user->email)->first();
        if($seller != null)
        {
            $buyer=buyer::where('email',$user->email)->first();
            if($buyer == null)
            {
                $buyer = new buyer();
                $buyer->first_name=$seller->first_name;
                $buyer->last_name=$seller->last_name;
                $buyer->mobile_number=$seller->mobile;
                $buyer->email=$seller->email;
                $buyer->save();

                $buyer=seller::where('id',$seller->id)->update(['status'=>2]);
                User::where('id',$user->id)->update(['role'=>2]);
                Auth::logout();
                  return redirect('/login');
            }
            else
            {
                $buyer=buyer::where('id',$buyer->id)->update(['status'=>1]);
                $buyer=seller::where('id',$seller->id)->update(['status'=>2]);
                User::where('id',$user->id)->update(['role'=>2]);
                  Auth::logout();
                  return redirect('/login');
            }

                
        }
    }
}
