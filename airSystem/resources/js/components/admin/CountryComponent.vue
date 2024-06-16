<template>
    <div v-if="!countries || !cities" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-3">
        <div class="row">
            <div class="container m-lg-4 col-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Создание страны</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createCountry" id="addForm" method="POST">
                            <div class="form-group">
                                <label for="inputCode">Название:</label>
                                <input type="text" class="form-control" name="country_title" v-model="country_title"
                                       placeholder="Введите название страны" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Код страны:</label>
                                <input type="text" class="form-control" name="country_code" v-model="country_code"
                                       placeholder="Введите код код страны" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container m-lg-4 col-6">
                <div class="card ">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Создание города</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createCity" id="addCityForm" method="POST">
                            <div class="form-group">
                                <label for="inputCode">Название:</label>
                                <input type="text" class="form-control" name="city_title" v-model="city_title"
                                       placeholder="Введите название города" required>
                            </div>
                            <div class="form-group">
                                <label for="fk_board_type">Cтрана:</label>
                                <select v-model="country_id" v-if="countries" name="city_id"
                                        class="form-select form-control"
                                        data-size="4">
                                    <template v-for="country in countries" :key="country.id">
                                        <option :value="country.id">{{ country.title }}</option>
                                    </template>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="container m-lg-4 col-5">
                <div class="card ">
                    <div class="card-header text-center">
                        Страны
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Название</th>
                            <th class="text-center">Код страны</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="country in countries" :key="country.id">
                            <tr>
                                <td>{{ country.title }}</td>
                                <td>{{ country.code }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(1,country.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditCountryCode(country.id)">Редактировать
                                        </button>
                                        <button :class="isEdit(1,country.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editCountryId = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteCountry(country.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(1,country.id) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="country_title_edit"></td>
                                <td><input type="text" class="form-control" v-model="country_code_edit"></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editCountry(country.id)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container m-lg-4 col-6">
                <div class="card ">
                    <div class="card-header text-center">
                        Города
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Название</th>
                            <th class="text-center">Код страны</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="city in cities" :key="city.id">
                            <tr>
                                <td>{{ city.title }}</td>
                                <td>{{ city.country.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(0,city.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditCityCode(city.id)">Редактировать
                                        </button>
                                        <button :class="isEdit(0,city.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editCityId = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteCity(city.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(0,city.id) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="city_title_edit"></td>
                                <td><input type="text" class="form-control" v-model="city_code_edit"></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editCity(city.id)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from "../mixins/mixin.js";

export default {
    name: 'CountryComponent',
    mixins: [mixin],
    data() {
        return {
            countries: null,
            editCountryId: null,
            editCityId: null,
            cities: null,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                this.countries = await this.getData('/api/admin/countries');
            } catch (error) {
                console.error(error);
            }
            try {
                this.cities = await this.getData('/api/admin/cities');
            } catch (error) {
                console.error(error);
            }
        },
        createCountry() {
            axios.post('/api/admin/countries', {
                title: this.country_title,
                code: this.country_code,
            })
                .then(
                    response => {
                        this.fetchData();
                        this.country_title = ''
                        this.country_code = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createCity() {
            axios.post('/api/admin/cities', {
                title: this.city_title,
                country_id: this.country_id,
            })
                .then(
                    response => {
                        this.fetchData();
                        this.city_title = ''
                        this.country_id = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        changeEditCountryCode(id) {
            this.editCountryId = id;
        },
        changeEditCityCode(id) {
            this.editCityId = id;
        },
        isEdit(mark ,id) {
            if (mark === 1)
                return this.editCountryId === id;
            else {
                return this.editCityId === id;
            }
        },
        editCountry(id) {
            this.editCountryId = null;
            axios.patch(`/api/admin/countries/${id}`, {
                title: this.country_title_edit,
                code: this.country_code_edit,
            })
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        editCity(id) {
            this.editCountryId = null;
            axios.patch(`/api/admin/cities/${id}`, {
                title: this.city_title_edit,
                country_id: this.country_id_edit,
            })
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteCountry(id) {
            axios.delete(`/api/admin/countries/${id}`)
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteCity(id) {
            axios.delete(`/api/admin/cities/${id}`)
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
    }
}
</script>
