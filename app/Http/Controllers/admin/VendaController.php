<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FormaPagamento;
use App\Models\Product;
use App\Models\Venda;
use App\Models\VendaFormaPagamento;
use App\Models\VendaItem;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        $vendas = Venda::all(); // Obtem todas as vendas do banco de dados

        return view('admin.venda.index', compact('vendas'));
    }
    public function sale()
    {
        $formaPagamentos = FormaPagamento::get();
        return view('admin.venda.sale', compact('formaPagamentos'));
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

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'total_vendas' => 'required|numeric',
            'produto_id.*' => 'required|exists:products,id',
            'produto_quantidade.*' => 'required|integer|min:1',
            'form_pagamento_id.*' => 'required|exists:forma_pagamentos,id',
            'form_pagamento_valor.*' => 'required|numeric|min:0',
        ]);


    //   dd($request->all());

        // Criação da venda
        $venda = Venda::create([
            'total' => $request->input('total_vendas'),
            'data_venda' => now(), // Utiliza o timestamp atual como data de venda
        ]);

        // Adiciona os itens da venda
        foreach ($request->input('produto_id') as $key => $produtoId) {
            $produto = Product::find($produtoId);

            // dd($produto->price);
            VendaItem::create([
                'venda_id' => $venda->id,
                'product_id' => $produtoId,
                'quantidade' => $request->input('produto_quantidade')[$key],
                'valor' => $produto->price,
                // Outros campos necessários
            ]);
        }

        // Adiciona as formas de pagamento da venda
        foreach ($request->input('form_pagamento_id') as $key => $formaPagamentoId) {
            VendaFormaPagamento::create([
                'venda_id' => $venda->id,
                'forma_pagamento_id' => $formaPagamentoId,
                'valor' => $request->input('form_pagamento_valor')[$key],
            ]);
        }



        // Outras ações, como redirecionamento ou resposta JSON
        return redirect()->back()->with('success', 'Venda Efetuada Com Sucesso');
    }

    // app/Http/Controllers/admin/VendaController.php

    public function detalhes($vendaId)
    {
        $venda = Venda::with(['vendaItems.product', 'vendaFormaPagamentos.formaPagamento'])->findOrFail($vendaId);



    //  dd($venda);
        // Retorna a view com os detalhes da venda
        return view('admin.venda.detalhes', compact('venda'));
    }
}
