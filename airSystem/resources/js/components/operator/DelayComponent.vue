<template>
    <div v-if="!flights" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-3">
        <div class="row m-lg-2">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header text-center">
                        Задержки
                    </div>
                    <div class="row">
                        <div class="input-group mb-3  m-2 col">
                            <label class="input-group-text" for="flight_number">Номер рейса</label>
                            <select class="form-select" id="flight_number" v-model="flight_number">
                                <template v-for="flight in flights" :key="flight.flight_number">
                                    <option :value="flight.flight_number">{{ flight.flight_number }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="airport_code">Аэропорт</label>
                            <select class="form-select" id="inputGroupSelect03" v-model="airport_code"
                                    @change="fetchData">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.code_iata }}</option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="orderBy">Сортировать</label>
                            <select class="form-select" id="orderBy" v-model="orderBy">
                                <option value="DESC" selected="selected">По убыванию длительности задержки</option>
                                <option value="asc">По возрастанию длительности задержки</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-2 m-2 ms-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="false" id="is_process"
                                   v-model="is_process">
                            <label class="form-check-label" for="is_process">
                                Завершены
                            </label>
                        </div>
                        <button class="btn btn-outline-danger " type="button"
                                @click.prevent="clearRequest">
                            Очистить параметры
                        </button>
                        <button class="btn btn-outline-secondary  mt-2  " type="button"
                                @click.prevent="getSchedule">
                            Получить
                        </button>
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Время задержки (часы)</th>
                            <th class="text-center">Номер рейса</th>
                            <th class="text-center">Аэропорт</th>
                            <th class="text-center">Краткое описание</th>
                            <th class="text-center">Полное описание</th>
                            <th class="text-center">Тип задержки</th>
                            <th class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="boardingTakeoff in boardingTakeoffs" :key="boardingTakeoff.id">
                            <tr>
                                <td>{{ boardingTakeoff.approximate_time }}</td>
                                <td>{{ boardingTakeoff.flight_number }}</td>
                                <td>{{ boardingTakeoff.airport_code }}</td>
                                <td>
                                    <span v-if="boardingTakeoff.title">{{
                                            boardingTakeoff.title
                                        }}</span>
                                    <input v-if="!boardingTakeoff.title" type="text" class="form-control" name="title"
                                           v-model="title">
                                </td>
                                <td>
                                    <span v-if="boardingTakeoff.content">{{
                                            boardingTakeoff.content
                                        }}</span>
                                    <input v-if="!boardingTakeoff.type_category" type="text" class="form-control"
                                           name="content"
                                           v-model="content">
                                </td>
                                <td>
                                    <span v-if="boardingTakeoff.type_category">{{
                                            boardingTakeoff.type_category.title
                                        }}</span>
                                    <select v-model="reason_type_id" v-if="types && !boardingTakeoff.type_category"
                                            name="reason_type_id"
                                            class="form-select form-control" data-size="4">
                                        <template v-for="type in types" :key="type.id">
                                            <option :value="type.id">{{ type.title }}</option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <div  class="d-flex">
                                        <button v-if="boardingTakeoff.is_process" class="btn btn-outline-success m-1"
                                                @click.prevent="submitBoardingTakeoff(boardingTakeoff.id)">Заполнить
                                        </button>
                                    </div>
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
    name: 'BoardingTakeoffComponent',
    mixins: [mixin],
    data() {
        return {
            boardingTakeoffs: null,
            flights: null,
            airports: null,
            types: null,

            // date_complete: null,
            // time_complete: null,

            orderBy: '',
            airport_code: '',
            flight_number: '',
            is_process: null,
        }
    },
    mounted() {
        this.getSchedule();
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                this.types = await this.getType('operator', 'is_reason_category');
            } catch (error) {
                console.error(error);
            }
            try {
                const [flights, airports] = await Promise.all([
                    this.getData('/api/operator/flights'),
                    this.getData('/api/operator/airports'),
                ]);
                this.flights = flights;
                this.airports = airports;
            } catch (error) {
                console.error(error);
            }
        },
        buildQueryString() {
            const params = new URLSearchParams();

            if (this.orderBy.trim() !== '') {
                params.append('orderBy', this.orderBy);
            }
            if (this.is_process !== null) {
                params.append('is_process', false);
                this.is_process = null
            }
            if (this.airport_code.trim() !== '') {
                params.append('airport_code', this.airport_code);
            }
            if (this.flight_number.trim() !== '') {
                params.append('flight_number', this.flight_number);
            }

            return `?${params.toString()}`;
        },
        async getSchedule() {
            const queryString = this.buildQueryString();
            try {
                const response = await axios.get(`/api/operator/delays/${queryString}`);
                this.boardingTakeoffs = response.data;
                console.log(response.data)
            } catch (error) {
                console.error(error);
            }
        },
        async submitBoardingTakeoff(id) {

            try {
                await axios.patch(`/api/operator/delays/${id}`, {
                    title: this.title,
                    content: this.content,
                    reason_type_id: this.reason_type_id,
                });
                await this.getSchedule();
            } catch (error) {
                console.error(error);
            }
        },
    }
}
</script>
