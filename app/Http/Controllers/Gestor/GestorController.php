<?php

namespace App\Http\Controllers\Gestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use App\models\User;
use App\Models\Atendimento;
use App\Models\TipoAtendimento;

class GestorController extends Controller
{   
    public function getTiposAtendimentos()
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        $tipos = TipoAtendimento::all();

        return view('gestor.tipo_atendimento', compact('tipos'));
    }

    public function criarTipoAtendimento(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        //Criando regras de validação
        $validator = Validator::make($request->all(), [
            'nome'           => 'required',
        ]);

        // Criando novo tipo de atendimento
        $tipo_atendimento = new TipoAtendimento;
        $tipo_atendimento->nome = $request->nome;
        $tipo_atendimento->save();

        if ($tipo_atendimento) {
            return redirect()->back()->with('success', 'Registro efetuado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Desculpe, não foi possível concluir a solicitação.');
        }
    }

    public function desativarTipoAtendimento(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        // Verificando se o tipo de atendimento está relacionado a algum atendimento
        $check = Atendimento::where('tipo_atendimento_id', $request->tipo_id)->first();

        if ($check) {
            return redirect()->back()->with('error', 'Esse tipo está vinculado a um atendimento.');
        }

        // Recuperando tipo e atualizando o status do mesmo
        $tipo = TipoAtendimento::find($request->tipo_id);
        $tipo->status = 0;
        $tipo->update();

        return redirect()->back()->with('success', 'Desativado com sucesso!');
    }

    public function excluirTipoAtendimento(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        // Verificando se o tipo de atendimento está relacionado a algum atendimento
        $check = Atendimento::where('tipo_atendimento_id', $request->tipo_id)->first();

        if ($check) {
            return redirect()->back()->with('error', 'Esse tipo está vinculado a um atendimento.');
        }

        // Recuperando tipo e atualizando o status do mesmo
        $tipo = TipoAtendimento::find($request->tipo_id);
        $tipo->delete();

        return redirect()->back()->with('success', 'O tipo de atendimento foi excluído com sucesso!');
    }

    public function getTecnicos()
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        $tecnicos = User::where('role', 1)->get();

        return view('gestor.tecnicos', compact('tecnicos'));
    }

    public function criarTecnico(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        //Criando regras de validação
        $validator = Validator::make($request->all(), [
            'nome'           => 'required',
            'email'          => 'required|unique:users',
            'senha'           => 'required|min:4|max:25',
        ]);

        //Se o validator encontrar erros ele retornará uma resposta json e uma maensagem com os erros encontrados
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()], 
                400);
        }

        // Criando novo técnico
        $tecnico = new User;
        $tecnico->name = $request->nome;
        $tecnico->email = $request->email;
        $tecnico->password = bcrypt($request->senha);
        $tecnico->role = 1;
        $tecnico->save();

        if ($tecnico) {
            return redirect()->back()->with('success', 'Registro efetuado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Desculpe, não foi possível concluir a solicitação.');
        }
    }

    public function desativarTecnico(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        // Verificando se o técnico está relacionado a algum atendimento
        $check = Atendimento::where('user_id', $request->tecnico_id)->first();

        if ($check) {
            return redirect()->back()->with('error', 'O técnico está vinculado a um atendimento.');
        }

        // Recuperando tecnico e atualizando o status do mesmo
        $tecnico = User::find($request->tecnico_id);
        $tecnico->status = 0;
        $tecnico->update();

        return redirect()->back()->with('success', 'Desativado com sucesso!');
    }

    public function excluirTecnico(Request $request)
    {
        // Garantindo que somente o gestores possam acessar a rota
        if (Auth::user()->role != 0) {
            return redirect()->back();
        }

        // Verificando se o tipo de atendimento está relacionado a algum atendimento
        $check = Atendimento::where('user_id', $request->tecnico_id)->first();

        if ($check) {
            return redirect()->back()->with('error', 'Esse técnico está vinculado a um atendimento.');
        }

        // Recuperando tipo e atualizando o status do mesmo
        $tecnico = User::find($request->tecnico_id);
        $tecnico->delete();

        return redirect()->back()->with('success', 'O técnico de atendimento foi excluído com sucesso!');
    }
}
