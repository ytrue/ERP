<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class LogController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index log'])->only(['index']);
    }

    public function index()
    {
       $log = Log::orderBy('created_at', 'desc')->paginate(10);
        return view('log.index',[
            'model' => $log
        ]);
    }
}
