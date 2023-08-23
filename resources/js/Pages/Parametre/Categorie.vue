<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { Head, router, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        categories: Array
    })

    const form = useForm({
        categorie: null
    })

    function addCategorie(){
        form.post(route('parametre.categorie.ajout'), {
            onError: () => {
                console.log(form.errors.categorie);
            }
        });
        form.reset("categorie");
    }

    function rm(item){
        router.delete('/parametre/categorie/' + item);
    }
</script>

<template>
    <Head title="Catégorie d'article"></Head>
    <Layout>
        <v-card class="elevation-0 mb-3 px-5 py-2">
            <v-card-title>Ajout d'un nouveau catégorie</v-card-title>
            <v-card-text>
                <v-text-field
                    height="10px"
                    v-model="form.categorie"
                    :append-icon="'mdi-send'"
                    :prepend-icon="icon"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Catégorie"
                    type="text"
                    @click:append="addCategorie"
                ></v-text-field>
                <span v-if="form.errors.categorie" style="color: rgb(215, 8, 8);">{{ form.errors.categorie }}</span>
            </v-card-text>
        </v-card>
        <v-card class="elevation-0 px-5 py-3">
            <v-table>
                <thead>
                <tr>
                    <th class="text-center">
                    Catégorie ID
                    </th>
                    <th class="text-center">
                    Libellé
                    </th>
                    <th class="text-center">
                    Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in categories"
                >
                    <td class="text-center">{{ item.categorie_id }}</td>
                    <td class="text-center">{{ item.nom }}</td>
                    <td class="text-center" style="display:flex; justify-content: center; align-items: center; gap: 12;">
                        <v-icon color="red-darken-1" @click="rm(item.categorie_id)">mdi-trash-can</v-icon>
                    </td>
                </tr>
                </tbody>
            </v-table>
        </v-card>
    </Layout>   
</template>