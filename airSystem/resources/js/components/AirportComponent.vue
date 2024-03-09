<template>
    <div id="app" class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
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
                                <td>{{ airport.name }}</td>
                                <td>{{ airport.country }}</td>
                                <td>{{ airport.city }}</td>
                                <td>{{ airport.coordinates }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(airport.code_iata) ? 'd-none' : 'hidden'" class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditAirportCode(airport.code_iata)">Редактировать</button>
                                        <button :class="isEdit(airport.code_iata) ? 'hidden' : 'd-none'" class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAirportCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteAirport(airport.code_iata)">Удалить</button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(airport.code_iata) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="code_iata_edit"></td>
                                <td><input type="text" class="form-control" v-model="code_icao_edit"></td>
                                <td><input type="text" class="form-control" v-model="airport_name_edit"></td>
                                <td><input type="text" class="form-control" v-model="country_edit"></td>
                                <td><input type="text" class="form-control" v-model="city_edit"></td>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Добавить аэропорт
                    </div>
                    <form @submit.prevent="createAirport" id="addForm" method="POST" class="hidden r-3 p-3">
                        <div class="form-group mt-3 mb-3">
                            <label for="code_iata">IATA</label>
                            <input type="text" class="form-control" name="code_iata" v-model="code_iata"
                                   required>
                        </div>
                        <div class="form-group ">
                            <label for="code_icao">ICAO</label>
                            <input type="text" class="form-control" name="code_icao" v-model="code_icao" required>
                        </div>
                        <div class="form-group">
                            <label for="airport_name">Название</label>
                            <input type="text" class="form-control" name="airport_name" v-model="airport_name" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Страна</label>
                            <input type="text" class="form-control" name="country" v-model="country"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="text" class="form-control" name="city" v-model="city"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">Координаты</label>
                            <input type="text" class="form-control" name="coordinates" v-model="coordinates"
                                   required>
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
export default {
    name: 'AirportComponent',
    data() {
        return {
            airports: null,
            editAirportCode: null,
        }
    },
    mounted() {
        this.getAirports();
    },
    methods: {
        getAirports() {
            axios.get('/api/airport')
                .then(
                    response => {
                        this.airports = response.data
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createAirport() {
            axios.post('/api/airport', {
                code_iata: this.code_iata,
                code_icao: this.code_icao,
                name: this.airport_name,
                country: this.country,
                city: this.city,
                coordinates: this.coordinates
            })
                .then(
                    response => {
                        console.log(response)
                        this.getAirports();
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
            axios.patch(`/api/airport/${code}`, {
                code_iata: this.code_iata_edit,
                code_icao: this.code_icao_edit,
                name: this.airport_name_edit,
                country: this.country_edit,
                city: this.city_edit,
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
            axios.delete(`/api/airport/${code}`)
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
