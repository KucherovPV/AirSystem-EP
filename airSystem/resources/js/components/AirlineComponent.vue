<template>
    <div id="app" class="container mt-5">
        <div class="row">
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
                                <td>{{ airline.name }}</td>
                                <td>{{ airline.country }}</td>
                                <td>{{ airline.locale_code }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(airline.code_iata) ? 'd-none' : 'hidden'" class="btn btn-outline-success m-1"
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
                                <td><input type="text" class="form-control" v-model="airline_name_edit"></td>
                                <td><input type="text" class="form-control" v-model="country_edit"></td>
                                <td><input type="text" class="form-control" v-model="country_code_edit"></td>
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
                            <label for="code_iata">IATA</label>
                            <input type="text" class="form-control" name="code_iata" v-model="code_iata"
                                   required>
                        </div>
                        <div class="form-group ">
                            <label for="code_icao">ICAO</label>
                            <input type="text" class="form-control" name="code_icao" v-model="code_icao" required>
                        </div>
                        <div class="form-group">
                            <label for="airline_name">Название</label>
                            <input type="text" class="form-control" name="airline_name" v-model="airline_name" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Страна</label>
                            <input type="text" class="form-control" name="country" v-model="country"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="country_code">Код страны</label>
                            <input type="text" class="form-control" name="country_code" v-model="country_code"
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
    name: 'AirlineComponent',
    data() {
        return {
            airlines: null,
            editAirlineCode: null,
        }
    },
    mounted() {
        this.getAirlines();
    },
    methods: {
        getAirlines() {
            axios.get('/api/airline')
                .then(
                    response => {
                        this.airlines = response.data
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createAirline() {
            axios.post('/api/airline', {
                code_iata: this.code_iata,
                code_icao: this.code_icao,
                name: this.airline_name,
                country: this.country,
                locale_code: this.country_code
            })
                .then(
                    response => {
                        console.log(response)
                        this.getAirlines();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        changeEditAirlineId(code) {
            this.editAirlineCode = code;
        },
        isEdit(code) {
            return this.editAirlineCode === code;
        },
        editAirline(code) {
            this.editAirlineCode = null;
            axios.patch(`/api/airline/${code}`, {
                code_iata: this.code_iata_edit,
                code_icao: this.code_icao_edit,
                name: this.airline_name_edit,
                country: this.country_edit,
                locale_code: this.country_code_edit
            })
                .then(
                    response => {
                        this.getAirlines();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteAirline(code) {
            axios.delete(`/api/airline/${code}`)
                .then(
                    response => {
                        //console.error(response.data);
                        this.getAirlines();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
    }
}
</script>
