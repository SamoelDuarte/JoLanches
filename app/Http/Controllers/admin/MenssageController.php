<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Customer;
use App\Models\Messagen;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SplFileObject;
use Yajra\DataTables\Facades\DataTables;

class MenssageController extends Controller
{



    public function index(){
        return view('admin.message.index');
    }
    public function getMessage()
    {
        $messagens = Messagen::with('device')->orderBy('id')->get();
        return DataTables::of($messagens)->make(true);
    }
    public function create(){
        return view('admin.message.create');
    }
    public function bulkMessage(Request $request){


        if($request->texto == ""){
            return back()->with('error','Mensagem não pode estár Vazia');
        }
        if ($request->hasFile('csvFile')) {
            $file = $request->file('csvFile');
           
            $handle = new SplFileObject($file->getPathname(), 'r');

            foreach ($handle as $linha) {

                $mensagen = new Messagen();
                $mensagen->messagem =  $request->texto;
                $mensagen->number = $this->formatarTexto($linha);
                $mensagen->save();
            }

      
        }
        return Redirect::route('admin.message.index')->with('success','Mensagem Salva Com Sucesso');
    }

    public function indexAgendamentos(){
        $agendamentos = Agendamento::all();

        return view('admin.message.agendamentos' , compact('agendamentos'));
    }
    public function getAgendamentos(){
        $agendamento = Agendamento::orderBy('id', 'desc');
        return DataTables::of($agendamento)->make(true);
    }
    

    public function formatarTexto($texto) {
        // Remover os caracteres (.-+) e espaços
        $textoFormatado = preg_replace('/[.\-+\s]+/', '', $texto);
    
        // Se o texto limpo tiver exatamente 11 caracteres, concatenar '55' no início
        if (strlen($textoFormatado) === 11) {
            $textoFormatado = '55' . $textoFormatado;
        }
    
        return $textoFormatado;
    }
    

    public function countContact(Request $request){
        if ($request->hasFile('csvFile')) {
            $file = $request->file('csvFile');
            $totalLinhas = 0;

            $handle = fopen($file->getPathname(), 'r');
            while (!feof($handle)) {
                fgets($handle);
                $totalLinhas++;
            }
            fclose($handle);

            return response()->json(['totalLinhas' => $totalLinhas]);
        }

        return response()->json(['totalLinhas' => 0]);
    }

   
    
}
