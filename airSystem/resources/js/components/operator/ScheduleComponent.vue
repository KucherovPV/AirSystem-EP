<template>
    <div v-if="!airlines" class="loading-row">
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
                    <h5 class="mb-0">Создание расписания</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createAirport" id="addForm" method="POST">
                        <div class="form-group">
                            <label for="fk_board_type">Номер рейса:</label>
                            <select v-model="flight_number_create" v-if="flights" name="flight_number_create"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="flight in flights" :key="flight.flight_number">
                                    <option :value="flight.flight_number">{{ flight.flight_number }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputCode">Дата начала действия (включительно):</label>
                            <input type="date" class="form-control" name="start_date" v-model="start_date"
                                   placeholder="Введите дату начала действия" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCode">Дата конца действия (включительно):</label>
                            <input type="date" class="form-control" name="end_date" v-model="end_date"
                                   placeholder="Введите дату начала действия" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCode">Время вылета:</label>
                            <input type="time" class="form-control" name="boarding_time" v-model="boarding_time"
                                   placeholder="Введите время вылета" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCode">Время посадки:</label>
                            <input type="time" class="form-control" name="takeoff_time" v-model="takeoff_time"
                                   placeholder="Введите время посадки" required>
                        </div>
                        <div class="form-check" v-for="(day, index) in days" :key="index">
                            <input class="form-check-input" type="checkbox" :value="day.id" v-model="checkedDays">
                            <label class="form-check-label">{{ day.name }}</label>
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
                        Расписание рейсов
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
                            <label class="input-group-text" for="airline_code">Авиакомпания</label>
                            <select class="form-select" id="airline_code" v-model="airline_code">
                                <template v-for="airline in airlines" :key="airline.code_iata">
                                    <option :value="airline.code_iata">{{ airline.code_iata }} ({{ airline.title }})
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="airport_whither">Аэропорт прибытия</label>
                            <select class="form-select" id="inputGroupSelect03" v-model="selectedType3"
                                    @change="fetchData">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.code_iata }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="inputGroupSelect04">Аэропорт отбытия</label>
                            <select class="form-select" id="inputGroupSelect04" v-model="selectedType4"
                                    @change="fetchData">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.code_iata }}</option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3  m-2 col">
                            <label class="input-group-text" for="boarding_time_start">Время вылета от:</label>
                            <input type="time" class="form-control" name="boarding_time_start" v-model="boarding_time_start">
                            <label class="input-group-text" for="boarding_time_end">До:</label>
                            <input type="time" class="form-control" name="boarding_time_end" v-model="boarding_time_end">
                        </div>
                        <div class="input-group mb-3  m-2 col">
                            <label class="input-group-text" for="takeoff_time_start">Время посадки от:</label>
                            <input type="time" class="form-control" name="takeoff_time_start" v-model="takeoff_time_start">
                            <label class="input-group-text" for="takeoff_time_end">До:</label>
                            <input type="time" class="form-control" name="takeoff_time_end" v-model="takeoff_time_end">
                        </div>
                    </div>
                    <div class="row col-2 m-2 ms-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="actual" v-model="actual">
                        <label class="form-check-label" for="flexCheckDefault">
                            Действующее
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
                            <th class="text-center">Воздушная лининия</th>
                            <th class="text-center">Номер рейса</th>
                            <th class="text-center">Авиакомпания</th>
                            <th class="text-center">Аэропорт отбытия</th>
                            <th class="text-center">Время отбытия</th>
                            <th class="text-center">Аэропорт прибытия</th>
                            <th class="text-center">Время прибытия</th>
                            <th class="text-center">Дни недели</th>
                            <th class="text-center">Время действия</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="schedule in schedules" :key="schedule.schedule_number">
                            <tr>
                                <td>{{ schedule.flight.airport_where.city.title }} -
                                    {{ schedule.flight.airport_whither.city.title }}
                                </td>
                                <td>{{ schedule.flight_number }}</td>
                                <td>{{ schedule.flight.airline.title }}</td>
                                <td>{{ schedule.flight.airport_where.code_iata }}</td>
                                <td>{{ schedule.boarding_time }}</td>
                                <td>{{ schedule.flight.airport_whither.code_iata }}</td>
                                <td>{{ schedule.takeoff_time }}</td>
                                <td>
                                    <template v-for="day in schedule.days" :key="day.id">
                                        <td>{{ day.title }}</td>
                                        <br>
                                    </template>
                                </td>
                                <td>{{ schedule.start_date }}-{{ schedule.end_date }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(schedule.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditAirportCode(schedule.id)">
                                            Редактировать
                                        </button>
                                        <button :class="isEdit(schedule.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAirportCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteFlight(schedule.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(schedule.id) ?'':'d-none'">
                                <td><input type="hidden"></td>
                                <td>
                                    <select v-model="flight_number_edit" v-if="flights"
                                            name="airport_code_where_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="flight in flights" :key="flight.flight_number">
                                            <option :value="flight.flight_number">{{ flight.flight_number }}
                                            </option>
                                        </template>
                                    </select>
                                </td>
                                <td><input type="hidden"></td>
                                <td><input type="hidden"></td>
                                <td>
                                    <input type="time" class="form-control" name="takeoff_time_edit" v-model="takeoff_time_edit" required>
                                </td>
                                <td><input type="hidden"></td>
                                <td>
                                    <input type="time" class="form-control" name="takeoff_time_edit" v-model="takeoff_time_edit" required>
                                </td>
                                <td>
                                    <div class="form-check" v-for="(day, index) in days" :key="index">
                                        <input class="form-check-input" type="checkbox" :value="day.id" v-model="checkedDays">
                                        <label class="form-check-label">{{ day.name }}</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="start_date_edit" v-model="start_date_edit" required>
                                    <input type="date" class="form-control" name="start_date_edit" v-model="start_date_edit" required>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editFlight(schedule.id)">Сохранить
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
import {arrow} from "@popperjs/core";

export default {
    name: 'ScheduleComponent',
    mixins: [mixin],
    data() {
        return {
            flights: null,
            airports: null,
            airlines: null,
            schedules: null,
            editAirportCode: null,

            flight_number_create: '',
            start_date: '',
            end_date: '',
            boarding_time: '',
            takeoff_time: '',
            day_ids: '',

            flight_number: '',
            airline_code: '',
            airport_where: '',
            airport_whither: '',
            takeoff_time_start: '',
            takeoff_time_end: '',
            boarding_time_start: '',
            boarding_time_end: '',
            actual: '',
            days: [
                { id: 1, name: 'Понедельник' },
                { id: 2, name: 'Вторник' },
                { id: 3, name: 'Среда' },
                { id: 4, name: 'Четверг' },
                { id: 5, name: 'Пятница' },
                { id: 6, name: 'Суббота' },
                { id: 7, name: 'Воскресенье' }
            ],
            checkedDays: []
        }
    },
    mounted() {
        this.fetchData();
//        this.getSchedule();
    },
    methods: {
        async fetchData() {
            try {
                const [flights, airports, airlines] = await Promise.all([
                    this.getData('/api/operator/flights'),
                    this.getData('/api/operator/airports'),
                    this.getData('/api/operator/airlines'),
                ]);
                this.flights = flights;
                this.airports = airports;
                this.airlines = airlines;
            } catch (error) {
                console.error(error);
            }
        },
        buildQueryString() {
            const params = new URLSearchParams();
            // Проверяем, есть ли указанный номер рейса
            if (this.flight_number.trim() !== '') {
                params.append('flight_number', this.flight_number);
            }
            // Если номер рейса не указан, можно добавить другие параметры, если они есть
            else {
                if (this.airline_code.trim() !== '') {
                    params.append('airline_code', this.airline_code);
                }
                if (this.airport_where.trim() !== '') {
                    params.append('airport_code_where', this.airport_where);
                }
                if (this.airport_whither.trim() !== '') {
                    params.append('airport_code_whither', this.airport_whither);
                }
                if (this.takeoff_time_start.trim() !== '') {
                    params.append('takeoff_time_start', this.takeoff_time_start);
                }
                if (this.takeoff_time_end.trim() !== '') {
                    params.append('takeoff_time_end', this.takeoff_time_end);
                }
                if (this.boarding_time_start.trim() !== '') {
                    params.append('boarding_time_start', this.boarding_time_start);
                }
                if (this.boarding_time_end.trim() !== '') {
                    params.append('boarding_time_end', this.boarding_time_end);
                }
                if (this.actual) {
                    params.append('actual', this.actual);
                }
            }
            return `?${params.toString()}`;
        },
        async getSchedule() {
            const queryString = this.buildQueryString();
            try {
                const response = await axios.get(`/api/operator/schedules/${queryString}`);
                this.schedules = response.data;
                console.log(response.data)
            } catch (error) {
                console.error(error);
            }
        },
        async createAirport() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const day_ids = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    day_ids.push(checkbox.value);
                }
            });
            try {
                await axios.post('/api/operator/schedules', {
                    flight_number: this.flight_number_create,
                    start_date: this.start_date,
                    end_date: this.end_date,
                    boarding_time: this.boarding_time + ':00',
                    takeoff_time: this.takeoff_time + ':00',
                    day_ids: this.checkedDays
                });
                this.clearForm();
                await this.getSchedule();
            } catch (error) {
                console.error(error);
            }
        },
        async editFlight(code) {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const day_ids = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    day_ids.push(checkbox.value);
                }
            });
            try {
                await axios.patch(`/api/operator/schedules/${code}`, {

                    flight_number: this.flight_number_edit,
                    start_date: this.start_date_edit,
                    end_date: this.end_date_edit,
                    boarding_time: this.boarding_time_edit,
                    takeoff_time: this.takeoff_time_edit,

                    day_ids: this.checkedDays
                });
                await this.getSchedule();
                this.checkedDays = []
            } catch (error) {
                console.error(error);
            }
        },
        async deleteSchedules(id) {
            try {
                await axios.delete(`/api/operator/schedules/${id}`);
                await this.getSchedule();
            } catch (error) {
                console.error(error);
            }
        },
        clearForm() {
            this.flight_number = ''
            this.start_date = ''
            this.end_date = ''
            this.boarding_time = ''
            this.takeoff_time = ''
            this.day_ids = ''
        },
        clearRequest() {
                this.flight_number = ''
                this.airline_code = ''
                this.airport_where = ''
                this.airport_whither = ''
                this.takeoff_time_start = ''
                this.takeoff_time_end = ''
                this.boarding_time_start = ''
                this.boarding_time_end = ''
                this.actual = ''
        },
        changeEditAirportCode(code) {
            this.editAirportCode = code;
        },
        isEdit(code) {
            return this.editAirportCode === code;
        },
    }
}
</script>
