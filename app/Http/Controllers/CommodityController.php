<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class CommodityController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index commodity'])->only(['index']);
        $this->middleware(['permission:add commodity'])->only(['create']);
        $this->middleware(['permission:edit commodity'])->only(['edit']);
        $this->middleware(['permission:delete commodity'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Commodity = new \App\Models\Commodity();
        return view('commodities.index', ['model' => $Commodity->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commodities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $addData = new \App\Models\Commodity();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Commodity $commodity)
    {
        return view('commodities/show', compact('commodity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Commodity $commodity)
    {
        return view('commodities/edit', compact('commodity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Commodity $commodity, Request $request)
    {
        if ($request->isMethod('put')) {
            $commodities = new \App\Models\Commodity();
            return $commodities->updateData($request->all(), $commodity);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (\request()->isMethod('delete')) {
            $idArray = json_decode($request->input('id'));
            \App\Models\Commodity::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $commodity = new \App\Models\Commodity();
            return $commodity->checkUnique($request->all());
        }
    }
}
