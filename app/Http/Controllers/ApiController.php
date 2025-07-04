<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // ✅ CORRETO


class ApiController extends Controller
{
    public function getProduto(Request $request)
    {
        $codigo = $request->codigo;
        // if (!$codigo) {
        //     return response()->json([
        //         'status' => 'erro',
        //         'mensagem' => 'Código de barras não enviado.'
        //     ], 400);
        // }

        $produto = Product::where('cod_barra', $codigo)->first();
        if (!$produto) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Produto não encontrado. para o codigo ' . $codigo
            ], 200);
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
    public function cadastrarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|regex:/^\d+(\,\d{1,2})?$/'
        ], [
            'preco.regex' => 'O preço deve estar no formato válido, ex: 9,99'
        ]);

        $codigo = $request->input('codigo');

        // Se tiver código, verifica se já existe
        if (!empty($codigo)) {
            $existe = Product::where('cod_barra', $codigo)->exists();
            if ($existe) {
                return response()->json([
                    'status' => 'erro',
                    'mensagem' => 'Este produto já está cadastrado com esse código de barras'
                ], 409);
            }
        }

        $produto = Product::create([
            'cod_barra' => $codigo, // pode ser null
            'name' => $request->input('nome'),
            'price' => str_replace(',', '.', $request->input('preco')),
            'sistem' => 1,
            'category_id' => null,
            'description' => null
        ]);

        return response()->json([
            'status' => 'sucesso',
            'mensagem' => 'Produto cadastrado com sucesso',
            'produto' => $produto
        ]);
    }
}
