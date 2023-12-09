<?php

// app/Http/Controllers/ShoppingListController.php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index()
    {
        $shoppingLists = ShoppingList::all();
        return view('admin.shopping-list.index', compact('shoppingLists'));
    }

    public function create()
    {
        return view('shopping_lists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            // Adicione outras regras de validação conforme necessário
        ]);

        $shoppingList = ShoppingList::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Shopping list created successfully.',
            'data' => $shoppingList,
        ]);
    }

    public function getItens(Request $request)
{
    // Lógica para obter os itens da tabela, por exemplo:
    $itens = ShoppingList::select('name','id')->get();

    return response()->json($itens);
}

public function destroy(Request $request)
{
    $request->validate([
        'id' => 'required|exists:shopping_lists,id',
    ]);

    $item = ShoppingList::find($request->id);

    if (!$item) {
        return response()->json(['error' => 'Item não encontrado.'], 404);
    }

    $item->delete();

    return response()->json(['success' => 'Item excluído com sucesso.']);
}
    // Adicione outros métodos conforme necessário (update, edit, destroy, etc.)
}
