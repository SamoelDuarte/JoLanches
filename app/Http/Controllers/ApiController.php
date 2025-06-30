<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // ✅ CORRETO


class ApiController extends Controller
{
    public function getProduto(Request $request)
    {
        $codigo = $request->codigo;
        dd($codigo);
        if (!$codigo) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Código de barras não enviado.'
            ], 400);
        }

        $produto = Product::where('cod_barra', $codigo)->first();

        if (!$produto) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Produto não encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 'sucesso',
            'produto' => [
                'id' => $produto->id,
                'nome' => $produto->name,
                'descricao' => $produto->description,
                'preco' => number_format($produto->price, 2, ',', '.'),
                'cod_barra' => $produto->cod_barra,
                'categoria' => optional($produto->categoria)->nome,
                'sistema' => $produto->sistema_display, // acessor automático
            ]
        ]);
    }
}
