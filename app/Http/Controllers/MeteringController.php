<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class MeteringController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index metering'])->only(['index']);
        $this->middleware(['permission:add metering'])->only(['create']);
        $this->middleware(['permission:edit metering'])->only(['edit']);
        $this->middleware(['permission:delete metering'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Metering = new \App\Models\Metering();
        return view('meterings.index', ['model' => $Metering->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meterings.create');
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
            $addData = new \App\Models\Metering();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Metering $metering)
    {
        return view('meterings/show', compact('metering'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Metering $metering)
    {
        return view('meterings/edit', compact('metering'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Metering $metering, Request $request)
    {
        if ($request->isMethod('put')) {
            $meterings = new \App\Models\Metering();
            return $meterings->updateData($request->all(), $metering);
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
            \App\Models\Metering::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $metering = new \App\Models\Metering();
            return $metering->checkUnique($request->all());
        }
    }
}
