<script setup>
import { onMounted, ref } from "vue";

defineProps({
  data: Object,
  modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <select
    required
    ref="input"
    class="rounded"
    style="padding: 16px; border: thin solid #ababab; color: #535353;"
    @change="$emit('update:modelValue', $event.target.value)"
  >
    <option value="-1">Choisissez la catégorie</option>
    <option v-for="item in data" :value="item.categorie_id">{{ item.nom }}</option>
  </select>
</template>
