<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodsFlowDetailsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index goodsFlowDetails']);
    }

    public function index()
    {
        return view('goodsFlowDetails.index');
    }
}
