<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\seller;
use App\Models\keyword;

class sellerkeyword extends Model
{
    use HasFactory;
    protected $table = 'sellerkeyword';

    public function keyword()
    {
        return $this->belongsTo(keyword::class,'keyword_id');
    }

    public function seller()
    {
        return $this->belongsTo(seller::class,'seller_id');
    }
}
