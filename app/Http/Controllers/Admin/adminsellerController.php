<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\seller;
use App\Models\keyword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\sellerkeyword;
use App\Models\area;
use App\Mail\welcomemail;
use Mail;

class adminsellerController extends Controller
{
    public function adminseller()
    {
        $keyword=keyword::where(['status'=>1])->orderby('name','asc')->get();
        $seller=seller::with('sellerKeyword.keyword')->whereIn('status', ['0', '1'])->orderby('id','DESC')->get();
        $area=area::get();
        return view('admin.seller.list',compact('keyword','seller','area'));
    }

    public function storeseller(Request $request)
    {
        $checkuser=User::where(['status'=>1])->where('email',$request->input('email'))->orwhere('mobile',$request->input('mobile'))->first();

        if($checkuser ==null)
        {
            $seller = new seller();
            $seller->first_name=$request->input('first_name');
            $seller->last_name=$request->input('last_name');
            $seller->mobile=$request->input('mobile');
            $seller->email=$request->input('email');
            $seller->area=$request->input('area');
            $seller->pincode=$request->input('pincode');
            $seller->entity=$request->input('entity');
            $seller->business_name=$request->input('business_name');
            $seller->gst=$request->input('gst');
            $seller->business_area=$request->input('business_area');
            $seller->business_pincode=$request->input('business_pincode');
            $seller->save();

            $user=new User();
            $user->name=$request->input('first_name'). ' ' .$request->input('last_name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile');
            $user->password=Hash::make($request->input('mobile'));
            $user->role=3;
            $user->save();
            
            
            $mailData = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp.',
                'user'=>$request->input('first_name') . ' ' .$request->input('last_name')
            ];
            $email=$request->input('email');
            Mail::to($email)->send(new welcomemail($mailData));

            if($request->keyword)
            {
                $keyword=$request->keyword;
                foreach($keyword as $keywords)
                {
                    $sellerkeyword= new sellerkeyword();
                    $sellerkeyword->keyword_id=$keywords;
                    $sellerkeyword->seller_id=$seller->id;
                    $sellerkeyword->save();
                }
            }
            return redirect()->route('admin.seller')->with('successmsg','Seller Create Successfully..');
        }
        else
        {
            return redirect()->route('admin.seller')->with('warningsmsg','A User with this email address or Mobile Number already exists.');
        }
    }

    public function adminsellerstatus($id, $status)
    {
        $seller=seller::where('id',$id)->first();
         seller::where('id',$id)
        ->update(['status'=>$status]);
        User::where('mobile',$seller->mobile)->where('email',$seller->email)->update(['status'=>$status]);
         return redirect()->route('admin.seller')->with('successmsg','Status Change Successfully..');
    }

    public function delete($id)
    {   
        $seller=seller::where('id',$id)->first();
        seller::where('id',$id)->update(['status'=>'3']);
        User::where('email',$seller->email)->update(['status'=>0]);
        return redirect()->route('admin.seller')->with('warningsmsg','Seller Deleted..');
    }

    public function editseller(Request $request)
    {
        $seller = seller::where('id',$request->id)->first();
        $sellerkeyword=sellerkeyword::where('seller_id',$request->id)->get();
        $area=area::get();
        $keyword=keyword::where(['status'=>1])->orderby('name','asc')->get();
        $html=view('admin.seller.edit',compact('seller','sellerkeyword','area','keyword'))->render();
        return response()->json(['html' => $html]);
    }

    public function updateseller(Request $request)
    {
        $seller = seller::find($request->id);
        $seller->first_name=$request->input('first_name');
        $seller->last_name=$request->input('last_name');
        $seller->mobile=$request->input('mobile');
        $seller->email=$request->input('email');
        $seller->area=$request->input('area');
        $seller->pincode=$request->input('pincode');
        $seller->entity=$request->input('entity');
        $seller->business_name=$request->input('business_name');
        $seller->gst=$request->input('gst');
        $seller->business_area=$request->input('business_area');
        $seller->business_pincode=$request->input('business_pincode');
        $seller->save();

        sellerkeyword::where('seller_id',$request->id)->delete();
        if($request->keyword)
        {
            $keyword=$request->keyword;
            foreach($keyword as $keywords)
            {
                    $sellerkeyword= new sellerkeyword();
                    $sellerkeyword->keyword_id=$keywords;
                    $sellerkeyword->seller_id=$seller->id;
                    $sellerkeyword->save();
            }
            }

         User::where('email',$request->input('email'))->where('mobile',$seller->mobile)->update(['name'=>$request->input('first_name') . ' ' . $request->input('last_name')]);
        return redirect()->route('admin.seller')->with('successmsg','Seller Update Successfully..');
    }
}
