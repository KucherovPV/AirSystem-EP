<template>
    <div v-if="!airports || !flights" class="loading-row">
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
                    <h5 class="mb-0">Создание рейса</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createAirport" id="addForm" method="POST">
                        <div class="form-group">
                            <label for="inputCode">Номер рейса:</label>
                            <input type="text" class="form-control" name="flight_number" v-model="flight_number"
                                   placeholder="Введите номер рейса" required>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Номер борта:</label>
                            <select v-model="board_code" v-if="boards" name="board_code"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="board in boards" :key="board.code_iata">
                                    <option :value="board.board_code">{{ board.board_code }} ({{
                                            board.airline.code_iata
                                        }})
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Аэропорт (откуда):</label>
                            <select v-model="airport_code_where" v-if="airports" name="airport_code_where"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.title }} ({{
                                            airport.code_iata
                                        }})
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Аэропорт (куда):</label>
                            <select v-model="airport_code_whither" v-if="airports" name="airport_code_whither"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.title }} ({{
                                            airport.code_iata
                                        }})
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Авиакомпания:</label>
                            <select v-model="airline_code" v-if="airlines" name="airline_code"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="airline in airlines" :key="airline.code_iata">
                                    <option :value="airline.code_iata">{{ airline.title }} ({{
                                            airline.code_iata
                                        }})
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Тип рейса:</label>
                            <select v-model="flight_type_id" v-if="types" name="flight_type_id"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="type in types" :key="type.id">
                                    <option :value="type.id">{{ type.title }}</option>
                                </template>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        <div class="row">
                            <input class="custom-file-input mt-2" type="file" @change="handleFileUpload">

                        </div>

                    </form>
                    <button
                        class="btn btn-outline-secondary mt-3" @click="uploadFile">Загрузить
                    </button>

                </div>
            </div>
        </div>
        <div class="row m-lg-2">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header text-center">
                        Рейсы
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Номер рейса</th>
                            <th class="text-center">Номер борта</th>
                            <th class="text-center">Аэропорт (куда)</th>
                            <th class="text-center">Аэропорт (откуда)</th>
                            <th class="text-center">Авиакомпания</th>
                            <th class="text-center">Тип рейса</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="flight in flights" :key="flight.flight_number">
                            <tr>
                                <td>{{ flight.flight_number }}</td>
                                <td>{{ flight.board }}</td>
                                <td>{{ flight.airport_where.title }}</td>
                                <td>{{ flight.airport_whither.title }}</td>
                                <td>{{ flight.airline.title }}</td>
                                <td>{{ flight.type.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(flight.flight_number) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditAirportCode(flight.flight_number)">
                                            Редактировать
                                        </button>
                                        <button :class="isEdit(flight.flight_number) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAirportCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteFlight(flight.flight_number)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(flight.flight_number) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="flight_number_edit"></td>
                                <td>
                                    <select v-model="airport_code_whither_edit" v-if="airports"
                                            name="airport_code_whither_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="board in boards" :key="board.code_iata">
                                            <option :value="board.board_code">{{ board.board_code }}
                                                ({{ board.airline.code_iata }})
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select v-model="airport_code_where_edit" v-if="airports"
                                            name="airport_code_where_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="airport in airports" :key="airport.code_iata">
                                            <option :value="airport.code_iata">{{ airport.title }} ({{
                                                    airport.code_iata
                                                }})
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select v-model="airport_code_whither_edit" v-if="airports"
                                            name="airport_code_whither_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="airport in airports" :key="airport.code_iata">
                                            <option :value="airport.code_iata">{{ airport.title }} ({{
                                                    airport.code_iata
                                                }})
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select v-model="airline_code_edit" v-if="airlines" name="airline_code_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="airline in airlines" :key="airline.code_iata">
                                            <option :value="airline.code_iata">{{ airline.title }} ({{
                                                    airline.code_iata
                                                }})
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select v-model="flight_type_id_edit" v-if="types" name="flight_type_id_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="type in types" :key="type.id">
                                            <option :value="type.id">{{ type.title }}</option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editFlight(flight.flight_number)">Сохранить
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
    name: 'FlightComponent',
    mixins: [mixin],
    data() {
        return {
            flights: null,
            editAirportCode: null,
            airports: null,
            airlines: null,
            boards: null,
            types: null,

            flight_number: '',
            board_code: '',
            airport_code_where: '',
            airport_code_whither: '',
            airline_code: '',
            flight_type_id: '',
        }
    },
    mounted() {
        this.fetchData();
        this.getFlights();
    },
    methods: {
        async fetchData() {
            try {
                const [airports, airlines, boards, types] = await Promise.all([
                    this.getData('/api/operator/airports'),
                    this.getData('/api/operator/airlines'),
                    this.getData('/api/operator/boards'),
                    this.getType('operator', 'is_board_type')
                ]);
                this.airports = airports;
                this.airlines = airlines;
                this.boards = boards;
                this.types = types;
            } catch (error) {
                console.error(error);
            }
        },
        async getFlights() {
            try {
                const response = await axios.get('/api/operator/flights');
                this.flights = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async createAirport() {
            try {
                await axios.post('/api/operator/flights', {
                    flight_number: this.flight_number,
                    board_code: this.board_code,
                    airport_code_where: this.airport_code_where,
                    airport_code_whither: this.airport_code_whither,
                    airline_code: this.airline_code,
                    flight_type_id: this.flight_type_id
                });
                this.clearForm();
                await this.getFlights();
            } catch (error) {
                console.error(error);
            }
        },
        async editFlight(code) {
            try {
                await axios.patch(`/api/operator/flights/${code}`, {
                    flight_number: this.flight_number_edit,
                    board_code: this.board_code_edit,
                    airport_code_where: this.airport_code_where_edit,
                    airport_code_whither: this.airport_code_whither_edit,
                    airline_code: this.airline_code_edit,
                    flight_type_id: this.flight_type_id_edit
                });
                await this.getFlights();
            } catch (error) {
                console.error(error);
            }
        },
        async deleteFlight(code) {
            try {
                await axios.delete(`/api/operator/flights/${code}`);
                await this.getFlights();
            } catch (error) {
                console.error(error);
            }
        },
        clearForm() {
            this.flight_number = ''
            this.board_code = ''
            this.airport_code_where = ''
            this.airport_code_whither = ''
            this.airline_code = ''
            this.flight_type_id = ''
        },
        changeEditAirportCode(code) {
            this.editAirportCode = code;
        },
        isEdit(code) {
            return this.editAirportCode === code;
        },
        handleFileUpload(event) {
            this.file = event.target.files[0];
        },
        uploadFile() {
            let formData = new FormData();
            formData.append('file', this.file);
            axios.post('/api/operator/flights/import', formData)
                .then(response => {
                    this.getFlights()
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
}
</script>
