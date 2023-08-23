<script setup>
  import { Head } from "@inertiajs/vue3";
  import { VDataTable } from "vuetify/lib/labs/components.mjs";
  import { ref } from "vue";
  import Layout from "@/Layouts/Layout.vue";
  import {useForm} from "@inertiajs/vue3";

  const props = defineProps({
    users: Array,
    prix: Object,
    cotisations: Object
  });

  var items = []

  var select = ref(null)

  var selected = ref([])

  var search = ref(null)

  const months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre']

  const form = useForm({
    montant: props.prix.montant,
    id: null,
    selected: null
  })

  const headers = [
    {title: 'Utilisateur', key: 'utilisateur', align:'center'},
    {title: 'Montant', key: 'montant', align:'center'},
    {title: 'Mois', key: 'mois', align:'center'},
    {title: 'Année', key: 'annee', align:'center'},
  ];

  var cotisations = ref([])
  props.cotisations.forEach((e) => {
    cotisations.value.push({
      utilisateur: e.user_id,
      montant: new Intl.NumberFormat('en-US').format(e.montant) + ' Ar',
      mois: months[e.month - 1],
      annee: e.year
    });
  });

  props.users.forEach(u => {
    items.push({
      name: u.name + ' ' + u.prenom,
      id: u.user_id
    })
  });

  function addCotisation(){
    form.selected = selected.value;
    form.id = select.value.id
    form.post(route('cotisation.add'),{
      onSuccess: () => {
        selected.value = []
        select.value = null
      }
    });
  }

  var m = ref([])
  function getUserCotisation() {
    m.value = []
    axios.get('cotisation/' + select.value.id, {
      dislike: true,
    })
    .then(function (response) {
      Object.keys(response.data).forEach(key => {
        m.value.push(response.data[key])
      });
    });
}
</script>

<template>
  <Layout>
    <Head title="Cotisation"></Head>

    <v-card class="py-3 px-5 mb-3" v-if="$page.props.auth.user.role_id == 1">

      <v-card-title>Cotisation année {{ new Date().getFullYear() }}</v-card-title>
        <v-select
          v-model="select"
          :items="items"
          item-title="name"
          item-value="id"
          label="Utilisateur"
          persistent-hint
          return-object
          single-line
          variant="underlined"
          @update:model-value="getUserCotisation"
        ></v-select>

        <div v-if="select" style="display: flex; flex-wrap: wrap; flex-direction: row;">
          <v-checkbox
          style="flex: 1 0 20%; margin: 2px;"
          v-for="i in m"
          v-model="selected"
          :label="months[i-1]"
          :value="i"
          ></v-checkbox>
        </div>

        <p v-if="select" class="py-4">Montant : <b>{{ selected.length * prix['montant'] }} Ar</b></p>
        <v-btn
          color="blue-darken-4"
          class="mt-3"
          type="submit"
          @click="addCotisation"
        >
          valider
        </v-btn>

</v-card>

</Layout>
</template>
