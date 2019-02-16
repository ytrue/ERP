<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemParameterController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index log'])->only(['index']);
    }

    public function index()
    {
        return view('systemParameter.index');
    }

    public function update()
    {
        return redirect('/system_parameter');
    }
}
