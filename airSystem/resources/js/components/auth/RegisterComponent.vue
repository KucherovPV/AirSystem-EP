<template>
    <div class="card card-img-left">
        <div class="card-header text-center">
            <h5 class="mb-0">Создание пользователей</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="register" method="POST">
                <div class="form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" class="form-control" name="last_name" v-model="last_name"
                           placeholder="Введите код фамилию" required>
                </div>
                <div class="form-group">
                    <label for="first_name">Имя:</label>
                    <input type="text" class="form-control" name="first_name" v-model="first_name"
                           placeholder="Введите имя" required>
                </div>
                <div class="form-group">
                    <label for="patronymic">Отчество:</label>
                    <input type="text" class="form-control" name="patronymic" v-model="patronymic"
                           placeholder="Введите отчество" required>
                </div>
                <div class="form-group">
                    <label for="email">Электронная почта:</label>
                    <input type="email" class="form-control" name="email" v-model="email"
                           placeholder="Введите электронную почту" required>
                </div>
                <label for="role">Роль:</label>
                <select v-model="role" v-if="roles" name="role" class="form-select form-control"
                        data-size="4">
                    <template v-for="(value, key) in roles" :key="key">
                        <option :value="key">{{ value }}</option>
                    </template>
                </select>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" class="form-control" name="password" v-model="password"
                           placeholder="Введите пароль" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Подтвердите пароль:</label>
                    <input type="password" class="form-control" name="password_confirmation"
                           v-model="password_confirmation"
                           placeholder="Подтвердите пароль" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Создать</button>
            </form>
        </div>
    </div>
</template>

<script>
import mixin from "../mixins/mixin.js";

export default {
    name: 'RegisterComponent',
    mixins: [mixin],
    data() {
        return {
            roles: null,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/user/roles', {})
                    .then(res => {
                        this.roles = res.data;
                        console.log(res.data)
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            })
        },
        register() {
            console.log(this.first_name + ' ' +
                this.last_name + ' ' +
                this.patronymic + ' ' +
                this.role + ' ' +
                this.email + ' ' +
                this.password + ' ' +
                this.password_confirmation
            )
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/admin/users', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    patronymic: this.patronymic,
                    role: this.role,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(res => {
                        console.log(res)
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            })
        }
    }
}
</script>

