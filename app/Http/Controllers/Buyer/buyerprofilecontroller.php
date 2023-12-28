<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\buyer;
use App\Models\area;

class buyerprofilecontroller extends Controller
{
    public function buyerprofile()
    {
        $user = Auth::user();
        $area=area::get();
        if($user !==null)
        {
            $buyer=buyer::where('email',$user->email)->first();
            return view('buyer.profile.buyerprofile',compact('user','buyer','area'));    
        }
        else
        {
            return redirect()->route('login');
        }
        
    }

    public function updatebuyerprofile(Request $request)
    {
        // dd($request->all());
         $user=User::find($request->id);
        $buyer=buyer::find($request->buyerid);
        $buyer->first_name=$request->input('first_name');
        $buyer->last_name=$request->input('last_name');
        $buyer->pincode=$request->input('pincode');
        $buyer->area=$request->input('area');
        $buyer->entity=$request->input('entity');
        $buyer->business_name=$request->input('business_name');
        $buyer->gst=$request->input('gst');
        

         if($request->mobile_number){
                $checkmobile=user::where('mobile',$request->mobile_number)->first();
                if($checkmobile == null){
                    $buyer->mobile_number=$request->mobile_number;
                    $user->mobile=$request->mobile_number;
                  }
            }

            if($request->email){
                $checkemail=user::where('email',$request->email)->first();
                if($checkemail == null){
                    $buyer->email=$request->email;
                    $user->email=$request->email;
                }
            }  

       
        $user->name=$request->input('first_name') . ' ' .$request->input('last_name');
        if($request->input('password')){
            $user->password=Hash::make($request->input('password'));
        }
        $user->save();
        $buyer->save();
        return redirect()->route('buyerprofile')->with('successmsg','Profile Update Successfully..');
    }
}
