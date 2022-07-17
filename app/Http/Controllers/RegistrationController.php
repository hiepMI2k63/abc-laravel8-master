<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class RegistrationController extends Controller
{

    public function create() {
        return view('admin.registration');
    }

    // ----------- [ Form validate ] -----------
    public function store(Request $request) {

        $request->validate(
            [
                "name" => 'required',
                "email" => 'required|email|unique:users',
                "password" => 'required|confirmed',
            ],
            [
                "name.required" => "Tên không được để trống",
                "email.required" => "Email không được để trống",
                "email.unique" => "Email đã tồn tại",
                "email.email" => "Email không đúng định dạng",
                "password.required" => "Mật khẩu không được để trống",
                "password.confirmed" => "Nhập lại mật khẩu không chính xác",
            ]
        );
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);

        $dataArray = array(
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        );

        $user = User::create($dataArray);
        auth()->login($user);

        return redirect()->route('home');;

    }
}
