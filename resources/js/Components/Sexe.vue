<script setup>
    const props = defineProps({
        gender: Number
    })
</script>

<template>
    <span v-if="gender == 0">
        <v-icon color="red-darken-2">mdi-gender-female</v-icon>
    </span>
    <span v-else>
        <v-icon color="blue-darken-2">mdi-gender-male</v-icon>
    </span>
</template>