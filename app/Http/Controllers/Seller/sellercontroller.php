<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\sellerquery;
use App\Models\seller;
use App\Models\sellerinquiryfile;
use App\Models\sellerkeyword;
use App\Models\keyword;
use App\Models\notification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\inquery;
use App\Mail\keywordmail;
use Mail;
use App\Mail\inquiryacceptemail;
use App\Models\buyer;
use App\Mail\quotationsendemail;
use App\Models\area;

class sellercontroller extends Controller
{
    public function sellerprofile()
    {
        $user = Auth::user();
        $seller=seller::where('email',$user->email)->first();
        $keyword=keyword::where(['status'=>1])->get();
        $area=area::get();
        if($seller !==null)
        {
            $sellerkeyword=sellerkeyword::with('keyword')->where('seller_id',$seller->id)->get();
           
            return view('seller.profile.sellerprofile',compact('sellerkeyword','keyword','user','seller','area'));
        }
        else
        {
            return view('seller.profile.sellerprofile',compact('keyword','user','seller','area'));
        }
        
       
    }

    public function sellerbid()
    {
        $user = Auth::user();
        $seller=seller::where('email',$user->email)->first();
        if($seller !==null)
        {
            $sellerquerys=sellerquery::with('inquery','seller','inquirystatus')->where('seller_id',$seller->id)->get();
             return view('seller.bid.sellerbid',compact('sellerquerys'));
        }else
        {
            return view('seller.bid.sellerbid');
        }
    }

    public function findquotation(Request $request)
    {
        $sellerquery=sellerquery::with('inquery','seller','buyer')->where('id',$request->id)->first();
        $sellerinquiryfile=sellerinquiryfile::where('sellerquerys_id',$sellerquery->id)->get();
        $html=view('seller.bid.quotation',compact('sellerquery','sellerinquiryfile'))->render();
        return response()->json(['html' => $html]);
    }

    public function updatequotation(Request $request)
    {
        
        $sellerquery=sellerquery::find($request->id);
        $sellerquery->amount=$request->input('amount');
        $sellerquery->details=$request->input('details');
        $sellerquery->inquery_status='4';
        $sellerquery->save();

        inquery::where('id',$sellerquery->inquery_id)->update(['inquery_status'=>7]);
            

        $Files = $request->file('file');
        if($Files) {
            foreach ($Files as $pdfFile) {
                $sellerinquiryfile= new sellerinquiryfile();
                $sellerinquiryfile->sellerquerys_id=$sellerquery->id;
                $extension = $pdfFile->getClientOriginalExtension();
                $dir = public_path() . '/uploads/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $pdfFile->move($dir, $filename);
                $sellerinquiryfile->file = $filename;
                $sellerinquiryfile->save();
            }
        }
            $keyword=keyword::where('id',$sellerquery->keyword_id)->first();
            $seller=seller::where('id',$sellerquery->seller_id)->first();
            $buyer=buyer::where('id',$sellerquery->buyer_id)->first();
            $mailData = [
                'keyword'=>$keyword->name,
                'seller'=>$seller->first_name . ' ' .$seller->last_name,
                'buyer'=>$buyer->first_name. ' '.$buyer->last_name,
                'date'=>$keyword->created_at
            ];
            
            Mail::to($buyer->email)->send(new quotationsendemail($mailData));
        return redirect()->route('sellerbid')->with('successmsg','Quotation Send Successfully ...');
    }

    public function deletesellerquery($id)
    {
        sellerinquiryfile::where('sellerquerys_id',$id)->delete();
        sellerquery::where('id',$id)->delete();
        return redirect()->route('sellerbid');
    }

    public function sellerkeyworddelete($id)
    {
        sellerkeyword::where('id',$id)->delete();
        return redirect()->route('sellerprofile')->with('warningsmsg','Product Deleted ...');
    }

    public function sellerkeywordadd(Request $request)
    {
        $user = Auth::user();
        $seller=seller::where('email',$user->email)->first();
        $checksellerkeyword=sellerkeyword::where('keyword_id',$request->input('keyword'))->
                                            where('seller_id',$seller->id)->first();
        if($checksellerkeyword == null)
        {
            $sellerkeyword=new sellerkeyword();
            $sellerkeyword->keyword_id=$request->input('keyword');
            $sellerkeyword->seller_id=$seller->id;
            $sellerkeyword->save();
            return redirect()->route('sellerprofile')->with('successmsg','Product Add Successfully ...');
        }else
        {
             return redirect()->route('sellerprofile')->with('warningsmsg','Product Already in List ...');
        }
        
    }

    public function storesellerkeyword(Request $request)
    {
        $checkkeyword=keyword::where('name',$request->input('name'))->first();
        if($checkkeyword == null)
        {
            $user = Auth::user();
            $admin=User::where(['status'=>1])->first();
            $seller=seller::where('email',$user->email)->first();
            $keyword=new keyword();
            $keyword->name=$request->input('name');
            $keyword->created_by=$seller->id;
            $keyword->status=0;
            $keyword->type="seller";
            $keyword->save();

            $notification=new notification();
            $notification->sender_type='seller';
            $notification->received_id=$admin->id;
            $notification->sender_id=$seller->id;
            $notification->received_type='admin';
            $notification->title='Keyword Request';
            $notification->message = $seller->first_name . ' ' . $seller->last_name . ' has requested a keyword';
            $notification->save();

            $mailData = [
                'keyword'=>$request->input('name'),
                'seller'=>$seller->first_name . ' ' .$seller->last_name,
                'admin'=>$admin->name,
                'date'=>$keyword->created_at
            ];

            $user=User::where(['role'=>1])->first();
            Mail::to($user->email)->send(new keywordmail($mailData));

            return redirect()->route('sellerprofile')->with('successmsg','Inquiry for Product change send to  Admin Successfully..');
        }else
        {
            return redirect()->route('sellerprofile')->with('warningsmsg','Product Already in List..');
        }
       
    }

    public function sellerprofileupdate(Request $request)
    {
       // dd($request->all());
            $seller=seller::find($request->seller_id);
            $seller->first_name=$request->input('first_name');
            $seller->last_name=$request->input('last_name');
            $seller->area =$request->input('area');
            $seller->pincode =$request->input('pincode');
            $seller->entity =$request->input('entity');
            $seller->business_name =$request->input('business_name');
            $seller->gst =$request->input('gst');
            $seller->business_area =$request->input('business_area');
            $seller->business_pincode =$request->input('business_pincode');

             $user=User::find($request->id);
             $user->name=$request->input('first_name') . ' ' . $request->input('last_name');

            if($request->mobile_number){
                $checkmobile=user::where('mobile',$request->mobile_number)->first();
                if($checkmobile == null){
                    $seller->mobile=$request->mobile_number;
                    $user->mobile=$request->mobile_number;
                  }
            }

            if($request->email){
                $checkemail=user::where('email',$request->email)->first();
                if($checkemail == null){
                    $seller->email=$request->email;
                    $user->email=$request->email;
                }
            }  
              if($request->input('password')){
                $user->password=Hash::make($request->input('password'));
            }
            $user->save();
            $seller->save();

        return redirect()->route('sellerprofile')->with('successmsg','Profile Update Successfully..');

    }

    public function loadquerymodel(Request $request)
    {
        $user = Auth::user();
        $seller=seller::where('email',$user->email)->first();
        $sellerquery=sellerquery::with('inquery','seller','inquirystatus','keyword')->where('seller_id',$seller->id)->where(['inquery_status'=>1])->get();
        return response()->json(['sellerquery'=>$sellerquery]);
    }

    public function sellerqueryaccept(Request $request)
    {   
        $sellerquery=sellerquery::where('id',$request->id)->first();
        $seller=seller::where('id',$sellerquery->seller_id)->first();
        $todayDate = Carbon::now();
        $quotation_time_start = Carbon::now()->format('H:i:m');
        $quotationaddtime=$todayDate->addMinutes(20);
        $quotation_time_end = $quotationaddtime->format('H:i:m');

        sellerquery::where('id',$request->id)->update(['inquery_status'=>2 , 'response_date'=>$todayDate ,'quotation_time_start'=>$quotation_time_start ,'quotation_time_end'=>$quotation_time_end]);
        inquery::where('id',$sellerquery->inquery_id)->update(['inquery_status'=>2]);
        
        $notification=new notification();
        $notification->sender_type='seller';
        $notification->received_id=$sellerquery->buyer_id;
        $notification->sender_id=$seller->id;
        $notification->received_type='buyer';
        $notification->title='Inquiry Accepted';
        $notification->message=$seller->first_name . $seller->last_name . ' has Inquiry Accepted ';
        $notification->save();

        $buyer=buyer::where('id',$sellerquery->buyer_id)->first();
        $keyword=keyword::where('id',$sellerquery->keyword_id)->first();

        $mailData = [
                'keyword'=>$keyword->name,
                'seller'=>$seller->first_name . ' ' .$seller->last_name,
                'buyer'=>$buyer->first_name . ' ' .$buyer->last_name,
                'date'=>$todayDate
            ];
        Mail::to('loopcon1018@gmail.com')->send(new inquiryacceptemail($mailData));

        return response()->json(['id'=>$request->id]);
    }

    public function sellerqueryreject(Request $request)
    {
        $sellerquery=sellerquery::where('id',$request->id)->first();
        $seller=seller::where('id',$sellerquery->seller_id)->first();
        $todayDate = Carbon::now();
        sellerquery::where('id',$request->id)->update(['inquery_status'=>3 , 'response_date'=>$todayDate]);
        inquery::where('id',$sellerquery->inquery_id)->update(['inquery_status'=>3]);
        $notification=new notification();
        $notification->sender_type='seller';
        $notification->received_id=$sellerquery->buyer_id;
        $notification->sender_id=$seller->id;
        $notification->received_type='buyer';
        $notification->title='Inquiry Rejected';
        $notification->message=$seller->first_name . $seller->last_name . ' has Inquiry Rejected ';
        $notification->save();

        return response()->json(['id'=>$request->id]);
    }

    public function selfsellerqueryreject(Request $request)
    {
        $sellerqueryid=sellerquery::where('id',$request->id)->first();
        sellerquery::where('id',$request->id)->update(['inquery_status'=>3]);
        inquery::where('id',$request->inquery_id)->update(['inquery_status'=>3]);
        return response()->json(['id'=>$request->id]);
    }
}
