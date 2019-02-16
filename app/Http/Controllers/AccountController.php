<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Validator;

class AccountController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index account'])->only(['index']);
        $this->middleware(['permission:add account'])->only(['create']);
        $this->middleware(['permission:edit account'])->only(['edit']);
        $this->middleware(['permission:delete account'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Account = new Account();
        return view('settlement_accounts.index', ['model' => $Account->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settlement_accounts.create');
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
            $Account = new Account();
            return $Account->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Account $account)
    {

        return view('settlement_accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Account $account)
    {

        return view('settlement_accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Models\Account $account, Request $request)
    {
        if (\request()->isMethod('put')) {
            $Account = new Account();
            return $account->updateData($request->all(), $account);
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
            \App\Models\Account::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $settlement = new \App\Models\Account();
            if ($request->input('key') == 1) {
                return $settlement->checkUnique($request->all(), 'name');
            } else {
                return $settlement->checkUnique($request->all(), 'number');
            }
        }
    }
}
