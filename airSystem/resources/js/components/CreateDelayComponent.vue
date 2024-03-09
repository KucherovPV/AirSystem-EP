

<template>
    <div class="col-md-4 mt-5" id="containerAdd">
        <form @submit.prevent="createDelay()" id="addBookForm" method="POST" class="hidden">
            <div class="form-group">
                <label for="approximate_time">Время задержки</label>
                <input type="text" class="form-control" name="approximate_time" v-model="approximate_time"
                       required>
            </div>
            <div class="form-group">
                <label for="fk_airport">Аэропорт</label>
                <input type="text" class="form-control" name="fk_airport" v-model="fk_airport" required>
            </div>
            <div class="form-group">
                <label for="fk_flight">Рейс</label>
                <input type="text" class="form-control" name="fk_flight" v-model="fk_flight" required>
            </div>
            <div class="form-group">
                <label for="fk_reason_status">Статус измения</label>
                <input type="text" class="form-control" name="fk_reason_status" v-model="fk_reason_status"
                       required>
            </div>
            <div class="form-group">
                <label for="fk_reason_change">Тип изменения</label>
                <input type="text" class="form-control" name="fk_reason_change" v-model="fk_reason_change"
                       required>
            </div>
            <div class="form-group mt-2 mb-3">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'CreateDelayComponent',
    data() {
        return {
            delays: []
        };
    },
    methods: {
        async createDelay() {
            try {
                const response = await axios.post('api/delay/create',
                    {
                        approximate_time: this.approximate_time,
                        fk_airport: this.fk_airport,
                        fk_flight: this.fk_flight,
                        fk_reason_status: this.fk_reason_status,
                        fk_reason_change: this.fk_reason_change
                    }
                );

            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
