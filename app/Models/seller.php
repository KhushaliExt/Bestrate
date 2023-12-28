<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sellerkeyword;
use App\Models\keyword;

class seller extends Model
{
    use HasFactory;


    public function sellerkeyword()
    {
        return  $this->hasMany(sellerkeyword::class,'seller_id');
    }

    public function sellerquery()
    {
        return  $this->hasMany(sellerquery::class,'seller_id');
    }

    public function keyword()
    {
        return  $this->hasMany(keyword::class,'created_by');
    }
}
