<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Models\TipoAtendimento;

class DashboardController extends Controller
{
    public function home()
    {
        // Recuperando todos os tipos de atendimentos ativos
        $tipos_atendimento = TipoAtendimento::where('status', 1)->select('id','nome')->get();
       
        return view('home', compact('tipos_atendimento'));
    }
}
