<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria ;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorie.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categoria::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/categorias')->with('success', 'Categoria criada com sucesso.');
    }

    public function show(Categoria $categoria)
    {
        return view('admin.categorie.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorie.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoria->update([
            'name' => $request->input('name'),
        ]);

        return redirect('/categorias')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->produtos()->count() > 0) {
            return redirect('/categorias')->with('error', 'Esta categoria não pode ser excluída porque há produtos associados a ela.');
        }
        
        $categoria->delete();
        return redirect('/categorias')->with('success', 'Categoria excluída com sucesso.');
    }
}
