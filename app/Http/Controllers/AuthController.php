<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $user = User::where([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])->first();

        if ($user) {
            Auth::login($user);

            if ($user->level === 'admin' || $user->level === 'orangtua') {
                return redirect()->route('home');
            } elseif ($user->level === 'kader') {
                return redirect()->route('home');
            } else {
                Auth::logout(); // untuk jaga-jaga
                Session::flash('error', 'Akun tidak dikenali.');
                return redirect()->route('login');
            }
        }
    }
    public function logout()
    {
        Auth()->logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
