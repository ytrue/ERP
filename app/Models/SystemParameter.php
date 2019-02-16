<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    public $table = 'system_parameter';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'fax',
        'zip_code',
        'standard_currency',
        'inventory_valuation_method'
    ];
}
