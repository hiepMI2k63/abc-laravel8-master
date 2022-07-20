<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trancision;
use Illuminate\Support\Facades\DB;
class TrancisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Trancision::paginate(10); //$data = Trancision::where('code', 'like', '%'.$key.'%')->paginate(5);
        }
        else {


            $data = Trancision::paginate(10);
        }


        return view('admin.trancision.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $trancision = Trancision::find($id);
        return view('admin.trancision.edit',["trancision"=>$trancision]);
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
       $trancision = Trancision::find($id);
       $trancision->status = $request->status;
       $trancision->save();
       return redirect()->route('admin.trancision.index')->with('success', 'update thành công rồi nha');
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
}
