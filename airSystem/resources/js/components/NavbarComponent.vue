<template>
    <div v-show="token" class="container-fluid">

        <div class="row flex-nowrap ">
            <div class="nav nav-underline col-auto col-md-3 col-xl-2 px-sm-2 px-0 fixed-sidebar"
                 style="background-color: cadetblue">
                <div
                    class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 ">
                    <a v-if="user" v-bind:href="'/'+ user.role"
                       class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Главная</span>
                    </a>

                    <ul v-show="token && user && user.role === 'admin'"
                        class="nav navbar-nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item ">
                            <router-link to="/admin/users" class="nav-link"
                                         :class="{ active: $route.path === '/user/manage' }">Пользователи
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/categories" class="nav-link"
                                         :class="{ active: $route.path === '/categories' }">Категории
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/airports" class="nav-link"
                                         :class="{ active: $route.path === '/airports' }">Аэропорты
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/airlines" class="nav-link"
                                         :class="{ active: $route.path === '/airlines' }">Авиакомпании
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/boards" class="nav-link"
                                         :class="{ active: $route.path === '/boards' }">
                                Борты
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/countries" class="nav-link"
                                         :class="{ active: $route.path === '/countries' }">
                                Страны / города
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/models" class="nav-link"
                                         :class="{ active: $route.path === '/models' }">
                                Марки / модели
                            </router-link>
                        </li>

                    </ul>
                    <ul v-show="token && user && user.role === 'operator'"
                        class="nav navbar-nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <router-link to="/operator/flights" class="nav-link">Рейсы</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/operator/schedules" class="nav-link">Расписание</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/operator/boarding-takeoff" class="nav-link">Взлёты / посадки</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/operator/delay" class="nav-link">Задержки</router-link>
                        </li>
                    </ul>
                    <ul v-show="token && user && user.role === 'analyst'"
                        class="nav navbar-nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <router-link to="/analyst/airline" class="nav-link">Авиакомпании</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/analyst/flight" class="nav-link">Борты</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/analyst/avg" class="nav-link">Рейсы</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/analyst/category" class="nav-link">Категории</router-link>
                        </li>
                    </ul>
                    <hr>
                    <div v-if="user" class="dropdown pb-4">
                        <p href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline mx-1">{{ user.first_name }} / {{ user.role }}</span>
                        </p>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item btn" @click.prevent="logout">Выход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3" style="padding-left: 15rem;">
                <slot></slot>
            </div>
        </div>
    </div>

    <div v-show="!token">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'NavbarComponent',
    data() {
        return {
            user: null,
            token: null,
        };
    },
    mounted() {
        this.getToken();
        this.getUserInfo();
    },
    updated() {
        this.getToken();
        if (localStorage.getItem('count') === '0') {
            localStorage.setItem('count', '1');
            this.getUserInfo();
        }
    },
    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        },
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('x_xsrf_token');
                    localStorage.removeItem('user_role');
                    localStorage.removeItem('count');
                    this.$router.push({name: 'login'});
                });
        },
        getUserInfo() {

                if (this.token) {
                    axios.get('/api/user')
                        .then(response => {
                            this.user = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching user info:', error);
                        });
                } else {
                    this.user = null;
                }

        }
    }
};
</script>
<style>
.fixed-sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 1030;
    overflow-x: hidden;
    overflow-y: auto;
}


</style>
<style>
.loading-row {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999; /* чтобы убедиться, что анимация загрузки на переднем плане */
}

.text-center {
    text-align: center;
}
</style>
