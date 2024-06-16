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
                        Взлеты / посадки
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
                            <label class="input-group-text" for="hours">Время</label>
                            <select class="form-select" id="hours" v-model="hours">
                                <option value="1">1 час</option>
                                <option value="3">3 часа</option>
                                <option value="6">6 часов</option>
                                <option value="16">16 часов</option>
                                <option value="24">24 часа</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="orderBy">Сортировать</label>
                            <select class="form-select" id="orderBy" v-model="orderBy">
                                <option value="DESC" selected="selected">По убыванию начала времени действия</option>
                                <option value="asc">По возрастанию начала времени действия</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-2 m-2 ms-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="status_completed"
                                   v-model="status_completed">
                            <label class="form-check-label" for="flexCheckDefault">
                                Выполнено
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="is_boarding_true"
                                   v-model="is_boarding_true">
                            <label class="form-check-label" for="flexCheckDefault">
                                Взлёт
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="false" id="is_boarding_false"
                                   v-model="is_boarding_false">
                            <label class="form-check-label" for="flexCheckDefault">
                                Посадка
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
                            <th class="text-center">Действие (взлёт)</th>
                            <th class="text-center">Номер рейса</th>
                            <th class="text-center">Аэропорт</th>
                            <th class="text-center">Планируемая дата</th>
                            <th class="text-center">Планируемое время</th>
                            <th class="text-center">Дата выполнеия</th>
                            <th class="text-center">Время выполнеия</th>
                            <th class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="boardingTakeoff in boardingTakeoffs" :key="boardingTakeoff.id">
                            <tr>
                                <td><span v-if="boardingTakeoff.is_boarding">&#10003;</span></td>
                                <td>{{ boardingTakeoff.flight_number }}</td>
                                <td>{{ boardingTakeoff.airport_code }}</td>
                                <td>{{ boardingTakeoff.planed_date }}</td>
                                <td>{{ boardingTakeoff.planed_time }}</td>
                                <td>
                                    <span v-if="boardingTakeoff.completed_data">{{
                                            boardingTakeoff.completed_data
                                        }}</span>
                                    <input type="date" class="form-control" name="date_complete"
                                           v-model="date_complete">
                                </td>
                                <td>
                                    <span v-if="boardingTakeoff.completed_time">{{
                                            boardingTakeoff.completed_time
                                        }}</span>
                                    <input type="time" class="form-control" name="time_complete"
                                           v-model="time_complete">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-outline-success m-1"
                                                @click.prevent="submitBoardingTakeoff(boardingTakeoff.id)">Подтвердить
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

            // date_complete: null,
            // time_complete: null,

            hours: 1,
            orderBy: '',
            airport_code: '',
            flight_number: '',
            status_completed: null,
            is_boarding_true: null,
            is_boarding_false: null,
        }
    },
    mounted() {
        this.getSchedule();
        this.fetchData();
    },
    methods: {
        async fetchData() {
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
            if (this.is_boarding_true !== null && this.is_boarding_false !== null) {
                this.is_boarding_false = null
                this.is_boarding_true = null
            }
            if (this.is_boarding_false !== null) {
                this.is_boarding_true = null
                params.append('is_boarding', false);
            }
            if (this.is_boarding_true !== null) {
                this.is_boarding_false = null
                params.append('is_boarding', true);
            }
            this.is_boarding_false = null
            this.is_boarding_true = null
            if (this.status_completed !== null) {
                params.append('status_completed', this.status_completed);
            }
            if (this.airport_code.trim() !== '') {
                params.append('airport_code', this.airport_code);
            }
            if (this.flight_number.trim() !== '') {
                params.append('flight_number', this.flight_number);
            }
            if (this.hours !== 0) {
                params.append('hours', this.hours);
            }

            return `?${params.toString()}`;
        },
        async getSchedule() {
            const queryString = this.buildQueryString();
            try {
                const response = await axios.get(`/api/operator/boarding-takeoffs/${queryString}`);
                this.boardingTakeoffs = response.data;
                console.log(response.data)
            } catch (error) {
                console.error(error);
            }
        },
        async submitBoardingTakeoff(id) {
            let requestData = {}; // Создаем объект для хранения данных для отправки

            // Проверяем наличие даты завершения и времени завершения
            if (this.date_complete) {
                requestData.date_complete = this.date_complete;
                this.date_complete = ''
            }
            if (this.time_complete) {
                requestData.time_complete = this.time_complete;
                this.time_complete = ''
            }
            try {
                await axios.patch(`/api/operator/boarding-takeoffs/${id}`, requestData);
                await this.getSchedule();
            } catch (error) {
                console.error(error);
            }
        },
    }
}
</script>
