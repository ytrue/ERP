<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return view('index.index');
    }
}
