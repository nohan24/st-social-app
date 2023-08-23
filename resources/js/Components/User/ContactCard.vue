<script setup>
const props = defineProps({
  data: Object,
  isOpen: Boolean,
});
</script>

<template>
    <v-card v-show="isOpen" class="border overflow-y-auto rounded" style="padding: 10px 5px; min-width: 500px; max-width: 700px; max-height: 600px;">
      <v-card-title>Contact</v-card-title>
      <div class="px-5">
        <p class="mt-2" style="width: 100%;"><b style="width: 300px;">Téléphone : </b>{{ data[0].telephone }}</p>
        <p class="mt-2" style="width: 100%;"><b style="width: 300px;">Adresse 1 : </b>{{ data[0].adresse1 }}</p>
        <p class="mt-2" style="width: 100%;"><b style="width: 300px;">Adresse 2 : </b>{{ data[0].adresse2 }}</p>
        <p class="mt-2" style="width: 100%;"><b style="width: 300px;">Ville : </b>{{ data[0].ville }}</p>
        <p class="mt-2" style="width: 100%;"><b style="width: 300px;">Pays : </b>{{ data[0].pays }}</p>
        <p class="mt-2" style="width: 100%;"><b style="width: 200px;">Code Postal : </b>{{ data[0].cp }}</p>
      </div>
    </v-card>
</template>
