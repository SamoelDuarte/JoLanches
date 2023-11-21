<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class VendaController extends Controller
{
   public function index(){
    return view('admin.venda.index');
   }
   public function buscarProdutos(Request $request)
    {
        $termo = $request->input('term');
        $produtos = Product::where('name', 'like', "%$termo%")->get();

        return response()->json($produtos);
    }

    public function obterProduto($id)
    {
        $produto = Product::find($id);

        return response()->json($produto);
    }
}
