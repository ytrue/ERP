<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return view('layouts.layouts');
    }
}
