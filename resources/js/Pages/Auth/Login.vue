<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

var visible = ref(false)

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
    
};
</script>

<template>
        <Head title="Log in" />

        <div class="mt-4">
 

    <v-card
      class="mx-auto pa-12 pb-8"
      elevation="8"
      max-width="448"
      rounded="lg"
    >
    <div class="text-subtitle-1 text-medium-emphasis">Account</div>
    <InputError class="mt-2" :message="form.errors.email" />
      <v-text-field
      density="compact"
      placeholder="Email address" 
      v-model="form.email"
      prepend-inner-icon="mdi-email-outline"
      variant="outlined"
      ></v-text-field>
      
      <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
        Password
      </div>
      <InputError class="mt-2" :message="form.errors.passo" />
      <v-text-field
        :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
        :type="visible ? 'text' : 'password'"
        density="compact"
        v-model="form.password"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        variant="outlined"
        @click:append-inner="visible = !visible"
      ></v-text-field>

      <v-card
        class="mb-12"
        color="surface-variant"
        variant="tonal"
      >
    
      </v-card>

      <v-btn
        block
        class="mb-8"
        color="blue"
        size="large"
        @click="submit"
        variant="tonal"
      >
        Log In
      </v-btn>

      <v-card-text class="text-center">
        <Link
          :href="route('register')"
          class="text-blue text-decoration-none"
          rel="noopener noreferrer"
          target="_blank"
        >
          Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
        </Link>
      </v-card-text>
    </v-card>
  </div>
</template>