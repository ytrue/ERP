<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuppliermanagementExtend extends Model
{
    public $timestamps = false;
    protected $fillable = [
        's_id',
        'contacts',
        'phone',
        'landline',
        'qq',
        'address'
    ];


}
