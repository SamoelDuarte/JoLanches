<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;

class AdminController extends Controller
{
   public function index(){
      return view('admin/dashboard/index');
   }

   public function login(){
   if(session('authenticated')){
    return view('admin.dashboard.index');
   }else{
    return view('admin/login/index');
   }

    
   }

   public function attempt(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email|max:255',
            'password' => 'bail|required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error','E-mail e/ou senha inválidos.')->withInput();
        }

        if (!Utils::passwordIsValid($request->password, $user->password, $user->salt)) {
            return back()->with('error','E-mail e/ou senha inválidos.')->withInput();
        }

        if($user->role == "user"){
            return back()->with('error','Usuário não Cadastrado')->withInput();
        }
   

        session([
            'authenticated' => true,
            'userData' => $user
        ]);

        return redirect('/admin');
    }
}