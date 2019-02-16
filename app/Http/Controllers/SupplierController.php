<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index supplier'])->only(['index']);
        $this->middleware(['permission:add supplier'])->only(['create']);
        $this->middleware(['permission:edit supplier'])->only(['edit']);
        $this->middleware(['permission:delete supplier'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Supplier = new \App\Models\Supplier();
        return view('suppliers.index', ['model' => $Supplier->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            $addData = new \App\Models\Supplier();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Supplier $supplier)
    {
        return view('suppliers/show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Supplier $supplier)
    {
        return view('suppliers/edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Supplier $supplier, Request $request)
    {
        if ($request->isMethod('put')) {
            $suppliers = new \App\Models\Supplier();
            return $suppliers->updateData($request->all(), $supplier);
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
            \App\Models\Supplier::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $supplier = new \App\Models\Supplier();
            return $supplier->checkUnique($request->all());
        }
    }
}
