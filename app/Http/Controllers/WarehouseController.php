<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index warehouse'])->only(['index']);
        $this->middleware(['permission:add warehouse'])->only(['create']);
        $this->middleware(['permission:edit warehouse'])->only(['edit']);
        $this->middleware(['permission:delete warehouse'])->only(['destroy']);
        $this->middleware(['permission:status warehouse'])->only(['status']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Warehouse = new Warehouse();
        return view('warehouses.index', ['model' => $Warehouse->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouses.create');
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
            $Warehouse = new Warehouse();
            return $Warehouse->addData($request->all());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Warehouse $warehouse, Request $request)
    {
        if ($request->isMethod('put')) {
            $Satff = new Warehouse();
            return $Satff->updateData($request->all(), $warehouse);
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
            \App\Models\Warehouse::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $warehouse = new \App\Models\Warehouse();
            if ($request->input('key') == 1) {
                return $warehouse->checkUnique($request->all(), 'name');
            } else {
                return $warehouse->checkUnique($request->all(), 'number');
            }
        }
    }

    /*修改状态*/
    public function status(Warehouse $warehouse)
    {
        if ($warehouse->status == '<span class="label label-primary">已启动</span>') {
            $warehouse->update(['status' => 2]);
            return '2';
        } else {
            if ($warehouse->status == '<span class="label label-danger">已禁用</span>') {
                $warehouse->update(['status' => 1]);
                return '1';
            }
        }

    }
}
