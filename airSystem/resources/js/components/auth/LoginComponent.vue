<template>
    <section class="vh-100" style="background-color: cadetblue;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img
                                    src="https://img.freepik.com/premium-vector/plane-airport-arrivals-departures-travel-sky-cloud_64478-346.jpg?w=360"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form>

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <img src="https://cdn-icons-png.flaticon.com/128/2685/2685481.png"
                                                 alt="logo" class="img-fluid"
                                                 style="  display: block;max-width: 70px; height: 70px;"/>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Войдите в свою учетную запись</h5>

                                        <div class="form-outline mb-4">
                                            <input v-model="email" id="email" type="email"
                                                   class="form-control form-control-lg"/>
                                            <label class="form-label" for="form2Example17">Адрес электронной почты</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input v-model="password" id="password" type="password"
                                                   class="form-control form-control-lg"/>
                                            <label class="form-label" for="form2Example27">Пароль</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" @click.prevent="login"
                                                    type="submit">Login
                                            </button>
                                        </div>
                                        <div v-if="errors"
                                             class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
                                            <div v-for="(v, k) in errors" :key="k">
                                                <p v-for="error in v" :key="error" class="text-sm">
                                                    {{ error }}
                                                </p>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'LoginComponent',
    data() {
        return {
            email: null,
            password: null,
            errors: null,
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password})
                    .then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                        if (localStorage.getItem('x_xsrf_token')) {
                            axios.get('/api/user')
                                .then(r => {
                                    localStorage.setItem('user_role', r.data.role);
                                    localStorage.setItem('count', '0');
                                    this.$router.push({name: r.data.role});

                                })
                                .catch(err => {
                                    this.errors = err.response;
                                    console.log(err.response);
                                });
                        }
                    })
                    .catch(err => {
                        this.errors = err.response;
                        console.log(err.response);
                    })
            })
        }
    }
}
</script>
