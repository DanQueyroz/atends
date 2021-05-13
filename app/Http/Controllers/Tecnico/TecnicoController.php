<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Atendimento;
use App\Models\TipoAtendimento;

class TecnicoController extends Controller
{
    public function index()
    {
        // Garantindo que somente o técnico possa criar atendimentos
        if (Auth::user()->role != 1) {
            return redirect()->back();
        }
        return view('tecnico.index');
    }
    
    public function criarAtendimento(Request $request)
    {
        // Garantindo que somente o técnico possa criar atendimentos
        if (Auth::user()->role != 1) {
            return redirect()->back();
        }

        //Criando regras de validação
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'cliente'    => 'required',
            'observacao' => 'nullable',
            'tipo_de_atendimento' => 'required',
            'tecnico_id' => 'required',
        ]);

        //Se o validator encontrar erros ele retornará uma resposta json e uma maensagem com os erros encontrados
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()], 
                400);
        }

        // Verificando se o ID passado corresponde a um tecnico cadastrado 
        $tecnico = User::find($request->tecnico_id);
        if (!$tecnico) {
            return redirect()->back()->with('error', 'Desculpe, tecnico não encontrado.');
        }

        // Verificando se o ID passado corresponde a um tipo de atendimento cadastrado 
        $tipo_de_atendimento = TipoAtendimento::find($request->tipo_de_atendimento);
        if (!$tipo_de_atendimento) {
            return redirect()->back()->with('error', 'Desculpe, tipo de atendimento não encontrado.');
        }

        if ($request->observacao == null && $request->observacao == '') {
            $request->observacao = 'Nenhuma Observação';
        }

        // Criando Atendimento
        $atendimento = new Atendimento;
        $atendimento->data_da_execucao = date('Y-m-d', strtotime($request->data));
        $atendimento->cliente = $request->cliente;
        $atendimento->tipo_atendimento_id = $request->tipo_de_atendimento;
        $atendimento->observacao = $request->observacao;
        $atendimento->cliente = $request->cliente;
        $atendimento->user_id = $request->tecnico_id;
        $atendimento->save();

        if ($atendimento) {
            return redirect()->back()->with('success', 'Registro efetuado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Desculpe, não foi possível concluir a solicitação.');
        }
    }

    public function atendimento($id)
    {
        // Garantindo que somente o técnico tenha acesso a função
        if (Auth::user()->role != 1) {
            return redirect()->back();
        }

        // Recuperando atendimento pelço ID
        $atendimento = Atendimento::find($id);

        // Listando os tipos de atendimento
        $tipos = TipoAtendimento::where('status', 1)->get();

        return view('tecnico.atendimento', compact('atendimento', 'tipos'));
    }

    public function editarAtendimento(Request $request)
    {
        // Garantindo que somente o técnico tenha acesso a função
        if (Auth::user()->role != 1) {
            return redirect()->back();
        }

        //Criando regras de validação
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'cliente'    => 'required',
            'observacao' => 'nullable',
            'tipo_de_atendimento' => 'required',
            'tecnico_id' => 'required',
        ]);

        //Se o validator encontrar erros ele retornará uma resposta json e uma maensagem com os erros encontrados
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()], 
                400);
        }

        // Verificando se o ID passado corresponde a um tecnico cadastrado 
        $tecnico = User::find($request->tecnico_id);
        if (!$tecnico) {
            return redirect()->back()->with('error', 'Desculpe, tecnico não encontrado.');
        }

        // Verificando se o ID passado corresponde a um tipo de atendimento cadastrado 
        $tipo_de_atendimento = TipoAtendimento::find($request->tipo_de_atendimento);
        if (!$tipo_de_atendimento) {
            return redirect()->back()->with('error', 'Desculpe, tipo de atendimento não encontrado.');
        }

        if (!$request->observacao) {
            $request->observacao = 'Nenhuma Observação';
        }

        // Recuperando atendimento pelo ID
        $atendimento = Atendimento::find($request->atendimento_id);
        if (!$atendimento) {
            return redirect()->back()->with('error', 'Desculpe, atendimento não encontrado.');
        }

        $atendimento->data_da_execucao = date('Y-m-d', strtotime($request->data));
        $atendimento->cliente = $request->cliente;
        $atendimento->tipo_atendimento_id = $request->tipo_de_atendimento;
        $atendimento->observacao = $request->observacao;
        $atendimento->cliente = $request->cliente;
        $atendimento->user_id = $request->tecnico_id;
        $atendimento->update();

        return redirect()->back()->with('success', 'Registro atualizado com sucesso!');
    }

    public function excluirAtendimento($id)
    {
         // Garantindo que somente o técnico tenha acesso a função
         if (Auth::user()->role != 1) {
            return redirect()->back();
        }

        // Recuperando atendimento pelo ID
        $atendimento = Atendimento::find($id);
        if (!$atendimento) {
            return redirect()->back()->with('error', 'Desculpe, atendimento não encontrado.');
        }

        // Excluindo atendimento
        $atendimento->delete();
        return redirect()->back()->with('success', 'Registro excluído com sucesso!');
    }
}

