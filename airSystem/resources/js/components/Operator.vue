<template>
    <div>
        это оператор
    </div>
    <div class="container">
        <div class="row">
            <GetDelayComponent></GetDelayComponent>
            <CreateDelayComponent></CreateDelayComponent>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import CreateDelayComponent from "../components/CreateDelayComponent.vue";
import GetDelayComponent from "../components/GetDelayComponent.vue";
export default {
    name: 'OperatorComponent',
    components: {
        CreateDelayComponent,
        GetDelayComponent
    },
    methods: {
    getUser() {
        axios.get('api/user')
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.error('Error getting data:', error);
            });
    }
    }
}
</script>

