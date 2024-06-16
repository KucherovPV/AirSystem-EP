<template>
    <div v-if="!countries || !airlines" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-5">
        <div class="row  m-lg-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Авиакомпании
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Код iata</th>
                            <th class="text-center">Код icao</th>
                            <th class="text-center">Название</th>
                            <th class="text-center">Страна</th>
                            <th class="text-center">Код страны</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="airline in airlines" :key="airline.code_iata">
                            <tr>
                                <td>{{ airline.code_iata }}</td>
                                <td>{{ airline.code_icao }}</td>
                                <td>{{ airline.title }}</td>
                                <td>{{ airline.country.title }}</td>
                                <td>{{ airline.country.code }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(airline.code_iata) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditAirlineId(airline.code_iata)">Редактировать
                                        </button>
                                        <button :class="isEdit(airline.code_iata) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAirlineCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteAirline(airline.code_iata)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(airline.code_iata) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="code_iata_edit"></td>
                                <td><input type="text" class="form-control" v-model="code_icao_edit"></td>
                                <td><input type="text" class="form-control" v-model="airline_title_edit"></td>
                                <td>
                                    <select v-model="country_id_edit" v-if="countries" name="country_id_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="country in countries" :key="country.id">
                                            <option :value="country.id">{{ country.title }} ({{
                                                    country.code
                                                }})
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td><input type="hidden" class="form-control"></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editAirline(airline.code_iata)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Добавить авиакомпанию
                    </div>
                    <form @submit.prevent="createAirline" id="addForm" method="POST" class="hidden r-3 p-3">
                        <div class="form-group mt-3 mb-3">
                            <label for="code_iata">Код IATA:</label>
                            <input type="text" class="form-control" name="code_iata" v-model="code_iata" required
                                   placeholder="Введите код IATA">
                        </div>
                        <div class="form-group ">
                            <label for="code_icao">Код ICAO:</label>
                            <input type="text" class="form-control" name="code_icao" v-model="code_icao" required
                                   placeholder="Введите код ICAO">
                        </div>
                        <div class="form-group">
                            <label for="airline_title">Название:</label>
                            <input type="text" class="form-control" name="airline_title" v-model="airline_title"
                                   required
                                   placeholder="Введите название">
                        </div>
                        <div class="form-group">
                            <label for="country_id">Страна:</label>
                            <select v-model="country_id" v-if="countries" name="country_id"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="country in countries" :key="country.id">
                                    <option :value="country.id">{{ country.title }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group mt-2 mb-3">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from "../mixins/mixin.js";

export default {
    name: 'AirlineComponent',
    mixins: [mixin],
    data() {
        return {
            airlines: null,
            editAirlineCode: null,
            countries: null,
            code_iata: '',
            code_icao: '',
            airline_name: '',
            country: '',
            country_code: '',

            loading: false,
        }
    },
    mounted() {
        this.fetchData();
        this.getAirlines();
    },
    methods: {
        async fetchData() {
            try {
                const response = await axios.get('/api/admin/countries');
                this.countries = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async getAirlines() {
            try {
                const response = await axios.get('/api/admin/airlines');
                this.airlines = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async createAirline() {
            try {
                await axios.post('/api/admin/airlines', {
                    code_iata: this.code_iata,
                    code_icao: this.code_icao,
                    name: this.airline_name,
                    country: this.country,
                    locale_code: this.country_code
                });
                this.clearForm();
                await this.getAirlines();
            } catch (error) {
                console.error(error);
            }
        },
        async editAirline(code) {
            try {
                await axios.patch(`/api/admin/airlines/${code}`, {
                    code_iata: this.code_iata_edit,
                    code_icao: this.code_icao_edit,
                    name: this.airline_name_edit,
                    country: this.country_edit,
                    locale_code: this.country_code_edit
                });
                await this.getAirlines();
            } catch (error) {
                console.error(error);
            }
        },
        async deleteAirline(code) {
            try {
                await axios.delete(`/api/admin/airlines/${code}`);
                await this.getAirlines();
            } catch (error) {
                console.error(error);
            }
        },
        clearForm() {
            this.code_iata = '';
            this.code_icao = '';
            this.airline_name = '';
            this.country = '';
            this.country_code = '';
        },
        changeEditAirlineId(code) {
            this.editAirlineCode = code;
        },
        isEdit(code) {
            return this.editAirlineCode === code;
        },
    }
}
</script>
