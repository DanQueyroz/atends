<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use App\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request) {

        $validator = Validator::make($request->all(), [
            'email'          => 'required|string',
            'senha'          => 'required|string|min:4',
        ]);
        
        // Tentativa de conectar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            return redirect('/dashboard');
        }else {
            return redirect()->back()->with('error', 'Credências inválidas.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
