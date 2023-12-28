<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellerquery extends Model
{
    use HasFactory;
    protected $table = 'sellerquerys';

    protected $fillable = ['seller_id','buyer_id','inquery_id','keyword_id','amount','inquery_status','status','response_date','inquiry_time','quotation_time_start','timer','quotation_time_end','details'];

    public function seller()
    {
        return $this->belongsTo(seller::class,'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(buyer::class,'buyer_id');
    }

     public function inquery()
    {
        return  $this->belongsTo(inquery::class,'inquery_id');
    }

    public function inquirystatus()
    {
        return $this->belongsTo(inquirystatus::class,'inquery_status');
    }

    public function keyword()
    {
        return $this->belongsTo(keyword::class,'keyword_id');
    }
}
