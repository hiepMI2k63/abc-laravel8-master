<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException ;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data=User::paginate(15);

        if ($key=request()->key){
            $data=User::where('name','like','%'.$key.'%')->paginate(15);
        }

        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change( Request $request , $id)
    {
        $user =User::find($id);
        $user->status = $request->status;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()){
            return redirect()->route('admin.usermanagement.index')->with('success','thay đổi thành công.');
        }

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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function modifile($id )
    {
        $user =User::find($id);
        return view('admin.user.edit',["user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        // if ($user->update($request->all())){
        //     return redirect()->route('admin.user.index')->with('success','Thêm mới thành công.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function deleteuser($id )
    {

        $user =User::find($id);
//dd($user);
        $user->delete();
        return redirect()->route('admin.usermanagement.index')->with('delete','xóa thành công.');
    }
}
