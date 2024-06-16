<template>
    <div class="container">
        <div class="row">
            <DelayComponent></DelayComponent>
        </div>
    </div>
</template>
<script>
import DelayComponent from "./DelayComponent.vue";
export default {
    name: 'OperatorComponent',
    components: {
        DelayComponent
    },
}
</script>

