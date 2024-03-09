<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div  class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul v-if="user && user.role[0] === 'admin'" class="navbar-nav me-auto">
                        <li   class="nav-item">
                            <router-link to="/admin/" class="nav-link">Админ</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/operator/" class="nav-link">оператор</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/analytics/" class="nav-link">Аналитик</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user/manage" class="nav-link">Пользователи</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/categories" class="nav-link">Категории</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/airports" class="nav-link">Аэропорты</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/airlines" class="nav-link">Авиакомпании</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/boards" class="nav-link">Борт</router-link>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li v-if="!token" class="nav-item">
                            <router-link to="/user/login" class="nav-link">Login</router-link>
                        </li>
<!--                        <li v-if="!token" class="nav-item">-->
<!--                            <router-link to="/user/registration" class="nav-link">Register</router-link>-->
<!--                        </li>-->
                        <li v-if="token" class="nav-item dropdown">
                            <a v-if="user" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user.name }}
                            </a>
                            <div v-if="token" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" @click.prevent="logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import {useSlots} from "vue";

export default {
    name: 'NavbarComponent',
    data() {
        return {
            user: null,
            token: null,
            role: null,
        };
    },
    mounted() {
        this.getToken();
        this.getUserInfo();
    },
    updated() {
        this.getToken();
    },
    methods: {
        useSlots,
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        },
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('x_xsrf_token');
                    this.$router.push({name: 'login'});
                });
        },
        getUserInfo() {
            if(this.token){
            axios.get('/api/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error('Error fetching user info:', error);
                });
        }
        }

    }
};
</script>

