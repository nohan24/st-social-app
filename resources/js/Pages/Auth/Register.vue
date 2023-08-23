<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
  name: "",
  prenom: "",
  email: "",
  date_naissance: "",
  date_embauche: "",
  sexe: null,
  password: "",
  password_confirmation: "",
  telephone: "",
  adresse1: "",
  adresse2: "",
  ville: "",
  pays: "",
  cp: "",
});

const props = defineProps({
  poste: Object,
});

const blank = "Choisissez votre poste";

const submit = () => {
  form.post(route("register"), {
    onFinish: (error) => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>
  <Head title="Register" />
  <AuthenticationCard>
    <template #logo>
      <AuthenticationCardLogo />
    </template>

    <form @submit.prevent="submit" class="w-full">
      <h1 class="text-center mb-3">{{ currentTitle }}</h1>
      <v-window v-model="step" class="w-full">
        <v-window-item :value="1">
          <div class="mt-4">
            <InputLabel for="email" value="Email" />
            <TextInput
              v-model="form.email"
              type="email"
              class="mt-1 block w-full"
              required
              autocomplete="username"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Mot de passe" />
            <TextInput
              v-model="form.password"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="mt-4">
            <InputLabel
              for="password_confirmation"
              value="Confirmation du mot de passe"
            />
            <TextInput
              v-model="form.password_confirmation"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password_confirmation" />
          </div>
        </v-window-item>

        <v-window-item :value="2">
          <div>
            <InputLabel for="nom" value="Nom" />
            <TextInput
              v-model="form.name"
              type="text"
              class="mt-1 block w-full"
              required
              autofocus
              autocomplete="nom"
            />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div class="mt-4">
            <InputLabel for="prenom" value="Prénom" />
            <TextInput
              id="prenom"
              v-model="form.prenom"
              type="text"
              class="mt-1 block w-full"
              required
              autocomplete="prenom"
            />
            <InputError class="mt-2" :message="form.errors.prenom" />
          </div>

          <div class="w-full">
            <InputLabel value="Date de naissance" />
            <TextInput
              v-model="form.date_naissance"
              type="date"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.date_naissance" />
          </div>

          <div class="mt-4">
            <InputLabel value="Sexe" class="mb-2" />
            <div class="flex gap-4">
              <div class="flex gap-2 items-center">
                <InputLabel value="Homme " />
                <input v-model="form.sexe" type="radio" value="1" required />
              </div>
              <div class="flex items-center gap-2">
                <InputLabel value="Femme " />
                <input v-model="form.sexe" type="radio" value="0" required />
              </div>
            </div>
            <InputError class="mt-2" :message="form.errors.sexe" />
          </div>
        </v-window-item>

        <v-window-item :value="3">
          <div class="w-full">
            <InputLabel for="poste" value="Date d'embauche" />
            <TextInput
              v-model="form.date_embauche"
              type="date"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.date_embauche" />
          </div>

        </v-window-item>

        <v-window-item :value="4">
          <div class="mt-4">
            <InputLabel value="Téléphone" />
            <TextInput
              v-model="form.telephone"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.telephone" />
          </div>

          <div class="mt-4">
            <InputLabel value="Adresse 1" />
            <TextInput
              v-model="form.adresse1"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.adresse1" />
          </div>

          <div class="mt-4">
            <InputLabel value="Adresse 2" />
            <TextInput v-model="form.adresse2" type="text" class="mt-1 block w-full" />
          </div>

          <div class="mt-4">
            <InputLabel value="Ville" />
            <TextInput
              v-model="form.ville"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.ville" />
          </div>

          <div class="mt-4">
            <InputLabel value="Pays" />
            <TextInput
              v-model="form.pays"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError class="mt-2" :message="form.errors.pays" />
          </div>

          <div class="mt-4">
            <InputLabel value="Code postal" />
            <TextInput v-model="form.cp" type="text" class="mt-1 block w-full" required />
            <InputError class="mt-2" :message="form.errors.cp" />
          </div>
        </v-window-item>

        <v-window-item :value="5">
          <div class="flex items-center justify-center mt-4">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Valider l'inscription
            </PrimaryButton>
          </div>
        </v-window-item>
      </v-window>
      <v-card-actions class="mt-3">
        <v-btn
          v-if="step > 1"
          color="secondary"
          class="text-white"
          variant="flat"
          @click="step--"
        >
          Back
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn v-if="step < 5" color="primary" variant="flat" @click="step++">
          Next
        </v-btn>
      </v-card-actions>
    </form>
    <Link
      :href="route('login')"
      class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Déjà inscrit?
    </Link>
  </AuthenticationCard>
</template>

<script>
export default {
  data: () => ({
    step: 1,
  }),

  computed: {
    currentTitle() {
      switch (this.step) {
        case 1:
          return "Information de connexion";
        case 2:
          return "Information personnelles";
        case 3:
          return "Information professionnelles";
        case 4:
          return "Contacts";
        case 5:
          return "Validation";
      }
    },
  },
};
</script>
