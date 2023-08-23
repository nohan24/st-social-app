<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  parent: Number,
  dialog: Boolean,
  currid: Number
});

const rules = {
  required: value=> !! !!value || 'Required',
}

var success = ref(false)

var form = useForm({
  texte: "",
  parent_id: 0,
});


function addComm() {
  form.parent_id = props.currid;
  console.log(form.parent_id);
  form.post("article", {
    preserveScroll: true,
    onSuccess: () => {
      success.value = true
      setTimeout(()=>{success.value=false},3000);
    },
    onError: (error)=> {
      console.log(error);
    }
  });
}
</script>

<template>
      <v-card v-show="dialog" style="padding: 10px 5px; min-width: 500px;">
          <v-alert
          v-show="success"
          type="success"
          title="Commentaire envoyé"
          transition="fade-transition"
        ></v-alert>
   
        <v-card-title>
          <span class="text-h5">Votre commentaire</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-textarea
                  variant="outlined"
                  label="Commentaire"
                  required
                  v-model="form.texte"
                  :rules="[rules.required]"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="$emit('closecomment')">
            Fermer
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="addComm" :disabled="form.texte.trim() == ''">
            Commenter
          </v-btn>
        </v-card-actions>
      </v-card>
</template>
