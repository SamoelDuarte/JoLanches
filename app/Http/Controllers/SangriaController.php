<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sangria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SangriaController extends Controller
{
    public function index()
    {
        $sangrias = Sangria::orderByDesc('id')->get();

        return view('admin.sangria.index', compact('sangrias'));
    }

    public function create()
    {
        return view('sangria.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'valor' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Por Favor preencha todos os campos.');
        }
   

        // Crie a Sangria
        Sangria::create([
            'data' =>  $request->input('data'),
            'valor' => Utils::prepareMoneyForDatabase($request->input('valor')),
            'descricao' => $request->input('descricao'),
        ]);


        return redirect()->route('admin.sangria.index')
            ->with('success', 'Sangria cadastrada com sucesso!');
    }

    public function edit(Sangria $sangria)
    {
        return view('admin.sangria.edit', compact('sangria'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'data' => 'required',
            'valor' => 'required',
            'descricao' => 'required',
        ]);


       
        $sangria = Sangria::find($request->id_sangria);

      
        $dataUpdate = array(
            'data' =>  $request->input('data'),
            'valor' => Utils::prepareMoneyForDatabase($request->input('valor')),
            'descricao' => $request->input('descricao'),
        );

      
        $sangria->update($dataUpdate);

        return back()->with('success', 'Sangria atualizada com sucesso!');
    }

    
    public function detalhes($id)
    {
        // Obtenha os detalhes da sangria pelo ID
        $sangria = Sangria::find($id);

        // Verifique se a sangria foi encontrada
        if (!$sangria) {
            return response()->json(['error' => 'Sangria não encontrada'], 404);
        }

        // Retorne os detalhes da sangria em JSON
        return response()->json([
            'data' => $sangria->data,
            'valor' => $sangria->valor,
            'descricao' => $sangria->descricao,
        ]);
    }
    public function deletar($id)
    {
        // Obtenha a instância da Sangria
        $sangria = Sangria::find($id);

        // Verifique se a sangria foi encontrada
        if (!$sangria) {
            return response()->json(['error' => 'Sangria não encontrada'], 404);
        }

        // Exclua a sangria
        $sangria->delete();

        // Retorna uma resposta em JSON, se desejar
        return response()->json(['message' => 'Sangria excluída com sucesso']);
    }
}
