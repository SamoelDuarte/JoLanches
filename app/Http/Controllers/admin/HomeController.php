<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Sangria;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      
        return view('admin.dashboard.index' ,);
    }

    public function dash(Request $request){

         // Obtenha as datas inicial e final do seu request
         $dataInicial = $request->input('dateStart');
         $dataFinal = $request->input('dateEnd');


        
         $dataInicial = Carbon::parse($dataInicial)->startOfDay();
        $dataFinal = Carbon::parse($dataFinal)->endOfDay();
 
         // Consulta para obter a soma das colunas "valor" no período especificado
         $somaSangria = Sangria::whereBetween('data', [$dataInicial, $dataFinal])->sum('valor');
         $somaTotal = Venda::whereBetween('data_venda', [$dataInicial, $dataFinal])->sum('total');

       


        $totalData = [
            'sangriaTotal' => number_format($somaSangria, 2, ',', '.'),
            'vendaTotal' => number_format($somaTotal, 2, ',', '.'),
            'total' =>number_format($somaTotal - $somaSangria, 2, ',', '.'),
        ];

        return response()->json($totalData);
    }
}
