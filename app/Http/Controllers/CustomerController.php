<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index customer'])->only(['index']);
        $this->middleware(['permission:add customer'])->only(['create']);
        $this->middleware(['permission:edit customer'])->only(['edit']);
        $this->middleware(['permission:delete customer'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Customer = new \App\Models\Customer();
        return view('customers.index', ['model' => $Customer->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            $addData = new \App\Models\Customer();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Customer $customer)
    {
        return view('customers/show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Customer $customer)
    {
        return view('customers/edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Customer $customer, Request $request)
    {
        if ($request->isMethod('put')) {
            $customers = new \App\Models\Customer();
            return $customers->updateData($request->all(), $customer);
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
            \App\Models\Customer::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $customer = new \App\Models\Customer();
            return $customer->checkUnique($request->all());
        }
    }
}
