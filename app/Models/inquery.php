<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\keyword;

class inquery extends Model
{
    use HasFactory;

    protected $table = 'inquiry';

    public function keyword()
    {
        return $this->belongsTo(keyword::class,'keyword_id');
    }

     public function inquirystatus()
    {
        return $this->belongsTo(inquirystatus::class,'inquery_status');
    }
}
