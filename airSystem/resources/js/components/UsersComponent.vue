<template>
    <div id="app" class="container mt-5">
        <div class="row">

            <!-- Список пользователей -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Пользователи
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th>Имя</th>
                            <th>Почта</th>
                            <th>Роль</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer"></tr>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.roles[0]?.name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Список ролей -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Роли
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th>Роль</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer"></tr>
                        <tr v-for="role in roles" :key="role.id">
                            <td>{{ role.name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-5">
                <register-component></register-component>
                    <div class="card mt-3">
                        <div class="card-header">
                            Добавить роль пользователю
                        </div>
                        <div class="card-body">

                            <form @submit.prevent="createBoard" id="addForm" method="POST" class="hidden r-3 p-3">
                                <div class="form-group">
                                    <label for="fk_board_type">Пользователь</label>
                                    <select v-model="fk_board_type" name="fk_board_type" class="form-select form-control" data-size="4">
                                        <template v-for="user in users" :key="user.id">
                                            <option :value="user.id">{{user.email}}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fk_board_type">Роль</label>
                                    <select v-model="fk_board_type" name="fk_board_type" class="form-select form-control" data-size="4">
                                        <template v-for="role in roles" :key="role.id">
                                            <option :value="role.id">{{role.name}}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                    <button type="submit" class="btn btn-primary">Присвоить роль</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</template>

<script>
import RegisterComponent from "../components/auth/RegisterComponent.vue";
export default {
    name: 'UsersComponent',
    components: {RegisterComponent},
    data() {
        return {
            users: null,
            user: null,
            roles: true,
        }
    },
    mounted() {
        this.getUser()
        this.getRoles()
    },
    methods: {
        getUser() {
            axios.get('/api/user/list')
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error('Error getting data:', error);
                });
        },
        getRoles() {
            axios.get('/api/role')
                .then(response => {
                    this.roles = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Error getting data:', error);
                });
        },
        showUser(id) {
            axios.get(`/api/user/${id}`)
                .then(response => {
                    this.user = response.data;
                    console.log(this.user);
                    //$('#userModal').modal('show');
                })
                .catch(error => {
                    console.error('Error getting data:', error);
                });
        }
    },
};
</script>

