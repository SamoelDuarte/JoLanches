<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\Chat;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Messagen;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrdersItens;
use Carbon\Carbon;
use Dflydev\DotAccessData\Util;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $reponseJson = file_get_contents('php://input');



        // file_put_contents(Utils::createCode()."-audio.txt",$reponseJson);
        $reponseArray = json_decode($reponseJson, true);
        $session = Device::where('session', $reponseArray['data']['sessionId'])->first();

        if ($reponseArray['data']['event'] == "DISCONNECTED") {
            $session->status = "DISCONNECTED";
            $session->update();
            exit;
        }

        // verifica se o serviço está em andamento

        $active = 0;
        if ($active) {

            $this->verifyService($reponseArray, $session);
        }

        //  file_put_contents(Utils::createCode().".txt",$reponseJson);
    }

    public function teste()
    {
     

        $devices = Device::get();// IDs dos dispositivos


            foreach($devices as $device){
                $mensagen = Messagen::where('device_id',null)->first();
                if($device->amount_message <= 39 && isset($mensagen)){
                   

                    //envio da mensagem 

                    $mensagen->number =  "5511970471094";
                   // $mensagen->update();
                    $text =  '🎉🥘 Reserva a Sua Feijoada Especial! 🥘🎉

                    Ei! 😋 Sábado está chegando, e nós estamos preparando algo MUITO especial para você na Jo Lanches! 🌟
                    
                    
                    📅 Data: Próximo Sábado
                    ⏰ Horário: A partir das 12h
                    📍 Local: Jo Lanches
                    
                    Não deixe sua barriga roncar de fome, clique no link abaixo e garanta já a Sua! 🍽️👇
                    
                    https://jolanches.com.br/agendamento/novo?phone=' . $mensagen->number.
                    
                    '
                    Vai ser épico! Reserve agora e conte para todo mundo! 📣 #FeijoadaNaJoLanches
                    
                    Mal podemos esperar para vê-lo no sábado. Prepare o apetite e a animação! 🥳
                    
                    Atenciosamente,
                    Equipe da Jo Lanches ';
                    $nomeImagen = "https://assets.unileversolutions.com/recipes-v2/54349.jpg?im=FitAndFill=(913,320);Crop,size=(750,320),gravity=Center";
                    $this->sendImage($device->session, $mensagen->number, $nomeImagen, $text);
                }
              
            }
          
        

      
    }

    public function verifyService($reponseArray, $session)
    {
        // if ($reponseArray['data']['message']['fromMe']) {
        //     exit;
        // }
        if ($reponseArray['data']['message']['fromMe'] || !$reponseArray['data']['message']['fromGroup']) {



            $jid = $reponseArray['data']['message']['from'];

            $service = Chat::where('session_id',  $session->id)
                ->where('jid', $jid)
                ->where('active', 1)
                ->first();


            $customer = Customer::where('jid',  $jid)
                ->first();




            if (!$service) {

                $service = new Chat();
                $service->jid = $jid;
                $service->session_id = $session->id;
                $service->service_id = Utils::createCode();
                $service->save();
            }

            if (!$customer) {
                $customer = new Customer();
                $customer->jid = $jid;
                $customer->save();
                if ($reponseArray['data']['message']['type'] == "audio") {
                    $service->await_answer = "await_human";
                    $service->update();
                    exit;
                }


                $text = 'Olá! 🌟 Antes de continuarmos, poderia, por favor, nos fornecer o seu nome?\nEstou aqui para ajudar e tornar o atendimento mais pessoal. 😊💬';
                $service->await_answer = "name";
                $service->save();
                $this->sendMessagem($session->session, $customer->phone, $text);
                exit;
            }


            if ($customer && $service->await_answer == null) {

                if ($reponseArray['data']['message']['type'] == "audio") {
                    $service->await_answer = "await_human";
                    $service->update();
                    exit;
                }

                if ($service->await_answe == "await_human" || $service->await_answe == "in_service") {
                    exit;
                }
                $service->await_answer = "init_chat";
            }
            //dd($service);




            if ($service->await_answer == "name") {
                $customer->name = $reponseArray['data']['message']['text'];
                $customer->update();
                $text = "Por favor " . $customer->name . " Digite seu Cep";
                $service->await_answer = "cep";
                $service->update();
                $this->sendMessagem($session->session, $customer->phone, $text);
                exit;
            }



            if ($service->await_answer == "cep") {

                $cep = $reponseArray['data']['message']['text'];
                $cep = Utils::returnCep($cep);
                if ($cep) {
                    $customer->zipcode = $cep['cep'];
                    $customer->public_place = $cep['logradouro'];
                    $customer->neighborhood = $cep['bairro'];
                    $customer->city = $cep['localidade'];
                    $customer->state = $cep['uf'];
                    $customer->update();
                    $service->await_answer = "number";
                    $service->update();
                    $text = "Por Favor Digite o Número da residência";
                } else {
                    $service->await_answer = "cep";
                    $text = "Cep inválido Digite novamente!";
                }
                $this->sendMessagem($session->session, $customer->phone, $text);
                exit;
            }


            if ($service->await_answer == "number") {

                $customer->number = $reponseArray['data']['message']['text'];
                $customer->update();
                $location = $customer->location . " \n  O Endereço está Correto ? ";
                $options = [
                    "Sim",
                    "Não"
                ];
                $this->sendMessagewithOption($session->session, $customer->phone, $location, $options);

                $service->await_answer = "cep_confirmation";
                $service->update();
            }



            if ($service->await_answer == "cep_confirmation") {

                $response = $reponseArray['data']['message']['text'];

                switch ($response) {
                    case  "1";
                        $service->await_answer = "init_chat_1";
                        $service->update();
                        $text =  $customer->name . " \n  Seu cadastro foi Realizado \n com sucesso ";
                        $this->sendMessagem($session->session, $customer->phone, $text);

                        $text = "Por favor " . $customer->name . " Selecione uma das Opções .";
                        $options = [
                            "Novo Pedido",
                            "Falar com um Atendente."
                        ];
                        $this->sendMessagewithOption($session->session, $customer->phone, $text, $options);
                        exit;
                        break;

                    case '2';
                        $service->await_answer = "cep";
                        $service->update();
                        $text =  $customer->name . " \n Por favor Digite seu cep Novamente.";
                        $this->sendMessagem($session->session, $customer->phone, $text);
                        exit;
                        break;

                    default:
                        $service->erro =  $service->erro + 1;
                        $service->update();
                        $text =  "Opção inválida!";
                        $this->sendMessagem($session->session, $customer->phone, $text);
                        if ($service->erro > 2) {
                            $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                            $this->sendMessagem($session->session, $customer->phone, $text);
                            $service->await_answer = "await_human";
                            $service->update();
                        }


                        break;
                }
            }


            if ($service->await_answer == "init_chat") {


                $text = "Olá " . $customer->name . " é bom ter voçê novamente aki! ";
                $this->sendMessagem($session->session, $customer->phone, $text);

                $service->await_answer = "init_chat_1";
                $service->update();
                $text = "Por favor " . $customer->name . " Selecione uma das Opções .";
                $options = [
                    "Novo Pedido",
                    "Falar com um Atendente."
                ];
                $this->sendMessagewithOption($session->session, $customer->phone, $text, $options);
                exit;
            }

            if ($service->await_answer == "init_chat_1") {
                $response = $reponseArray['data']['message']['text'];

                switch ($response) {
                    case  "1";
                        $service->await_answer = "init_order";
                        $service->update();
                        $text = "Por favor Selecione uma das Opções .";
                        $options = [
                            "13kg R$ 99,99",
                            "20kg R$ 140,00"
                        ];
                        $this->sendMessagewithOption($session->session, $customer->phone, $text, $options);
                        exit;
                        break;

                    case '2';
                        $service->await_answer = "await_human";
                        $service->update();
                        $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                        $this->sendMessagem($session->session, $customer->phone, $text);

                        break;


                    default:
                        $service->erro =  $service->erro + 1;
                        $service->update();
                        $text =  "Opção inválida!";
                        $this->sendMessagem($session->session, $customer->phone, $text);
                        if ($service->erro > 2) {
                            $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                            $this->sendMessagem($session->session, $customer->phone, $text);
                            $service->await_answer = "await_human";
                            $service->update();
                        }

                        break;
                }
            }
            if ($service->await_answer == "init_order") {
                $response = $reponseArray['data']['message']['text'];
                $order = new Order();
                $order->status = "opened";
                $order->customer_id = $customer->id;
                $order->save();
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;

                if ($response == '1') {
                    $orderItem->price = "99.00";
                }
                if ($response == '2') {
                    $orderItem->price = "140.00";
                }
                if ($response != "1" && $response != "2") {

                    $service->erro =  $service->erro + 1;
                    $service->update();
                    $text =  "Opção inválida!";
                    $this->sendMessagem($session->session, $customer->phone, $text);
                    if ($service->erro > 2) {
                        $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                        $this->sendMessagem($session->session, $customer->phone, $text);
                        $service->await_answer = "await_human";
                        $service->update();
                    }
                }


                $orderItem->save();
                $service->await_answer = "question_closes";
                $service->update();
                $text = "Por favor Selecione uma das Opções .";
                $options = [
                    "Finalizar Pedido",
                    "Continuar Comprando"
                ];
                $this->sendMessagewithOption($session->session, $customer->phone, $text, $options);
                exit;
            }

            if ($service->await_answer == "question_closes") {
                $response = $reponseArray['data']['message']['text'];

                if ($response == '1') {

                    $order = Order::where('customer_id', $customer->id)
                        ->where("status", "opened")->orderByDesc('id')->first();

                    $orderItens = $order->orderItens->first();

                    $text = "Por favor verifique o pedido \n  Total :" . $orderItens->price . " \n"
                        . " Endereço  \n" . $customer->location . " \n Os dados do pedido estão correto ?";
                    $options = [
                        "Sim",
                        "Não"
                    ];
                    $service->await_answer = "finish";

                    $service->update();
                    $this->sendMessagewithOption($session->session, $customer->phone, $text, $options);
                    exit;
                }
                if ($response == '2') {
                    $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                    $this->sendMessagem($session->session, $customer->phone, $text);
                    $service->await_answer = "await_human";
                    $service->update();
                }

                if ($response != "1" && $response != "2") {

                    $service->erro =  $service->erro + 1;
                    $service->update();
                    $text =  "Opção inválida!";
                    $this->sendMessagem($session->session, $customer->phone, $text);
                    if ($service->erro > 2) {
                        $text =  "Por favor aguarde ,em instantes voçê será atendido(a).";
                        $this->sendMessagem($session->session, $customer->phone, $text);
                        $service->await_answer = "await_human";
                        $service->update();
                    }
                }
            }

            if ($service->await_answer == "finish") {
                date_default_timezone_set('America/Sao_Paulo');
                $horaAtual = Carbon::now();
                $horaMais45Minutos = $horaAtual->addMinutes(45);
                $text = " Pedido feito com Sucesso .";
                $this->sendMessagem($session->session, $customer->phone, $text);

                $text = "Previsão da entrega " . $horaMais45Minutos->format('H:i');
                $this->sendMessagem($session->session, $customer->phone, $text);

                $text = "Muito Obrigado! ";
                $this->sendMessagem($session->session, $customer->phone, $text);
                $service->active = 0;
                $service->update();
            }
        }
    }

    public function sendMessagem($session, $phone, $texto)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('APP_URL_ZAP') . '/' . $session . '/messages/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "number": "' . $phone . '",
                                        "message": {
                                            "text": "' . $texto . '"
                                        },
                                        "delay": 3
                                    }',
            CURLOPT_HTTPHEADER => array(
                'secret: $2a$12$VruN7Mf0FsXW2mR8WV0gTO134CQ54AmeCR.ml3wgc9guPSyKtHMgC',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
    }

    public function sendMessagewithOption($session, $phone, $text, $options)
    {
        $curl = curl_init();

        $send = array(
            "number" => $phone,
            "message" => array(
                "text" => $text,
                "options" => $options,
            ),
            "delay" => 3
        );


        curl_setopt_array($curl, array(
            CURLOPT_URL => env('APP_URL_ZAP') . '/' . $session . '/messages/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($send),
            CURLOPT_HTTPHEADER => array(
                'secret: $2a$12$VruN7Mf0FsXW2mR8WV0gTO134CQ54AmeCR.ml3wgc9guPSyKtHMgC',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function sendAudio($session, $phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('APP_URL_ZAP') . '/' . $session . '/messages/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "number": "' . $phone . '",
            "message": {
                "audio": {
                    "url" : "http://localhost:3333/static/audio/2F49EE65082AB66116EBFC03DC26C44D.ogg?sessionId=JOSE_1&messageId=2F49EE65082AB66116EBFC03DC26C44D"
                }
            },
            "delay": 0
        }',
            CURLOPT_HTTPHEADER => array(
                'secret: $2a$12$VruN7Mf0FsXW2mR8WV0gTO134CQ54AmeCR.ml3wgc9guPSyKtHMgC',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function sendImage($session, $phone, $nomeImagen, $detalhes)
    {
        $curl = curl_init();

        $send = array(
            "number" => $phone,
            "message" => array(
                "image" => array(
                    "url" => $nomeImagen// public_path('uploads/' . $nomeImagen)
                ),
                "caption" => $detalhes
            ),
            "delay" => 3
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('APP_URL_ZAP') . '/' . $session . '/messages/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($send),
            CURLOPT_HTTPHEADER => array(
                'secret: $2a$12$VruN7Mf0FsXW2mR8WV0gTO134CQ54AmeCR.ml3wgc9guPSyKtHMgC',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        //  file_put_contents(Utils::createCode() . ".txt", $response);

        curl_close($curl);
    }
}
