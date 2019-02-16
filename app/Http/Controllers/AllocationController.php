<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Goods;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AllocationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index allocation'])->only(['index']);
        $this->middleware(['permission:add allocation'])->only(['create']);
    }

    public function index()
    {
        $model = Allocation::paginate(10);
        return view('allocations.index', ['model' => $model]);
    }


    /**
     *  add data
     */
    public function create()
    {
        $goods = Goods::all();
        $warehouse = Warehouse::where('status', '1')->get();
        return view('allocations.create', ['warehouse' => $warehouse, 'goods' => $goods]);
    }

    /**
     * add data
     */

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $allocation = new Allocation();
            return $allocation->addData($request->all());
        }
    }

    /**
     * show data
     */

    public function show($id)
    {
        $allocation = Allocation::find($id);
        return view('allocations.show', compact('allocation'));
    }


}
