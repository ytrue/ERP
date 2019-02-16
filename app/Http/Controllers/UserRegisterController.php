<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index user'])->only(['index']);
        $this->middleware(['permission:add user'])->only(['create']);
        $this->middleware(['permission:edit user'])->only(['edit']);
        $this->middleware(['permission:delete user'])->only(['destroy']);
        $this->middleware(['permission:user permission'])->only(['permission']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('created_at')->get();
        return view('userRegister.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userRegister.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userRegister = new UserRegister();
        $validator = \Validator::make($request->all(), $userRegister->rules());
        if ($validator->fails()) {
            return redirect('user_register/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $name = \request('name');
            $password = bcrypt(\request('password'));
            $email = \request('email');
            $phone = \request('phone');
            $real_name = \request('real_name');
            $user = User::create(compact('name', 'email', 'password', 'phone', 'real_name'));
            if ($user) return redirect('/supplier')->with('success', '数据添加成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function permission($id)
    {
        $user = User::find($id);
        $permission = [];
        foreach ($user->permissions as $key => $value){
            $permission[$key]= $value->name;
        }
        return view('userRegister.permission', [
            'permission' => $permission,
            'user' => $user
        ]);
    }

    public function addPermission()
    {
        $user = User::find(\request('user_id'));
        DB::beginTransaction();
        try{
            DB::table('model_has_permissions')->where('model_id', \request('user_id'))->delete();
            $permission = json_decode(\request('permission'));
            $user->givePermissionTo($permission);
            DB::commit();
            return 'true';
        }catch (\Exception $exception){
            DB::rollBack();
        }

    }
}
