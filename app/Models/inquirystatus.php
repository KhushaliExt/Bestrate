<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inquirystatus extends Model
{
    use HasFactory;

    protected $table = 'inquiry_status';
    
      public function inquery()
    {
        return  $this->hasMany(inquery::class,'inquery_status');
    }
}
