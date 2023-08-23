<script setup>
    import { Head, useForm, Link } from '@inertiajs/vue3';
    import Layout from '@/Layouts/Layout.vue';
    import { ref } from "vue";
    import { router } from '@inertiajs/vue3';
    import Multiselect from 'vue-multiselect'

    var color = ref('#000')

    const props = defineProps({
        evts: Object
    })

    const form = useForm({
        evt: null,
        montant: null,
        color: null
    })

    function addEvt(){
        form.color = color.value
        form.post(route('parametre.evenement.ajout'),{
            onSuccess: () => {
                form.reset('evt','montant')
            }
        });
    }

    function deleteEvt($id){
        router.delete('/parametre/evenement/' + $id, {
            preserveScroll: true
        });
    }

    var options = ['f','d','s']
</script>

<template>
   <Head title="Paramètre d'évènement"></Head>
    <Layout>
        
        <a style="color: #333;" href="#liste"><v-btn class="mb-2">Liste des évènements</v-btn></a>
        <v-card class="elevation-0 mb-3 px-5 py-2">
            <v-card-title>Ajout d'un nouvel évènement</v-card-title>
            <v-card-text>
                <span v-if="form.errors.evt" style="color: rgb(215, 8, 8);">{{ form.errors.evt }}</span>
                <v-text-field
                    class="mt-2"
                    v-model="form.evt"
                    :prepend-icon="icon"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Evènement"
                    type="text"
            
                ></v-text-field>

                <span v-if="form.errors.montant" style="color: rgb(215, 8, 8);">{{ form.errors.montant }}</span>
                <v-text-field
                class="mt-2"
                    v-model="form.montant"
                    :prepend-icon="icon"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Montant"
                    type="text"
            
                ></v-text-field>
                <div>
                    <p class="py-3" style="font-size: 16px;">Choisissez la couleure de votre évènement</p>
                    
                    <v-color-picker  v-model="color" hide-inputs show-swatches></v-color-picker>
                </div>
                <div style="text-align: right;">
                    <v-btn class="mt-3" @click="addEvt"><v-icon>mdi-send</v-icon></v-btn>
                </div>
               
            </v-card-text>
        </v-card>
        <div id="liste">
            <v-card>
                <v-card-title>Liste des types d'évènement ajoutés</v-card-title>
                <v-card-item>
                    <v-table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                Libellé
                                </th>
                                <th class="text-left">
                                Couleure
                                </th>
                                <th class="text-left">
                                Montant
                                </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="item in evts"
                            >
                                <td>{{ item.libelle }}</td>
                                <td><div style="width: 20px; height: 20px; border-radius: 50%;" :style="{'backgroundColor': item.color }"></div></td>
                                <td>{{ Intl.NumberFormat('en-US').format(item.montant) }} Ar</td>
                                <td><Link :href="'/parametre/evenement/edit/' + item.id" style="color: #202020;"><v-btn>Edit</v-btn></Link>  <v-btn @click="deleteEvt(item.id)">Delete</v-btn></td>
                            </tr>
                            </tbody>
                    </v-table>
                </v-card-item>
            </v-card>
        </div>
    </Layout>
</template>