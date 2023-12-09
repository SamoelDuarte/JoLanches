<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\Categoria;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Categoria::all();
        return view('admin.product.create', compact('categories'));
    }
    public function edit(Request $request)
    {

        $product = Product::find($request->id);
        $categories = Categoria::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            // Lidar com o produto não encontrado, redirecionar ou mostrar um erro
        }

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $data['price'] = Utils::prepareMoneyForDatabase($data['price']);

        if($request->input('sistem')){


        }else{
            $data = $request->validate([
                'description' => 'required',
                'category_id' => 'required',
                'imageInput' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Verifica se é uma imagem válida
            ]);

            if ($request->hasFile('imageInput')) {
                // Se uma nova imagem foi enviada, exclua a imagem anterior
                if ($product->image) {
                    Storage::delete($product->image);
                }
                $image = $request->file('imageInput');
                // Salve a nova imagem
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/products'), $imageName);
            }

        }

       


        $product->update($data);

        return redirect()->route('admin.product.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);




        if ($request->input('sistem')) {
          

            // dd(Utils::prepareMoneyForDatabase($request->input('price')));
            $product = new Product();
            $product->name = $request->input('name');
            $product->price = Utils::prepareMoneyForDatabase($request->input('price'));
            $product->sistem = $request->input('sistem');
            $product->save();

        } else {
            $request->validate([
                'description' => 'required',
                'category_id' => 'required',
                'imageInput' => 'image|mimes:jpeg,png,jpg,gif|max:2048|required', // Verifique os requisitos da imagem
            ]);

            $image = $request->file('imageInput');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/products'), $imageName);
    
                $product = new Product();
                $product->name = $request->input('name');
                $product->description = $request->input('description');
                $product->category_id = $request->input('category_id');
                $product->price = $request->input('price');
                $product->image = "/assets/images/products/" . $imageName;
                $product->save();
    
              
            } else {
                return redirect()->back()->with('error', 'Falha ao fazer upload da imagem.');
            }

            
        }

        return redirect()->route('admin.product.index')->with('success', 'Produto adicionado com sucesso.');
       

       
    }

    public function storeSistem(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);




      
          

            // dd(Utils::prepareMoneyForDatabase($request->input('price')));
            $product = new Product();
            $product->name = $request->input('name');
            $product->price = Utils::prepareMoneyForDatabase($request->input('price'));
            $product->sistem = $request->input('sistem');
            $product->save();

    

            return response()->json(['success' => 'Salvo com Sucesso']);
       

       
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
