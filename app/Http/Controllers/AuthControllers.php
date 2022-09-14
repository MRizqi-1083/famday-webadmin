<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;

class AuthControllers extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('success')) {
            return view('dashboard');
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|min:5|email|max:100',
                'password' => 'required|string|min:4',
            ],
            [
                'required'  => ':attribute harus diisi',
                'min'       => ':attribute minimal :min karakter',
            ]
        );

        if ($validator->fails()) {
            return redirect('/')->withFail($validator->errors()->first());
        }

        $user = UsersModel::where('user_email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->user_password)) {
                $time = date('Y-m-d H:i:s');
                $request->session()->push("sesi", $user);
                return redirect('/');
            } else {
                return redirect('/')->withFail("Password tidak sesuai!");
            }
        } else {
            return redirect('/')->withFail("Akun email tidak ditemukan!");
        }
    }
}
