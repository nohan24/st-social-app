<script setup>
    import { Head } from "@inertiajs/vue3";
    import Layout from "@/Layouts/Layout.vue";
    import {useForm} from "@inertiajs/vue3";
    const form = useForm({
        evt: null,
        montant: null,
        utilisateur:null,
        date: null
    })

    const props = defineProps({
        users: Object,
        evts: Object
    })

    var items = []

    props.users.forEach(u => {
    items.push({
      name: u.name + ' ' + u.prenom,
      id: u.user_id
    })
  });

    var ev = [] 

    props.evts.forEach(u => {
    ev.push({
      name: u.libelle,
      id: u.id
    })
  });

  function addEvent(){
    props.evts.forEach(e => {
        if(e.id == form.evt){
            form.montant = e.montant
        }
    });
    form.post(route('parametre.evenement.new'))
  }

</script>

<template>
    <Head title="Evènement"></Head>
    <Layout>
        <v-card>
            <v-card-title>
                Nouvel évènement
            </v-card-title>
            <v-card-item>
                <span v-if="form.errors.evt" style="color: rgb(215, 8, 8);">{{ form.errors.evt }}</span>
                <v-select
                    :items="ev"
                    item-title="name"
                    item-value="id"
                    class="mt-2"
                    v-model="form.evt"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Type d'évènement"
                ></v-select>

                <span v-if="form.errors.utilisateur" style="color: rgb(215, 8, 8);">{{ form.errors.utilisateur }}</span>
                <v-select
                    :items="items"
                    item-title="name"
                    item-value="id"
                    class="mt-2"
                    v-model="form.utilisateur"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Utilisateur"
                ></v-select>

                <span v-if="form.errors.date" style="color: rgb(215, 8, 8);">{{ form.errors.date }}</span>
                <div class="date-time" style="display: flex; justify-content: space-between;">
                    
                    <input type="datetime-local" v-model="form.date">
                    <v-btn
                        class="text-none text-subtitle-1 mt-3"
                        color="#5865f2"
                        size="small"
                        variant="flat"
                        @click="addEvent">
                    <v-icon style="color: white;">mdi-send</v-icon></v-btn>
                </div>
            </v-card-item>
        </v-card>
    </Layout>
</template>