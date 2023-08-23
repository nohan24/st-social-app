<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { Head, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        montant: Object
    })

    const form = useForm({
        montant: props.montant[0]['montant']
    })

    function edit(){
        form.put(route('parametre.montant.update'), {
            onError: () => {
                console.log(form.errors.categorie);
            }
        })
    }

</script>

<template>
    <Head title="Montant"></Head>
    <Layout>    
        <v-card class="elevation-0 mb-3 px-5 py-2">
            <v-card-title>Montant de cotisation par mois</v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="form.montant"
                    :append-icon="'mdi-send'"
                    :prepend-icon="icon"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Montant"
                    type="text"
                    @click:append="edit"
                ></v-text-field>
            </v-card-text>
        </v-card>
    </Layout>
</template>