<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\buyer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\area;
use App\Mail\welcomemail;
use Mail;
use App\Models\sellerquery;
use App\Models\inquery;
use Illuminate\Support\Facades\Validator;


class adminbuyercontroller extends Controller
{
     public function adminbuyer()
    {
        $buyer=buyer::whereIn('status', ['0', '1'])->orderby('id','DESC')->get();
        $sellerquery = inquery::get();
        $area=area::get();
        return view('admin.buyer.list' , compact('buyer','area','sellerquery'));
    }

    public function storebuyer(Request $request)
    {

        $checkuser=User::where(['status'=>1])->where('email',$request->input('email'))->orwhere('mobile',$request->input('mobile_number'))->first();
        if($checkuser ==null)
        {
            $buyer= new buyer();
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

            $user=new User();
            $user->name=$request->input('first_name'). ' ' .$request->input('last_name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile_number');
            $user->password=Hash::make($request->input('mobile_number'));
            $user->role=2;
            $user->save();

            $mailData = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp.',
                'user'=>$request->input('first_name') . ' ' .$request->input('last_name')
            ];
            $email=$request->input('email');
            Mail::to($email)->send(new welcomemail($mailData));

        return redirect()->route('admin.buyer')->with('successmsg','Buyer Create Successfully..');
        }
        else
        {
            return redirect()->route('admin.buyer')->with('warningsmsg','Email and Mobile already taken used another..');
        }
    }

    public function update(Request $request)
    {
        $buyer=buyer::find($request->id);
        $buyer->first_name=$request->input('first_name');
        $buyer->last_name=$request->input('last_name');
        $buyer->dob=$request->input('dob');
        $buyer->mobile_number=$request->input('mobile_number');
        $buyer->email=$request->input('email');
        $buyer->city=$request->input('city');
        $buyer->area=$request->input('area');
        $buyer->pincode=$request->input('pincode');
        $buyer->entity=$request->input('entity');
        $buyer->business_name=$request->input('business_name');
        $buyer->gst=$request->input('gst');
        $buyer->save();

        User::where('email',$buyer->email)->where('mobile',$buyer->mobile_number)->update(['name'=>$request->input('first_name') . ' ' . $request->input('last_name')]);
        
        return redirect()->route('admin.buyer')->with('successmsg','Buyer Update Successfully..');
    }
    
    public function delete($id)
    {
        buyer::where('id',$id)
        ->update(['status'=>'3']);
        $buyer=buyer::where('id',$id)->first();
        User::where('email',$buyer->email)->update(['status'=>0]);
        return redirect()->route('admin.buyer')->with('warningsmsg','Buyer Deleted..');
    }

    public function buyerstatus($id, $status)
    {
        $buyer=buyer::where('id',$id)->first();
         buyer::where('id',$id)
        ->update(['status'=>$status]);
         User::where('mobile',$buyer->mobile_number)->where('email',$buyer->email)->update(['status'=>$status]);
         return redirect()->route('admin.buyer')->with('successmsg','Status Change Successfully..');
    }
}
