<template>
    <div v-if="!roles" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-5">
        <div class="col">
            <div class="row m-lg-2">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="mb-0">Создание пользователей</h5>
                        </div>
                        <div class="card-body">
                            <form ref="createForm" @submit.prevent="register" method="POST">
                                <div class="form-group">
                                    <label for="last_name">Фамилия:</label>
                                    <input type="text" class="form-control" name="last_name" v-model="last_name"
                                           placeholder="Введите фамилию" required>
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
                                           placeholder="Введите электронную почту" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="role">Роль:</label>
                                    <select v-model="role" v-if="roles" name="role" class="form-select form-control"
                                            data-size="4">
                                        <template v-for="(value, key) in roles" :key="key">
                                            <option :value="key">{{ value }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль:</label>
                                    <input type="password" class="form-control" name="password" v-model="password"
                                           placeholder="Введите пароль" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль:</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           v-model="password_confirmation"
                                           placeholder="Подтвердите пароль" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Создать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-lg-2">
                <div class="col-md-12    mt-3">
                    <!-- Список пользователей -->
                    <div class="card">
                        <div class="card-header text-center">
                            Пользователи
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead class="non-clickable">
                                <tr>
                                    <th style="width: 30%;">Фамилия</th>
                                    <th style="width: 30%;">Имя</th>
                                    <th style="width: 30%;">Отчество</th>
                                    <th style="width: 20%;">Почта</th>
                                    <th style="width: 30%;">Роль</th>
                                    <th style="width: 30%;">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="cursor-pointer"></tr>
                                <template v-for="user in users" :key="user.id">
                                    <tr>
                                        <td>{{ user.last_name }}</td>
                                        <td>{{ user.first_name }}</td>
                                        <td>{{ user.patronymic }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.role }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button :class="isEdit(user.id) ? 'd-none' : 'hidden'"
                                                        class="btn btn-outline-success m-1"
                                                        @click.prevent="changeEditUserId(user.id)">Редактировать
                                                </button>
                                                <button :class="isEdit(user.id) ? 'hidden' : 'd-none'"
                                                        class="btn btn-outline-secondary m-1"
                                                        @click.prevent="this.editUserId = null">Отмена
                                                </button>
                                                <button class="btn btn-outline-danger m-1"
                                                        @click.prevent="deleteUser(user.id)">Удалить
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr :class="isEdit(user.id) ?'':'d-none'">
                                        <td><input type="text" class="form-control" name="last_name_edit"
                                                   v-model="last_name_edit"></td>
                                        <td><input type="text" class="form-control" name="first_name_edit"
                                                   v-model="first_name_edit"></td>
                                        <td><input type="text" class="form-control" name="patronymic_edit"
                                                   v-model="patronymic_edit"></td>
                                        <td><input type="email" class="form-control" name="email_edit"
                                                   v-model="email_edit"></td>
                                        <td><select v-model="role_edit" v-if="roles" name="role_edit"
                                                    class="form-select form-control"
                                                    data-size="4">
                                            <template v-for="(value, key) in roles" :key="key">
                                                <option :value="key">{{ value }}</option>
                                            </template>
                                        </select></td>
                                        <td>
                                            <button class="btn btn-outline-success m-1"
                                                    @click.prevent="updateUser(user.id)">Сохранить
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Список ролей -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import mixin from "../mixins/mixin.js";

export default {
    name: 'UsersComponent',
    mixins: [mixin],
    data() {
        return {
            users: null,
            user: null,
            roles: null,
            editUserId: null,
        }
    },
    mounted() {
        this.getUser()
        this.fetchData();
    },
    methods: {
        getUser() {
            this.editUserId = null;
            axios.get('/api/admin/users')
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error('Error getting data:', error);
                });
        },
        updateUser(id) {
            axios.patch(`/api/admin/users/${id}`, {
                first_name: this.first_name_edit,
                last_name: this.last_name_edit,
                patronymic: this.patronymic_edit,
                role: this.role_edit,
                email: this.email_edit,
            })
                .then(res => {
                    if (res) {
                        this.first_name_edit = ''
                        this.last_name_edit = ''
                        this.patronymic_edit = ''
                        this.role_edit = ''
                        this.email_edit = ''
                        this.getUser();
                    }
                })
                .catch(err => {
                    console.error(err.response);
                });
        },
        deleteUser(id) {
            axios.delete(`/api/admin/users/${id}`)
                .then(response => {
                    this.getUser()
                })
                .catch(error => {
                    console.error('Error deleting data:', error);
                });
        },
        changeEditUserId(id) {
            this.editUserId = id;
        },
        isEdit(id) {
            return this.editUserId === id;
        },
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
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
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
                            this.first_name = ''
                            this.last_name = ''
                            this.patronymic = ''
                            this.role = ''
                            this.email = ''
                            this.password = ''
                            this.password_confirmation = ''
                            this.getUser()
                            this.$refs.createForm.reset();

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
};
</script>
