<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buyer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\seller;
use App\Models\area;
use App\Mail\welcomemail;
use Mail;

class customRegistercontroller extends Controller
{

    public function mail()
    {
         $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
        Mail::to('loopcon1018@gmail.com')->send(new welcomemail($mailData));
         dd("Email is sent successfully.");
    }

     public function customregister()
    {
        $area=area::get();
        return view('register.index',compact('area'));
    }

    public function findpincode(Request $request)
    {
        $area=area::where('location',$request->area)->first();
        return response()->json(['area' => $area->pincode]);
    }
    public function buyerregisted(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'mobile_number'=> 'required','unique:users',
            'email' => ['required','string','email','max:255','unique:users','regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
            ],
            'area'=>'required',
            'pincode'=>'required',
        ], [
            'email.required' => 'Please enter email!',
            'email.email' => 'Invalid email!',
            'email.unique' => 'Email already exist!',
            'mobile_number.required' => 'Please enter email!',
            'mobile_number.unique' => 'Mobile Number already exists!',
        ]);

        $checkuser=User::where('email',$request->input('email'))->orwhere('mobile',$request->input('mobile_number'))->first();

        if($checkuser == null)
        {    
          
            $buyer = new buyer();
            $buyer->first_name=$request->input('first_name');
            $buyer->last_name=$request->input('last_name');
            $buyer->mobile_number=$request->input('mobile_number');
            $buyer->email=$request->input('email');
            $buyer->city=$request->input('city');
            $buyer->area=$request->input('area');
            $buyer->pincode=$request->input('pincode');
            $buyer->entity=$request->input('entity');
            $buyer->business_name=$request->input('business_name');
            $buyer->gst=$request->input('gst');
            $buyer->save();
            
            $user= new User();
            $user->name=$request->input('first_name') . $request->input('last_name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile_number');
            $user->password=Hash::make($request->input('password'));
            $user->role='2';
            $user->save();

            $mailData = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp.',
                'user'=>$request->input('first_name') . ' ' .$request->input('last_name')
            ];
            $email=$request->input('email');
             Mail::to($email)->send(new welcomemail($mailData));
            return redirect()->route('login');
        }
        else
        {
            return redirect()->back()->with('warningsmsg','Email or Mobile Number Already in Used Try Diffrent..');
        }
    }

    public function sellerregisted(Request $request)
    {

        $checkuser=User::where('email',$request->input('email'))->orwhere('mobile',$request->input('mobile_number'))->first();

        if($checkuser == null)
        {    
          
            $seller = new seller();
            $seller->first_name=$request->input('first_name');
            $seller->last_name=$request->input('last_name');
            $seller->mobile=$request->input('mobile_number');
            $seller->email=$request->input('email');
            $seller->area=$request->input('area');
            $seller->pincode=$request->input('pincode');
            $seller->entity=$request->input('entity');
            $seller->business_name=$request->input('business_name');
            $seller->gst=$request->input('gst');
            $seller->business_area=$request->input('business_area');
            $seller->business_pincode=$request->input('business_pincode');
            $seller->save();

            $user= new User();
            $user->name=$request->input('first_name') . $request->input('last_name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile_number');
            $user->password=Hash::make($request->input('password'));
            $user->role='3';
            $user->save();

            $mailData = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp.',
                'user'=>$request->input('first_name') . ' ' .$request->input('last_name')
            ];
            $email=$request->input('email');
             Mail::to($email)->send(new welcomemail($mailData));

              // dd("Email is sent successfully.");
            return redirect()->route('login');
        }
        else
        {
            return redirect()->back()->with('msg','Email or Mobile Number Already in Used Try Diffrent..');
        }
    }
}
