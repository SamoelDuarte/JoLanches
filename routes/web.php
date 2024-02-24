<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AgendamentoController;
use App\Http\Controllers\admin\ChatBotController;
use App\Http\Controllers\admin\DeviceController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MenssageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoriaController;
use App\Http\Controllers\admin\ShoppingListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\VendaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SangriaController;
use App\Notifications\NewOrderNotification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/events')->controller(EventsController::class)->group(function () {
    Route::post('/', 'index')->name('admin.events.index');
    Route::get('/teste', 'teste');
});

Route::prefix('/admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'login')->name('admin.login');
    Route::get('/sair', 'sair')->name('admin.sair');
    Route::get('/senha', 'password')->name('admin.password');
    Route::post('/attempt', 'attempt')->name('admin.attempt');

    Route::prefix('/chat')->controller(ChatBotController::class)->group(function () {
        Route::get('/getAtendimentoPedente', 'getAtendimentoPedente');
    });
});

Route::prefix('/')->controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::prefix('/agendamento')->controller(AgendamentoController::class)->group(function () {
    Route::get('/novo', 'new');
    Route::post('/store', 'store')->name('agendamento.store');
});


Route::middleware('auth.admin')->group(function () {


    Route::prefix('/admin')->controller(AdminHomeController::class)->group(function () {
        Route::post('/dash', 'index')->name('admin.dashboard.index');
        Route::get('/getDash', 'dash')->name('admin.dashboard.dash');
    });



    Route::prefix('/dispositivo')->controller(DeviceController::class)->group(function () {
        Route::get('/', 'index')->name('admin.device.index');
        Route::get('/novo', 'create')->name('admin.device.create');
        Route::post('/delete', 'delete')->name('admin.device.delete');
        Route::get('/getDevices', 'getDevices');
        Route::post('/updateStatus', 'updateStatus');
        Route::post('/updateName', 'updateName');
        Route::get('/getStatus', 'getStatus');
    });

    Route::prefix('/mensagem')->controller(MenssageController::class)->group(function () {
        Route::get('/', 'create')->name('admin.message.create');
        Route::get('/agendamentos', 'indexAgendamentos')->name('admin.message.agendamento');
        Route::get('/getAgendamentos', 'getAgendamentos')->name('admin.message.getAgendamento');
        Route::post('/countContact', 'countContact');
        Route::get('/getMessage', 'getMessage');
        Route::post('/bulk', 'bulkMessage')->name('admin.message.bulk');;
        Route::get('/relatorio-de-envio', 'index')->name('admin.message.index');;
    });

    Route::prefix('/clientes')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('admin.customer.index');
        Route::get('/getCustomers', 'getCustomers');
    });

    Route::prefix('/list-compras')->controller(ShoppingListController::class)->group(function () {
        Route::get('/', 'index')->name('admin.shopping-list.index');
        Route::post('/store', 'store')->name('admin.shopping-list.store');
        Route::get('/getItens', 'getItens')->name('admin.shopping_list.getItens');
        Route::delete('/destroy', 'destroy')->name('admin.shopping-list.destroy');
    });


    Route::prefix('/venda')->controller(VendaController::class)->group(function () {
        Route::get('/sale', 'sale')->name('admin.sale.sale');
        Route::get('/', 'index')->name('admin.sale.index');
        Route::get('/buscar-produtos', 'buscarProdutos');
        Route::get('/obter-produto', 'index');
        Route::post('/store', 'store')->name('admin.sale.store');
        Route::get('/{vendaId}/detalhes', 'detalhes')->name('admin.sale.detalhes');
    });

    Route::prefix('/produtos')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product.index');
        Route::post('/store', 'store')->name('admin.product.store');
        Route::post('/storeSistem', 'storeSistem')->name('admin.product.storeSistem');
        Route::get('/novo', 'create')->name('admin.product.create');
        Route::delete('/destroy/{product}', 'destroy')->name('admin.product.destroy');
        Route::put('/destroy/{product}', 'update')->name('admin.product.update');
        Route::get('/edita', 'edit')->name('admin.product.edit');
    });

    Route::prefix('/categorias')->controller(CategoriaController::class)->group(function () {
        Route::get('/', 'index')->name('admin.categorie.index');
        Route::post('/', 'store')->name('admin.categorie.store');
        Route::get('/create', 'create')->name('admin.categorie.create');
        Route::get('/{categoria}/edit', 'edit')->name('admin.categorie.edit');
        Route::put('/{categoria}', 'update')->name('admin.categorie.update');
        Route::delete('/{categoria}', 'destroy')->name('admin.categorie.destroy');
    });


    Route::prefix('/sangria')->controller(SangriaController::class)->group(function () {
        Route::get('/', 'index')->name('admin.sangria.index');
        Route::post('/store', 'store')->name('admin.sangria.store');
        Route::get('/detalhes/{id}', 'detalhes')->name('admin.sangria.detalhes');
        Route::post('/editar', 'update')->name('admin.sangria.update');
        Route::delete('/deletar/{id}', 'deletar')->name('admin.sangria.delete');
    });


    Route::prefix('/chat-bot')->controller(ChatBotController::class)->group(function () {
        Route::get('/', 'index')->name('admin.chatbot.index');
        Route::post('/store', 'store')->name('admin.menu-chat-bot.store');
    });

    Route::prefix('/atendimento')->controller(ChatBotController::class)->group(function () {
        Route::get('/', 'index')->name('admin.chat.index');
        Route::post('/up', 'up')->name('admin.chat.up');
        Route::get('/getChats', 'getChats');
    });

    Route::prefix('/pedidos')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('admin.order.index');
        Route::get('/getOrders', 'getOrders');
        Route::get('/getOrder', 'getOrder');
    });
});


Route::get('teste1', function () {

    $options = array(
        'cluster' => 'mt1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e13db91a4625ab794815',
        '78f9df6d9a0dc2f85a26',
        '1693149',
        $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);
});
