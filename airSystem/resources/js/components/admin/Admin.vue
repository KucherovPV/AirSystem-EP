<template>
    <div>
        <users-component></users-component>
    </div>
</template>

<script>
import UsersComponent from "./UsersComponent.vue";

export default {
    name: 'AdminComponent',
    components: {UsersComponent}
}
</script>

