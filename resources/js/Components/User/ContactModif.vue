<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '../InputError.vue';

    const props = defineProps({
        data: Object
    })

    var form = useForm({
        telephone: props.data.telephone,
        adresse1: props.data.adresse1,
        adresse2: props.data.adresse2,
        pays: props.data.pays,
        ville: props.data.ville,
        cp: props.data.cp,
    })

    function updateContact(){
        console.log(props.data.contact_id);
        form.put('/utilisateurs/contact/' + props.data.contact_id,{
            preserveScroll: true,
            onError: ()=>{
                console.log(form.errors.adresse1);
            }
        });
    }
</script>

<template>
    <v-card class="mt-2 px-3 py-3">
        <v-card-title class="mb-4">
            <b>Contact</b>
        </v-card-title>
        <v-card-text>
            <InputError :message="form.errors.telephone" class="mt-2 mb-3" />
            <v-text-field variant="outlined" label="Téléphone" v-model="form.telephone"></v-text-field>

            <InputError :message="form.errors.adresse1" class="mt-2 mb-3" />
            <v-text-field variant="outlined" label="Adresse 1" v-model="form.adresse1"></v-text-field>

            <v-text-field variant="outlined" label="Adresse 2" v-model="form.adresse2"></v-text-field>

            <InputError :message="form.errors.ville" class="mt-2 mb-3" />
            <v-text-field variant="outlined" label="Ville" v-model="form.ville"></v-text-field>

            <InputError :message="form.errors.pays" class="mt-2 mb-3" />
            <v-text-field variant="outlined" label="Pays" v-model="form.pays"></v-text-field>

            <InputError :message="form.errors.cp" class="mt-2 mb-3" />
            <v-text-field variant="outlined" label="Code postal" v-model="form.cp"></v-text-field>
        </v-card-text>
        <v-card-actions>
            <div class="w-100 text-right">
                <button @click="updateContact" class="px-5 py-2 border rounded">
                Modifier
                </button>
            </div>
        </v-card-actions>
    </v-card>
</template>