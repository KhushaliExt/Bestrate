<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellerinquiryfile extends Model
{
     use HasFactory;

     protected $fillable = ['sellerquerys_id','file'];

     protected $table = 'sellerquerys_files';
}
