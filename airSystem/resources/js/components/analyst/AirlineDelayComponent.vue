<template>
    <div v-if="!airports" class="loading-row">
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
                        Статистика авиакомпаний
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="orderBy">Сортировать</label>
                            <select class="form-select" id="orderBy" v-model="orderBy">
                                <option value="DESC" selected="selected">По убыванию длительности задержки</option>
                                <option value="asc">По возрастанию длительности задержки</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 m-2 col">
                            <label class="input-group-text" for="airport_code">Авиакопания</label>
                            <select class="form-select" id="inputGroupSelect03" v-model="airport_code"
                                    @change="fetchData">
                                <template v-for="airport in airports" :key="airport.code_iata">
                                    <option :value="airport.code_iata">{{ airport.code_iata }}</option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <div class="row col-2 m-2 ms-auto">
                        <button class="btn btn-outline-secondary  mt-2  " type="button"
                                @click.prevent="getSchedule">
                            Получить
                        </button>
                        <button @click="downloadFileExp" class="btn btn-success mt-3">
                            Скачать в виде файла
                        </button>
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Авиакомпания</th>
                            <th class="text-center">Номер рейса</th>
                            <th class="text-center">Номер борта</th>
                            <th class="text-center">Аэропорт задержки</th>
                            <th class="text-center">Краткое описание</th>
                            <th class="text-center">Полное описание</th>
                            <th class="text-center">Категория задержки</th>
                            <th class="text-center">Время задержки</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="boardingTakeoff in boardingTakeoffs" :key="boardingTakeoff.id">
                            <tr>
                                <td>{{ boardingTakeoff.Airline }}</td>
                                <td>{{ boardingTakeoff.Delayed_Flight_Number }}</td>
                                <td>{{ boardingTakeoff.Board_Code }}</td>
                                <td>{{ boardingTakeoff.Delay_Airport }}</td>
                                <td>{{ boardingTakeoff.Delay_Title }}</td>
                                <td>{{ boardingTakeoff.Delay_Content }}</td>
                                <td>{{ boardingTakeoff.Category_title }}</td>
                                <td>{{ boardingTakeoff.Delay_Time / 3600 }}</td>
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
            airports: null,

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
                const [airports] = await Promise.all([
                    this.getData('/api/operator/airlines'),
                ]);
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
            if (this.airport_code !== null) {
                params.append('airline_code', this.airport_code);
                this.airport_code = null
            }
            params.append('for_airline', 'true');
            return `?${params.toString()}`;
        },
        async getSchedule() {
            const queryString = this.buildQueryString();
            try {
                const response = await axios.get(`/api/analyst/delays/${queryString}`);
                this.boardingTakeoffs = response.data;
                console.log(response.data)
            } catch (error) {
                console.error(error);
            }
        },
        async downloadFileExp() {
            await this.downloadFile(this.buildQueryString())
        }
    }
}
</script>
