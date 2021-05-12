<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\models\User;
use App\Models\Atendimento;
use App\Models\TipoAtendimento;

class DashboardController extends Controller
{
    public function home()
    {
        // Recuperando todos os tipos de atendimentos ativos do técnico autenticado
        $meus_atendimento = TipoAtendimento::where('status', 1)->select('id','nome')->get();

        $relatorios = Atendimento::all();
        foreach ($relatorios as $relatorio) {
            $tipo = TipoAtendimento::find($relatorio->tipo_atendimento_id)->nome;
            $tecnico = User::find($relatorio->user->id)->name;

            $relatorio->tipo = $tipo;
            $relatorio->tecnico = $tecnico;
            $relatorio->data = date('d/m/Y', strtotime($relatorio->data_da_execucao));
        }
       
        return view('home', compact('meus_atendimento', 'relatorios'));
    }
}
