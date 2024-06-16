<template>
    <div v-if="!cities || !airports" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-3">
        <div class="container m-lg-2 col-6">
            <div class="card card-img-left">
                <div class="card-header text-center">
                    <h5 class="mb-0">Создание аэропорта</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createAirport" id="addForm" method="POST">
                        <div class="form-group">
                            <label for="inputCode">Код IATA:</label>
                            <input type="text" class="form-control" name="code_iata" v-model="code_iata"
                                   placeholder="Введите код IATA" required>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Код IACO:</label>
                            <input type="text" class="form-control" name="code_icao" v-model="code_icao"
                                   placeholder="Введите код ICAO" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCity">Название:</label>
                            <input type="text" class="form-control" name="airport_name" v-model="airport_name"
                                   placeholder="Введите название" required>
                        </div>
                        <label for="fk_board_type">Город:</label>
                        <select v-model="city_id" v-if="cities" name="city_id" class="form-select form-control"
                                data-size="4">
                            <template v-for="city in cities" :key="city.id">
                                <option :value="city.id">{{ city.title }} ({{ city.country.title }})</option>
                            </template>
                        </select>
                        <div class="form-group">
                            <label for="inputCountry">Координаты:</label>
                            <input type="text" class="form-control" name="coordinates" v-model="coordinates"
                                   placeholder="Введите координты" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Создать</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row m-lg-2">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header text-center">
                        Аэропорты
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Код iata</th>
                            <th class="text-center">Код icao</th>
                            <th class="text-center">Название</th>
                            <th class="text-center">Страна</th>
                            <th class="text-center">Город</th>
                            <th class="text-center">Координаты</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="airport in airports" :key="airport.code_iata">
                            <tr>
                                <td>{{ airport.code_iata }}</td>
                                <td>{{ airport.code_icao }}</td>
                                <td>{{ airport.title }}</td>
                                <td>{{ airport.country.title }}</td>
                                <td>{{ airport.city.title }}</td>
                                <td>{{ airport.coordinates }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(airport.code_iata) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditAirportCode(airport.code_iata)">Редактировать
                                        </button>
                                        <button :class="isEdit(airport.code_iata) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAirportCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteAirport(airport.code_iata)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(airport.code_iata) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="code_iata_edit"></td>
                                <td><input type="text" class="form-control" v-model="code_icao_edit"></td>
                                <td><input type="text" class="form-control" v-model="airport_name_edit"></td>
                                <td><input type="hidden" class="form-control"></td>
                                <td><select v-model="city_edit_id" v-if="cities" name="city_edit_id"
                                            class="form-select form-control"
                                            data-size="4">
                                    <template v-for="city in cities" :key="city.id">
                                        <option :value="city.id">{{ city.title }} ({{ city.country.title }})</option>
                                    </template>
                                </select>
                                </td>
                                <td><input type="text" class="form-control" v-model="coordinates_edit"></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editAirport(airport.code_iata)">Сохранить
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
    name: 'AirportComponent',
    mixins: [mixin],
    data() {
        return {
            airports: null,
            editAirportCode: null,
            cities: null,
        }
    },
    mounted() {
        this.getAirports();
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                this.cities = await this.getData('/api/admin/cities');
            } catch (error) {
                console.error(error);
            }
        },
        getAirports() {
            axios.get('/api/admin/airports')
                .then(response => {
                    this.airports = response.data; // Получаем данные только для текущей страницы
                })
                .catch(err => {
                    console.error(err);
                });
        },
        createAirport() {
            axios.post('/api/admin/airports', {
                code_iata: this.code_iata,
                code_icao: this.code_icao,
                title: this.airport_name,
                city_id: this.city_id,
                coordinates: this.coordinates
            })
                .then(
                    response => {
                        this.getAirports();
                        this.code_iata = ''
                        this.code_icao = ''
                        this.airport_name = ''
                        this.city_id = ''
                        this.coordinates = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        changeEditAirportCode(code) {
            this.editAirportCode = code;
        },
        isEdit(code) {
            return this.editAirportCode === code;
        },
        editAirport(code) {
            this.editAirportCode = null;
            axios.patch(`/api/admin/airports/${code}`, {
                code_iata: this.code_iata_edit,
                code_icao: this.code_icao_edit,
                name: this.airport_name_edit,
                city: this.city_edit_id,
                coordinates: this.coordinates_edit,
            })
                .then(
                    response => {
                        this.getAirports();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteAirport(code) {
            axios.delete(`/api/admin/airports/${code}`)
                .then(
                    response => {
                        //console.error(response.data);
                        this.getAirports();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
    }
}
</script>
