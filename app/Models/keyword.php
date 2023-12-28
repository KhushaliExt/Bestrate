<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sellerkeyword;
use App\Models\inquery;
use App\Models\seller;

class keyword extends Model
{
    use HasFactory;
    protected $table = 'keywords';

    public function sellerkeyword()
    {
        return  $this->hasMany(sellerkeyword::class,'keyword_id');
    }

    public function seller()
    {
        return $this->belongsTo(seller::class,'created_by');
    }

     public function inquery()
    {
        return  $this->hasMany(inquery::class,'keyword_id');
    }
}
