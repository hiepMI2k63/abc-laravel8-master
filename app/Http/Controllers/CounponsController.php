<?php

namespace App\Http\Controllers;
use App\Models\Counpon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CounponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Counpon::where('code', 'like', '%'.$key.'%')->paginate(5);
        }
        else {
            $data = Counpon::paginate(2);
        }

        return view('admin.counpons.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.counpons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
            'code'=>'required|unique:counpons,code',

        ],
        [
            'code.required' => 'Cần nhập tên nhóm sản phẩm',
            'code.unique' => 'Tên nhóm sản phẩm cần duy nhất',


        ]
        );

        if (Counpon::create($request->all())){
            return redirect()->route('admin.counpons.index')->with('success','Thêm mới thành công.');
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
    public function edit(Counpon $counpon)
    {
        return view('admin.counpons.edit',["counpon"=>$counpon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counpon $counpon )
    {

        if ($counpon->update($request->all())){

            return redirect()->route('admin.counpons.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counpon $counpon)
    {
         //

            $counpon->delete();
            return redirect()->route('admin.counpons.index')->with('success','Xóa bản ghi thành công.');
    }
}
