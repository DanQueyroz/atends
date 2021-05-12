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

        //Criando regras de validação
        $validator = Validator::make($request->all(), [
            'email'          => 'required|string',
            'senha'          => 'required|string|min:4',
        ]);

        //Se o validator encontrar erros ele retornará uma resposta json e uma maensagem com os erros encontrados
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()], 
                400);
        }
        
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
