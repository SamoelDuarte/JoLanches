/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher', // Configura o driver de broadcasting como Pusher
    key: 'e13db91a4625ab794815', // Use a chave do Pusher definida no arquivo .env
    cluster: 'mt1', // Use o cluster do Pusher definido no arquivo .env
    encrypted: false, // Defina como true se estiver usando conexões seguras (HTTPS)
});

// Opcional: Você pode autenticar o usuário se for necessário para canais privados
// Echo.private('user.' + userId)
//     .auth(userAuthToken);

export default Echo;

