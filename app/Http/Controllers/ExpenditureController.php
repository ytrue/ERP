<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class ExpenditureController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index expenditure'])->only(['index']);
        $this->middleware(['permission:add expenditure'])->only(['create']);
        $this->middleware(['permission:edit expenditure'])->only(['edit']);
        $this->middleware(['permission:delete expenditure'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Expenditure = new \App\Models\Expenditure();
        return view('expenditures.index', ['model' => $Expenditure->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenditures.create');
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
            $addData = new \App\Models\Expenditure();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Expenditure $expenditure)
    {
        return view('expenditures/show', compact('expenditure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Expenditure $expenditure)
    {
        return view('expenditures/edit', compact('expenditure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Expenditure $expenditure, Request $request)
    {
        if ($request->isMethod('put')) {
            $expenditures = new \App\Models\Expenditure();
            return $expenditures->updateData($request->all(), $expenditure);
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
            \App\Models\Expenditure::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $expenditure = new \App\Models\Expenditure();
            return $expenditure->checkUnique($request->all());
        }
    }
}
