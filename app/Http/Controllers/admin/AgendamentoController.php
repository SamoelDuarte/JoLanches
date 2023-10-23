<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\Agendamento;
use App\Models\Chat;
use App\Models\Customer;
use DateTime;
use Illuminate\Http\Request;
use Pusher\Pusher;

class AgendamentoController extends Controller
{
    public function index()
    {

        return view('admin.agendamento.index');
    }

    public function data()
    {
        $agendamentos = Agendamento::with('customer')->select(['id', 'data_agendamento', 'customers_id', 'caminho_foto']);

        return datatables()
            ->of($agendamentos)
            ->addColumn('action', function ($agendamentos) {
                // Você pode adicionar botões de ação (editar, excluir) aqui, se desejar
                return '<a href="#" class="btn btn-primary">Editar</a>';
            })
            ->make(true);
    }

    public function new(Request $request)
    {

        // Obtenha a data atual
        $dataAtual = new DateTime();

        // Adicione dias para chegar ao próximo sábado (6 representa o sábado)
        $dataAtual->modify('next saturday');

        // Formate a data para exibição
        $dataProximoSabado = $dataAtual->format('d/m/Y');

      
        $phone = $request->phone;

        $data = array(
            "phone" => str_replace('55','',$phone) ,
            "sabado" => $dataProximoSabado ,
            "data" => $dataAtual->format('Y-m-d') 
        );


        $agendamento = Agendamento::where(["number" => $request->phone, "status" => "pendente"])->first();

        if ($agendamento != null) {
            $text = "<p>Seu agendamento já foi realizado com sucesso.</p>";
            return view('front.agendamento.parabens', compact('text'));
        } else {
            return view('front.agendamento.index', compact('data'));
        }
    }


    public function store(Request $request)
    {


        // Validação dos campos do formulário
        $request->validate([
            'name' => 'required', // Exemplo de validação para a imagem
            'number' => 'required',
            'size' => 'required',
        ]);

        $agendamento = Agendamento::create([
            'data_agendamento' => $request->data_agendamento,
            'name' => $request->name,
            'size' => $request->size,
            'number' => Utils::sanitizePhone($request->number),
            'status' => "pendente",
        ]);

        $options = array(
            'cluster' => 'mt1',
            'useTLS' => true
          );
          $pusher = new Pusher(
            'e13db91a4625ab794815',
            '78f9df6d9a0dc2f85a26',
            '1693149',
            $options
          );
        
          $data['message'] = 'Novo Agendamento';
          $pusher->trigger('my-channel', 'my-event', $data);

        $text = ' <h1>Parabéns pelo Agendamento!</h1>
        <p>Sua Feijoada vai ser separada com todo carinho e capricho.</p>
        <a href="/" class="whatsapp-button">
            Visitenos
        </a>';

        return view('front.agendamento.parabens', compact('text'));
    }
}
