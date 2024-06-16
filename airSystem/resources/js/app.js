
import './bootstrap';
import {createApp} from 'vue';
import router from './components/router.js';
import App from './components/views/App.vue'
import store from "../js/store.js";



const app = createApp({
    components:{App}
});

app.use(store);
app.use(router);
// app.use(BootstrapVue);
app.mount('#app');

