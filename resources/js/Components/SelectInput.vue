<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    blank: String,
    data: Object
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <option v-for="item in data" :value="item.poste_id">{{ item.designation }}</option>
    </select>
</template>
