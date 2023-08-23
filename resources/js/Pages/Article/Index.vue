<script setup>
  import { Head, useForm } from "@inertiajs/vue3";
  import { ref } from "vue";
  import Article from "@/Components/Article/Article.vue";
  import ActionZone from "@/Components/Article/ActionZone.vue";
  import AddArticle from "@/Components/Article/AddArticle.vue";
  import Layout from "@/Layouts/Layout.vue";
  import SelectCategorie from "@/Components/Article/SelectCategorie.vue";
  import ListeCommentaire from "@/Components/Article/ListeCommentaire.vue";

  const props = defineProps({
    articles: Object,
    curr_user: Number,
    categories: Object,
    keys: Array
  })

  const form = useForm({
    categorie: null,
    titre: '',
    texte: ''
  })

  var dialogd = ref(false)

  var dialog = ref(false)

  var isComs = ref(false)

  var cdata = ref(null)

  var comsid = ref(null)

  function openComs(params) {
    isComs.value = true
    cdata.value = params
  }

  function closeComs() {
    dialogd.value = false
  }

  function open(id) {
    comsid.value = id
    dialogd.value = true
  }

  function exception(){
    if(form.texte.trim() == '' || form.titre.trim() == '' || form.categorie == null || form.categorie == -1)return true
  }

  function addArticle(){
    form.post(route('article'), {
      onSuccess: ()=>{
      }
    });
    dialog.value = false;
    form.reset("texte","categorie","titre");
  }
</script>

<template>
  <Head title="Article"></Head>
  <Layout>

    <div style="padding: 15px;">
    <v-dialog
      v-model="dialog"
      width="960"
    >
      <template v-slot:activator="{ props }">
        <v-btn v-bind="props" variant="outlined">
      Nouvel article +
    </v-btn>
      </template>
      <v-card style="padding: 10px;">
        <v-card-title>
          <span class="text-h5">Publier un article</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
              >
              <SelectCategorie :data="categories" v-model="form.categorie">
                </SelectCategorie>
              </v-col>
              <v-col
                cols="12"
              >
                <v-text-field
                  label="Titre"
                  variant="outlined"
                  v-model="form.titre"
                ></v-text-field>
              </v-col>
             
              <v-col
                cols="12"
              >
                <v-textarea
                  label="Votre publication ici"
                  persistent-hint
                  variant="outlined"
                  v-model="form.texte"
                ></v-textarea>
              </v-col>
            
            </v-row>
          </v-container>
    
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false"
          >
            Fermer
          </v-btn>
          <v-btn
            color="blue-darken-2"
            variant="text"
            @click="addArticle"
            :disabled="exception()"
          >
            Publier
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
    
    <v-overlay v-model="dialogd" class="d-flex justify-center align-center">
      <ActionZone :dialog="dialogd" @closecomment="closeComs" :currid="comsid">
      </ActionZone>
    </v-overlay>

    <v-overlay v-model="isComs" class="d-flex justify-center align-center">
      <ListeCommentaire :open-coms="isComs" :data="cdata"></ListeCommentaire>
    </v-overlay>
 
    <AddArticle :categories="categories"></AddArticle>

    <Article v-for="a in keys" @open="open" :user="curr_user" :titre="articles[a].data.titre" :texte="articles[a].data.texte" :rating="articles[a].data.rating" :auteur="articles[a].data.name + ' ' + articles[a].data.prenom" :categorie="articles[a].data.nom" :date_post="articles[a].data.created_at" :count="articles[a].childs.length" :curr_id="a" :childs="articles[a].childs" @showcoms="openComs"></Article> 
  </Layout>

</template>