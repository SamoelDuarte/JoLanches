<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Categoria::has('produtos')->get();

        return view('home/index',compact('categories'));
    }
}
