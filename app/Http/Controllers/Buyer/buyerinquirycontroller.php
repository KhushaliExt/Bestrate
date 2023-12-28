<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\keyword;
use App\Models\inquery;
use App\Models\inquiryfile;
use App\Models\inquirystatus;
use Auth;
use App\Models\User;
use App\Models\sellerquery;
use App\Models\sellerkeyword;
use App\Models\buyer;
use App\Models\seller;
use App\Models\notification;
use Carbon\Carbon;
use App\Models\sellerinquiryfile;
use App\Mail\inquirycreatemail;
use App\Mail\inquirygetemail;
use Mail;

class buyerinquirycontroller extends Controller
{
    
    public function viewbuyerinquiry()
    {
        $user = Auth::user();
        $buyer=buyer::where('email',$user->email)->first();
        $inquery=inquery::with('keyword','inquirystatus')->where('buyer_id',$buyer->id)->get();
        return view('buyer.inquiry.viewbuyerinquiry',compact('inquery'));
    }
    public function createinquiry()
    {
        $keyword=keyword::where(['status'=>1])->get();
        return view('buyer.inquiry.createinquiry',compact('keyword'));
    }

    public function postbuyerinquiries(Request $request)
    {

        $sellerkeyword = sellerkeyword::where('keyword_id', $request->keyword_id)
            ->whereHas('seller', function ($query) {
                $query->where('status', 1);
            })
        ->get();

        $todayDate = Carbon::now()->format('H:i:m');
        $user = Auth::user();
        $buyer=buyer::where('email',$user->email)->first();
        $inquery= new inquery();
        $inquery->buyer_id=$buyer->id;
        $inquery->quantity=$request->input('quantity');
        $inquery->keyword_id=$request->input('keyword_id');
        $inquery->budget_start=$request->input('budget_start');
        $inquery->budget_end=$request->input('budget_end');
        $inquery->inquery_status=1;
        $inquery->description=$request->input('description');
        $inquery->save();

        $keyword=keyword::where('id',$request->input('keyword_id'))->first();
        $mailData = [
                'keyword'=>$keyword->name,
                'buyer'=>$buyer->first_name . ' ' .$buyer->last_name,
                'budget'=>$request->input('budget_start') . ' - ' . $request->input('budget_end')
            ];
            Mail::to($buyer->email)->send(new inquirycreatemail($mailData));


        if($sellerkeyword !==null)
        {
            foreach($sellerkeyword as $sellerkeywords)
            {
                $sellerquery=new sellerquery();
                $sellerquery->seller_id=$sellerkeywords->seller_id;
                $sellerquery->buyer_id=$buyer->id;
                $sellerquery->inquery_id=$inquery->id;
                $sellerquery->inquiry_time=$todayDate;
                $sellerquery->keyword_id=$request->input('keyword_id');
                $sellerquery->inquery_status=1;
                $sellerquery->timer=60;
                $sellerquery->save();

                $seller=seller::where('id',$sellerkeywords->seller_id)->first();
                $notification=new notification();
                $notification->sender_type='buyer';
                $notification->received_type='seller';
                $notification->sender_id=$buyer->id;
                $notification->received_id=$seller->id;
                $notification->title="Inquiry Created";
                $notification->message=$seller->first_name . $seller->last_name . " Send a Inquiry";
                $notification->save();

                $mailData = [
                    'keyword'=>$keyword->name,
                    'buyer'=>$buyer->first_name . ' ' .$buyer->last_name
                 ];
                Mail::to($seller->email)->send(new inquirygetemail($mailData));
            }
        }
        
        $Files = $request->file('file');
        if($Files) {
            foreach ($Files as $pdfFile) {
                $inquiryfile= new inquiryfile();
                $inquiryfile->inquiry_id=$inquery->id;
                $extension = $pdfFile->getClientOriginalExtension();
                $dir = public_path() . '/uploads/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $pdfFile->move($dir, $filename);
                $inquiryfile->file = $filename;
                $inquiryfile->save();
            }
        }
        return redirect()->route('viewbuyerinquiry')->with('successmsg','Inquiry Create Successfully..');
    }

    public function inquerydelete($id)
    {
        inquery::where('id', $id)
       ->update([
           'status' => 0
        ]);
       return redirect()->route('viewbuyerinquiry')->with('warningsmsg','Inquiry Deleted..');
    }

    public function buyerinqueryfind(Request $request)
    {
        $user = Auth::user();
        $buyer=buyer::where('email',$user->email)->first();
        $inquery=inquery::with('keyword','inquirystatus')->where('id',$request->id)->first();
        $inquiryfile=inquiryfile::where('inquiry_id',$inquery->id)->get();

        $sellerquery=sellerquery::with('seller')->where('buyer_id',$buyer->id)->where('inquery_id',$request->id)->where(['inquery_status'=>4])->get();
        $sellerqueryaccepted=sellerquery::with('seller')->where('buyer_id',$buyer->id)->where('inquery_id',$inquery->id)->where(['inquery_status'=>5])->get();
        $sellerqueryrejected=sellerquery::with('seller')->where('buyer_id',$buyer->id)->where('inquery_id',$inquery->id)->where(['inquery_status'=>6])->get();
        $sellerinquiryfile=sellerinquiryfile::get();
        $html=view('buyer.inquiry.inquirymodel',compact('inquery','inquiryfile','sellerquery','sellerqueryaccepted','sellerqueryrejected','sellerinquiryfile'))->render();
        return response()->json(['html' => $html]);
    }

    public function sellerquotationaccept($id)
    {
        $seller=sellerquery::where('id',$id)->first();
        sellerquery::where('id',$id)->update(['inquery_status'=>5]);
        inquery::where('id',$seller->inquery_id)->update(['inquery_status'=>5]);
        return redirect()->back()->with('successmsg','Quotation Update Successfully..');
    }

    public function sellerquotationreject($id)
    {
        $seller=sellerquery::where('id',$id)->first();
        sellerquery::where('id',$id)->update(['inquery_status'=>6]);
        inquery::where('id',$seller->inquery_id)->update(['inquery_status'=>6]);
        return redirect()->back()->with('successmsg','Quotation Update Successfully..');
    }
}
