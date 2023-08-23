<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref } from 'vue'

    const props = defineProps({
        users: Object
    })

    const curr_year = new Date().getFullYear();

    var select = ref(null)

    var s_year = ref(curr_year)

    var start = ref(null)

    var year = ref([])

    var list = ref([])

    const months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre']

    function setData(){
        props.users.forEach(e => {
            if(e.user_id == select.value.id){
                start.value = e.start
            }
        });

        s_year.value = curr_year
        
        fillYear()

        axios.get('cotisation/' + select.value.id + '/' + s_year.value, {})
        .then(function (response) {
           list.value = response.data
        });
    }

    function setYear(){
        props.users.forEach(e => {
            if(e.user_id == select.value.id){
                start.value = e.start
            }
        });
        
        fillYear()

        axios.get('cotisation/' + select.value.id + '/' + s_year.value, {})
        .then(function (response) {
           list.value = response.data
        });
    }

    var items = []
    props.users.forEach(u => {
        items.push({
        name: u.name + ' ' + u.prenom,
        id: u.user_id
        })
    });

  function fillYear(){
    year.value = []
    for (let i = start.value; i <= curr_year; i++) {
        year.value.push(i)
    }
  }


</script>

<template>
    <Head title="Historique de cotisation"></Head>
    <Layout>
        <v-card>
            <v-card-title>
                Historique de cotisation
            </v-card-title>
            <v-card-item>
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
                    @update:model-value="setData"
                ></v-select>

            </v-card-item>
            <div class="px-4" v-if="select">
                <v-select
                    style="width: 200px;"
                    v-model="s_year"
                    :items="year"
                    class="mt-2"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Filtre année"
                    @update:model-value="setYear"
                ></v-select>
           
                <v-table>
                    
                    <thead>
                        <tr>
                            <th class="text-left">
                                Mois
                            </th>
                            <!-- <th class="text-left">
                                Montant
                            </th> -->
                            <th class="text-left">
                                Payé
                            </th>
                        </tr>
                </thead>
                <tbody>
                    <tr v-for="(i,l) in 12">
                        <td>{{ months[l] }}</td>      
                        <!-- <td>
                            {{  
                              list[l] == null ? '-' : Intl.NumberFormat('en-US').format(list[l].montant) + ' Ar'
                            }} 
                        </td> -->
                        <td><v-icon :class="{ checked : list[l] != null, unchecked: list[l] == null }">mdi-check-circle</v-icon></td>
                    </tr>
                </tbody>
            </v-table>
        </div>
        </v-card>
    </Layout>
</template>