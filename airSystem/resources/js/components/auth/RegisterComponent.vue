<template>
                <div class="card">
                    <div class="card-header">Регистрация пользователей</div>
                    <div class="card-body">
                        <form class="mt-3">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                                <div class="col-md-6">
                                    <input v-model="name" id="name" type="text" class="form-control" name="name"
                                           required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Электронная почта</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                           required autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control"
                                           name="password" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтвердить
                                    пароль</label>
                                <div class="col-md-6">
                                    <input v-model="password_confirm" id="password-confirm" type="password"
                                           class="form-control" name="password_confirmation" required
                                           autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button @click.prevent="register" type="submit" class="btn btn-primary">
                                        Зарегистировать
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
</template>

<script>
export default {
    name: 'RegisterComponent',
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirm: null,
        }
    },
    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register/', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirm
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

