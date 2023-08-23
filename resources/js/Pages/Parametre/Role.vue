<script setup>
    import Layout from "@/Layouts/Layout.vue";
    import { Head, router, useForm } from "@inertiajs/vue3";

    const props = defineProps({
        roles: Object
    })

    const form = useForm({
        role: null
    })

    function addRole(){
        form.post(route('parametre.role.ajout'), {
            onError: () => {
                console.log(form.errors.role);
            }
        })
        form.reset("role");
    }

    function rm(item){
        router.delete('/parametre/role/' + item)
    }

</script>

<template>
    <Head title="Rôle"></Head>
    <Layout>
        <v-card class="elevation-0 mb-3 px-5 py-2">
            <v-card-title>Ajout d'un nouveau rôle</v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="form.role"
                    :append-icon="'mdi-send'"
                    :prepend-icon="icon"
                    variant="outlined"
                    clear-icon="mdi-close-circle"
                    clearable
                    label="Rôle"
                    type="text"
                    @click:append="addRole"
                ></v-text-field>
                <span v-if="form.errors.role" style="color: rgb(215, 8, 8);">{{ form.errors.role }}</span>
            </v-card-text>
        </v-card>
        <v-card class="elevation-0" style="padding: 5px 20px;">
            <v-table>
                <thead>
                <tr>
                    <th class="text-center">
                    Rôle ID
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
                    v-for="item in roles"
                >
                    <td class="text-center">{{ item.role_id }}</td>
                    <td class="text-center">{{ item.libelle }}</td>
                    <td class="text-center" style="display:flex; justify-content: center; align-items: center; gap: 12;">
                        <v-icon color="red-darken-2" @click="rm(item.role_id)">mdi-trash-can</v-icon>
                    </td>
                </tr>
                </tbody>
            </v-table>
        </v-card>
    </Layout>
</template>