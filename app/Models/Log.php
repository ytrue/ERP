<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2019/2/15
 * Time: 18:36
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $table = 'log';
    protected $fillable = [
        'user_id',
        'message'
    ];

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
