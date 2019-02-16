<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class IncomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index income'])->only(['index']);
        $this->middleware(['permission:add income'])->only(['create']);
        $this->middleware(['permission:edit income'])->only(['edit']);
        $this->middleware(['permission:delete income'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Income = new \App\Models\Income();
        return view('incomes.index', ['model' => $Income->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incomes.create');
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
            $addData = new \App\Models\Income();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Income $income)
    {
        return view('incomes/show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Income $income)
    {
        return view('incomes/edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Income $income, Request $request)
    {
        if ($request->isMethod('put')) {
            $incomes = new \App\Models\Income();
            return $incomes->updateData($request->all(), $income);
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
            \App\Models\Income::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $income = new \App\Models\Income();
            return $income->checkUnique($request->all());
        }
    }
}
