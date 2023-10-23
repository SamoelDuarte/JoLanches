import './bootstrap';



window.Echo.channel('new-orders')
    .listen('.NewOrderEvent', (e) => {
        // Aqui você pode exibir a notificação no ícone de sino na barra de navegação
        // e informar o usuário sobre o novo pedido.
    });
