<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index staff'])->only(['index']);
        $this->middleware(['permission:add staff'])->only(['create']);
        $this->middleware(['permission:edit staff'])->only(['edit']);
        $this->middleware(['permission:delete staff'])->only(['destroy']);
        $this->middleware(['permission:status staff'])->only(['status']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Staff = new Staff();
        return view('staffs.index', ['model' => $Staff->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffs.create');
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
            $Staff = new Staff();
            return $Staff->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view('staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Staff $staff, Request $request)
    {
        if ($request->isMethod('put')) {
            $Satff = new Staff();
            return $Satff->updateData($request->all(), $staff);
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
            \App\Models\Staff::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $staff = new \App\Models\Staff();
            if ($request->input('key') == 1) {
                return $staff->checkUnique($request->all(), 'name');
            } else {
                return $staff->checkUnique($request->all(), 'number');
            }
        }
    }

    /*修改状态*/
    public function status(Staff $staff)
    {
        if ($staff->status == '<span class="label label-primary">已启动</span>') {
            $staff->update(['status' => 2]);
            return '2';
        } else {
            if ($staff->status == '<span class="label label-danger">已禁用</span>') {
                $staff->update(['status' => 1]);
                return '1';
            }
        }

    }
}
