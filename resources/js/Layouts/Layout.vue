<script setup>
import { Link, router } from "@inertiajs/vue3";
import ApplicationLogo from "../Components/ApplicationLogo.vue";

const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
  <v-card class="elevation-0">
    <v-layout>
      <v-navigation-drawer
        style="min-width: 280px; "
        expand
        color="white"
      >
        <v-list class="text-center">
            <span><ApplicationLogo></ApplicationLogo></span>
        </v-list>

      <div class="divide"></div>
        <v-list density="compact" nav>
            <Link :href="route('article')" class="nav-link" :class="{ active: route().current('article') }"><v-icon class="nav-icon">mdi-newspaper-variant-multiple-outline</v-icon> Article</Link>
            <Link :href="route('profile.show')" class="nav-link" :class="{ active: route().current('profile.show') }"><v-icon class="nav-icon">mdi-account</v-icon> Mon compte</Link>
            <Link v-if="$page.props.auth.user.role_id == 1" :href="route('utilisateurs')" class="nav-link" :class="{ active: route().current('utilisateurs') }"><v-icon class="nav-icon">mdi-account-multiple</v-icon> Utilisateurs</Link>
            <Link :href="route('cotisation')" class="nav-link" :class="{ active: route().current('cotisation') }"><v-icon class="nav-icon">mdi-cash</v-icon> Cotisation</Link>
            <Link :href="route('evenement')" class="nav-link" :class="{ active: route().current('evenement') }"><v-icon class="nav-icon">mdi-calendar</v-icon> Evènement</Link>
            <v-list-group value="Users" v-if="$page.props.auth.user.role_id == 1">
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-folder-wrench-outline"
                  title="Paramètre"
                >
              </v-list-item>
              </template>
              <v-list-item><Link :href="route('parametre.role')" class="list-link" :class="{ active: route().current('parametre.role') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Rôle</Link></v-list-item>
              <v-list-item><Link :href="route('parametre.categorie')" class="list-link" :class="{ active: route().current('parametre.categorie') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Catégorie d'article</Link></v-list-item>
              <v-list-item><Link :href="route('parametre.montant')" class="list-link" :class="{ active: route().current('parametre.montant') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Montant cotisation</Link></v-list-item>
              <v-list-item><Link :href="route('parametre.type.evenement')" class="list-link" :class="{ active: route().current('parametre.type.evenement') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Type d'évènements</Link></v-list-item>
              <v-list-item><Link :href="route('parametre.evenement')" class="list-link" :class="{ active: route().current('parametre.evenement') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Ajout évènement</Link></v-list-item>
              <v-list-item><Link :href="route('parametre.historique')" class="list-link" :class="{ active: route().current('parametre.historique') }"><v-icon class="list-icon">mdi-circle-small</v-icon> Historique cotisation</Link></v-list-item>

              </v-list-group>
            <Link @click="logout" class="nav-link logout"><v-icon class="nav-icon">mdi-logout</v-icon> Déconnexion</Link>
        </v-list>
      </v-navigation-drawer>
      <v-main class="ms-4"> 
        <v-container class="container">
          <slot />          
        </v-container>
        </v-main>
    </v-layout>
  </v-card>
</template>