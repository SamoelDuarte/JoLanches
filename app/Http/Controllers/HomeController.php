<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Categoria::has('produtos')
        ->with(['produtos' => function ($query) {
            // Filtra os produtos onde 'sistem' é igual a 1
            $query->where('sistem', 0);
        }])
        ->get();

        return view('home/index',compact('categories'));
    }
}
