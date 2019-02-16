<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settlement;
use App\Models\PaymentExtend;
use Illuminate\Http\Request;
use Validator;

class SettlementController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index settlement'])->only(['index']);
        $this->middleware(['permission:add settlement'])->only(['create']);
        $this->middleware(['permission:edit settlement'])->only(['edit']);
        $this->middleware(['permission:delete settlement'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Settlement = new \App\Models\Settlement();
        return view('settlements.index', ['model' => $Settlement->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settlements.create');
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
            $addData = new \App\Models\Settlement();
            return $addData->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Settlement $settlement)
    {
        return view('settlements.show', compact('settlement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Settlement $settlement)
    {
        return view('settlements.edit', compact('settlement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Settlement $settlement, Request $request)
    {
        if ($request->isMethod('put')) {
            $settlements = new \App\Models\Settlement();
            return $settlements->updateData($request->all(), $settlement);
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

            $paymentExtend = PaymentExtend::whereIn('payment_type', $idArray)->first();

            if ($paymentExtend){
                return '删除结算方式失败，辅助资料已被使用！';
            }else{
                \App\Models\Settlement::destroy($idArray);
                return 'true';
            }





        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $settlement = new \App\Models\Settlement();
            return $settlement->checkUnique($request->all());
        }
    }
}
