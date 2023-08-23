<script setup>
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";
import Sexe from "../../Components/Sexe.vue";
import Layout from "@/Layouts/Layout.vue";
import ContactCard from "@/Components/User/ContactCard.vue";

const props = defineProps({
  data: Object,
});


var popup = ref(false);
var d = ref(null)

function rm(item){
  router.delete('/utilisateurs/' + item);
}

function showContact(item){
  popup.value = true
  d.value = item
}

</script>

<template>
  <Layout>
    <Head title="Liste utilisateur"></Head>
    <v-card-title>Liste des utilisateurs</v-card-title>
    <v-table class="border">
      <thead>
        <tr>
          <th class="text-center">Nom & Prénom</th>
          <th class="text-center">Rôle</th>
          <th class="text-center">Sexe</th>
          <th class="text-center" style="min-width: 180px">Date de naissance</th>
          <th class="text-center" style="min-width: 180px">Date d' embauche</th>
          <th class="text-center" v-if="$page.props.auth.user.role_id == 1">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data">
          <td class="text-center">{{ item.name + ' ' + item.prenom }}</td>
          <td class="text-center">
            <v-select
            persistent-hint
            return-object
            single-line
            >
              
            </v-select>
          </td>
          <td class="text-center"><Sexe :gender="item.sexe"></Sexe></td>
          <td class="text-center">{{ item.date_naissance }}</td>
          <td class="text-center">{{ item.date_embauche }}</td>
          <td v-if="$page.props.auth.user.role_id == 1" class="text-center">
            <v-icon color="yellow-darken-2" title="Contact" class="mr-2" @click="showContact(item)">mdi-contacts</v-icon>
            <v-icon color="yellow-darken-2" title="Contact" class="mr-2" @click="showContact(item)">mdi-</v-icon>
            <v-icon color="red-darken-2" title="Supprimer l'utilisateur" @click="rm(item.user_id)">mdi-trash-can</v-icon>
          </td>
        </tr>
      </tbody>
    </v-table>

    <v-overlay v-model="popup" class="d-flex justify-center align-center">
      <ContactCard :is-open="popup" :data="data"></ContactCard>
    </v-overlay>

  </Layout>
</template>
