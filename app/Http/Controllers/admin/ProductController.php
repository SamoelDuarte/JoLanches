<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {

        return view('admin.product.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'imageInput' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Verifique os requisitos da imagem
        ]);



        $image = $request->file('imageInput');

        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/products'), $imageName);

            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->image = "/assets/images/products/" . $imageName;
            $product->save();

            return redirect()->route('admin.product.index')->with('success', 'Produto adicionado com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Falha ao fazer upload da imagem.');
        }
    }
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            // Exclua a imagem associada (caso exista)
            if (!empty($product->image)) {
                $imagePath = public_path('assets/images/product/') . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $product->delete();

            return redirect()->route('admin.product.index')->with('success', 'Produto excluído com sucesso.');
        }

        return redirect()->route('admin.product.index')->with('error', 'Produto não encontrado.');
    }
}
