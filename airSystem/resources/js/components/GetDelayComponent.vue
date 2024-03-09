<template>
    <div class="col-md-8 mt-5">
        <table class="table table-bordered table-hover" id="dataTable">
            <thead class="non-clickable">
            <tr>
                <th>Время задержки</th>
                <th>Аэропорт</th>
                <th>Рейс</th>
                <th>Статус изменения</th>
                <th>Тип изменения</th>
            </tr>
            </thead>
            <tbody>
            <tr class="cursor-pointer"></tr>
            <tr v-for="item in delays" :key="item.id">
                <td>{{ item.approximate_time }}</td>
                <td>{{ item.fk_airport }}</td>
                <td>{{ item.fk_airport }}</td>
                <td>{{ item.fk_airport }}</td>
                <td>{{ item.fk_airport}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'GetDelayComponent',
    data() {
        return {
            delays: null,
        };
    },
    mounted() {
        this.getDelay();
    },
    methods: {
        getDelay() {
            axios.get('/api/delay/')
                .then(response => {
                    this.delays = response.data;
                })
                .catch(error => {
                    console.error('Error getting data:', error);
                });
        }
    }

}
</script>
