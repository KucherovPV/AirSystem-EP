<template>
    <div>
        <NavbarComponent :key="$route.fullPath"></NavbarComponent>
        <router-view></router-view>
    </div>
</template>

<script>
import NavbarComponent from "../NavbarComponent.vue";

export default {
    name: 'App',
    components: {NavbarComponent}
}
</script>
