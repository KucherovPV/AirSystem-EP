import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
import router from "@/components/router.js";
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;

window.axios.interceptors.response.use({}, error => {
    if (error.response.status === 401 || error.response.status === 419){
        const token = localStorage.getItem('x_xsrf_token');
        if(token){
            localStorage.removeItem('x_xsrf_token');
        }
        router.push({name:'login'})
    }
})
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// Import Echo from 'laravel-echo';

// Import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: Import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: Import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: Import.meta.env.VITE_PUSHER_HOST ?? `ws-${Import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: Import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: Import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (Import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
