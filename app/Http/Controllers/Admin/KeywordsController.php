<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\keyword;
use App\Models\notification;
use Auth;
use App\Models\seller;
use Mail;
use App\Mail\keywordrequestmail;

class KeywordsController extends Controller
{
    public function viewkeywordrequest()
    {
        $keyword=keyword::with('seller')->where('status',0)->orderby('id','DESC')->get();
        return view('admin.keyword.viewkeywordrequest',compact('keyword'));
    }

    public function requestkeywordstatus($id , $status)
    {
        keyword::where('id',$id)
        ->update(['status'=>$status]);
        $keyword=keyword::where('id',$id)->first();
         if($status == 1)
        {
            $newstatus ='Approved';
        }
        elseif($status  == 2)
        {
            $newstatus ='Rejected';
        }else
        {
             $newstatus ='Pending';
        }
        $seller=keyword::where('id',$id)->first();
        $email=seller::where('id',$seller->created_by)->first();
      
            $mailData = [
                'status' =>$newstatus,
                'keyword'=>$seller->name,
                'body' => 'This is for testing email using smtp.',
                'email'=>$email->first_name . ' ' . $email->last_name
            ];
              Mail::to($email->email)->send(new keywordrequestmail($mailData));

        if($keyword == !null)
        {
            $user = Auth::user();
            $seller=seller::where('id',$keyword->created_by)->first();
            $notification=new notification();
            if($seller !==null)
            {
            $notification->sender_type='admin';
            $notification->received_type='seller';
            $notification->sender_id=$user->id;
            $notification->received_id=$seller->id;
            if($status == 1)
            {
                $notification->title='Product Request Accepted';
                $notification->message='Product Request Accepted By Admin';
            }else{

                $notification->title='Product Request Rejected';
                $notification->message='Product Request Rejected By Admin';
            }
            $notification->save();
            }
            
        }
        return redirect()->route('admin.viewkeywordrequest')->with('successmsg','Status Change Successfully..');
    }

    public function keyword()
    {
      $keyword = keyword::with('seller')->whereIn('status', [ '1', '2'])->get();
        return view('admin.keyword.keyword',compact('keyword'));
    }

    public function storekeyword(Request $request)
    {
        if($request->input('name') !== ' ')
        {
            $findkeyword=keyword::where('name',$request->input('name'))->first();
            if($findkeyword == null)
            {
                $keyword= new keyword();
                $keyword->name=$request->input('name');
                $keyword->created_by='Admin';
                $keyword->status=1;
                $keyword->save();
                return redirect()->route('admin.keyword')->with('successmsg','Product Add Successfully..');
            }
            else
            {
                return redirect()->route('admin.keyword')->with('warningsmsg','Product Already in List..');
            }
        }else
        {
            return redirect()->route('admin.keyword')->with('warningsmsg','Enter Product Name..');
        }     
        
    }

    public function update(Request $request)
    {
        $keyword= keyword::find($request->id);
        $keyword->name=$request->input('name');
        $keyword->save();
        return redirect()->route('admin.keyword')->with('successmsg','Product Update Successfully..');   
    }

    public function delete($id)
    {
        keyword::where('id',$id)
        ->update(['status'=>'3']);
        return redirect()->route('admin.keyword')->with('warningsmsg','Product Deleted..');
    }
    public function keywordstatus($id ,$status)
    {
        keyword::where('id',$id)
        ->update(['status'=>$status]);

        if($status == 1)
        {
            $newstatus ='Approved';
        }
        elseif($status  == 2)
        {
            $newstatus ='Rejected';
        }else
        {
             $newstatus ='Pending';
        }
        $seller=keyword::where('id',$id)->first();
        $email=seller::where('id',$seller->created_by)->first();
        if($seller->created_by !=='Admin') 
        {
            $mailData = [
                'status' =>$newstatus,
                'keyword'=>$seller->name,
                'body' => 'This is for testing email using smtp.',
                'email'=>$email->first_name . ' ' . $email->last_name
            ];
              Mail::to($email->email)->send(new keywordrequestmail($mailData));
        }
      
        return redirect()->route('admin.keyword')->with('successmsg','Status Change Successfully..');
    }
}
