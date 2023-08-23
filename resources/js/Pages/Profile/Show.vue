<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import ContactModif from '@/Components/User/ContactModif.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
    contact: Object
});
</script>

<template>
    <Head title="Profil"></Head>
    <Layout>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" /> 
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-3 sm:mt-0" />
                </div>
                
                <ContactModif :data="contact">

                </ContactModif>

            </div>
        </div>
    </Layout>
</template>
