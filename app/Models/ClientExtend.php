<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientExtend extends Model
{
    protected $fillable = [
        'contacts',
        'c_id',
        'phone',
        'landline',
        'qq',
        'address',
        'info'
    ];

    public $timestamps = false;
}
