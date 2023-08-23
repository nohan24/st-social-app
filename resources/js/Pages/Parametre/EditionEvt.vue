<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
   

    const props = defineProps({
        evt: Object
    })

    const form = useForm({
        evt: props.evt.libelle,
        montant: props.evt.montant,
        color: props.evt.color,
    })

    function edit(){
        form.post('/parametre/evenement/edit/' + props.evt.id);
    }
</script>

<template>
<Head title="Modification évènement"></Head>
<Layout>  
     <v-card>
        <v-card-title>
            Modification
        </v-card-title>
        <v-card-item class="py-3 px-3">
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
                    <v-color-picker  v-model="form.color" hide-inputs show-swatches></v-color-picker>
                </div>
                <div style="text-align: right;">
                    <v-btn class="mt-3 me-3 mb-3" @click="edit"><v-icon>mdi-send</v-icon></v-btn>
                </div>
               
        </v-card-item>
     </v-card>
</Layout>
</template>