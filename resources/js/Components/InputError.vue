<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p style="color: red;" color="red-darken-2">
            {{ message }}
        </p>
    </div>
</template>
