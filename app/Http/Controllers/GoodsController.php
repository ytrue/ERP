<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use App\Models\Goods;
use App\Models\GoodsExtend;
use App\Models\Metering;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index goods'])->only(['index']);
        $this->middleware(['permission:add goods'])->only(['create']);
        $this->middleware(['permission:edit goods'])->only(['edit']);
        $this->middleware(['permission:delete goods'])->only(['destroy']);
        $this->middleware(['permission:status goods'])->only(['status']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = new Goods();
        return view('goods.index', ['model' => $goods->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commodity = Commodity::all();
        $metering = Metering::all();
        return view('goods.create', compact('commodity', 'metering'));
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
            $goods = new Goods();
            return $goods->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods = Goods::find($id);
        return view('goods.show', compact('goods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commodity = Commodity::all();
        $metering = Metering::all();
        $goods = Goods::find($id);
        return view('goods.edit', ['goods' => $goods, 'commodity' => $commodity, 'metering' => $metering]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if ($request->isMethod('put')) {
            $good = new Goods();
            return $good->updateData($request->all(), $id);
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
            \App\Models\Goods::destroy($idArray);
            return 'true';
        }
    }

    /*修改状态*/
    public function status(Goods $goods)
    {
        if ($goods->status == '<span class="label label-primary">已启动</span>') {
            $goods->update(['status' => 2]);
            return '2';
        } else {
            if ($goods->status == '<span class="label label-danger">已禁用</span>') {
                $goods->update(['status' => 1]);
                return '1';
            }
        }
    }


    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $warehouse = new \App\Models\Goods();
            if ($request->input('key') == 1) {
                return $warehouse->checkUnique($request->all(), 'name');
            } else {
                if ($request->input('key') == 2) {
                    return $warehouse->checkUnique($request->all(), 'number');
                } else {
                    if ($request->input('key') == 3) {
                        return $warehouse->checkUnique($request->all(), 'bar_code');
                    }
                }
            }
        }
    }
}
