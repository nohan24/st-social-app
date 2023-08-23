<script setup>
const props = defineProps({
    openComs: Boolean,
    data: Object,
})

</script>
<template>
    <div v-if="openComs" class="border overflow-y-auto rounded" style="overflow-y: scroll; max-height: 600px; min-width: 500px; max-width: 700px;">
      <v-banner class="text-h5 font-weight-light" sticky style="z-index: 100;">
        <div style="display: flex; flex-direction: row; justify-content: space-evenly; width: 100%;">
          <div>Commentaires</div>
        </div>
    </v-banner>
      <v-card style="border-radius: 0;">
        <div v-if="data.length == 0" class="text-center justify-center text-h5 font-weight-light" style="padding: 15px;">Pas de commentaire</div>
        <div v-for="d in data">
          <v-card-title>{{ d.name + ' ' + d.prenom}}</v-card-title>
          <!-- <v-card-subtitle class="d-flex align-center justify-space-between"><span>{{ categorie }}</span><span>{{ format(Math.floor(Date.now() - Date.parse(date_post))) }}</span></v-card-subtitle> -->
          <v-card-text v-html="d.texte"></v-card-text>
          <v-divider></v-divider>
        </div>
      </v-card>
    </div>
</template>
