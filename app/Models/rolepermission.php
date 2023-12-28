<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolepermission extends Model
{
    use HasFactory;

    protected $table = 'rolepermission';

    public function permission()
    {
        return $this->belongsTo(Permission::class,'permission_id');
    }
}
