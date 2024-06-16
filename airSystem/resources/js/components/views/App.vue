<template>
<!--    <div class="col">-->
<!--        :key="$route.fullPath"-->
        <NavbarComponent>
            <router-view></router-view>
        </NavbarComponent>
</template>

<script>
import NavbarComponent from "../NavbarComponent.vue";

export default {
    name: 'App',
    components: {NavbarComponent}
}
</script>
