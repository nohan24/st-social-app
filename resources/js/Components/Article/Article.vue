<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  titre: String,
  texte: String,
  rating: Object,
  auteur: String,
  categorie: String,
  date_post: String,
  parent: Number,
  count: Number,
  curr_id: Number,
  pr: Number,
  childs:Object,
  user: Number,
});

var c = ref(JSON.parse(props.rating)["likes"].length);
var dc = ref(JSON.parse(props.rating)["dislikes"].length);

var like = ref(JSON.parse(props.rating)['likes'].includes(props.user))
var dislike = ref(JSON.parse(props.rating)['dislikes'].includes(props.user))

function format(diff) {
  let minutesDifference = Math.floor(diff / (1000 * 60));
  let hoursDifference = Math.floor(diff / (1000 * 60 * 60));
  let daysDifference = Math.floor(diff / (1000 * 60 * 60 * 24));
  if (daysDifference != 0) {
    return "Il y a " + daysDifference + " jour(s)";
  } else {
    if (hoursDifference != 0) {
      return "Il y a " + hoursDifference + " heure(s)";
    } else {
      if (minutesDifference != 0) {
        return "Il y a " + minutesDifference + " minute(s)";
      }
      return "Il y a quelques secondes";
    }
  }
}

function clike() {
  if(dislike.value && !like.value){
      dc.value -= 1
      dislike.value = false
    }
  like.value ? c.value -= 1 : c.value += 1
  like.value = !like.value
  axios.put('article/' + props.curr_id, {
    like: true,
  })
  .then(function () {
  })
  .catch(function () {
    like.value ? c.value -= 1 : c.value += 1
    like.value = !like.value
  });
}

function cdislike() {
  if(like.value && !dislike.value){
      c.value -= 1
      like.value = false
    }
  dislike.value ? dc.value -= 1 : dc.value += 1
  dislike.value = !dislike.value
  axios.put('article/' + props.curr_id, {
    dislike: true,
  })
  .then(function () {
  })
  .catch(function () {
    dislike.value ? dc.value -= 1 : dc.value += 1
    dislike.value = !dislike.value
  });
}
 
</script>
<template>
  <div class="my-3">
    <v-card class="elevation-0 border" style="padding: 0 5px;">
      <v-card-title>{{ titre + ' | posté par ' + auteur }}</v-card-title>
      <v-card-subtitle class="d-flex align-center justify-space-between"><b>{{ categorie }}</b><span>{{ format(Math.floor(Date.now() - Date.parse(date_post))) }}</span></v-card-subtitle>
      <div class="divide py-2" style="width: 95%;"></div>
      <v-card-text v-html="texte" class="py-5"></v-card-text>

      <div class="d-flex align-center justify-space-between">

        <div class="d-flex align-center">
          <v-card-actions style="padding: 0 5px;">
          
            <v-btn variant="tonal" @click="$emit('open', curr_id)" class="flex items-center gap-2">
              <svg
                viewBox="0 0 32 32"
                version="1.1"
                width="20"
                height="20"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                fill="#000000"
              >
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g
                  id="SVGRepo_tracerCarrier"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                ></g>
                <g id="SVGRepo_iconCarrier">
                  <title>comment-3</title>
                  <desc>Created with Sketch Beta.</desc>
                  <defs></defs>
                  <g
                    id="Page-1"
                    stroke="none"
                    stroke-width="1"
                    fill="none"
                    fill-rule="evenodd"
                    sketch:type="MSPage"
                  >
                    <g
                      id="Icon-Set"
                      sketch:type="MSLayerGroup"
                      transform="translate(-204.000000, -255.000000)"
                      fill="#000000"
                    >
                      <path
                        d="M228,267 C226.896,267 226,267.896 226,269 C226,270.104 226.896,271 228,271 C229.104,271 230,270.104 230,269 C230,267.896 229.104,267 228,267 L228,267 Z M220,281 C218.832,281 217.704,280.864 216.62,280.633 L211.912,283.463 L211.975,278.824 C208.366,276.654 206,273.066 206,269 C206,262.373 212.268,257 220,257 C227.732,257 234,262.373 234,269 C234,275.628 227.732,281 220,281 L220,281 Z M220,255 C211.164,255 204,261.269 204,269 C204,273.419 206.345,277.354 210,279.919 L210,287 L217.009,282.747 C217.979,282.907 218.977,283 220,283 C228.836,283 236,276.732 236,269 C236,261.269 228.836,255 220,255 L220,255 Z M212,267 C210.896,267 210,267.896 210,269 C210,270.104 210.896,271 212,271 C213.104,271 214,270.104 214,269 C214,267.896 213.104,267 212,267 L212,267 Z M220,267 C218.896,267 218,267.896 218,269 C218,270.104 218.896,271 220,271 C221.104,271 222,270.104 222,269 C222,267.896 221.104,267 220,267 L220,267 Z"
                        id="comment-3"
                        sketch:type="MSShapeGroup"
                      ></path>
                    </g>
                  </g>
                </g>
              </svg>
            </v-btn>
          </v-card-actions>
          
          <v-btn variant="tonal" @click="$emit('showcoms',childs)">Voir les commentaires ({{ count }})</v-btn>
        </div>
        <div class="d-flex">
        <v-card-actions style="padding: 0 5px;">
        <v-btn variant="tonal" class="d-flex align-center" style="color: rgb(11, 11, 198);" @click="clike">
              <span class="mr-2">({{ c }})</span>
              <svg v-show="like" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2694 16.265L20.9749 12.1852C21.1511 11.1662 20.3675 10.2342 19.3345 10.2342H14.1534C13.6399 10.2342 13.2489 9.77328 13.332 9.26598L13.9947 5.22142C14.1024 4.56435 14.0716 3.892 13.9044 3.24752C13.7659 2.71364 13.354 2.28495 12.8123 2.11093L12.6673 2.06435C12.3399 1.95918 11.9826 1.98365 11.6739 2.13239C11.3342 2.29611 11.0856 2.59473 10.9935 2.94989L10.5178 4.78374C10.3664 5.36723 10.146 5.93045 9.8617 6.46262C9.44634 7.24017 8.80416 7.86246 8.13663 8.43769L6.69789 9.67749C6.29223 10.0271 6.07919 10.5506 6.12535 11.0844L6.93752 20.4771C7.01201 21.3386 7.73231 22 8.59609 22H13.2447C16.726 22 19.697 19.5744 20.2694 16.265Z" fill="blue"></path> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 9.48508C3.36893 9.46777 3.71261 9.76963 3.74721 10.1698L4.71881 21.4063C4.78122 22.1281 4.21268 22.7502 3.48671 22.7502C2.80289 22.7502 2.25 22.1954 2.25 21.5129V10.2344C2.25 9.83275 2.5664 9.5024 2.96767 9.48508Z" fill="blue"></path> </g></svg>
              <svg v-show="!like" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2694 16.265L20.9749 12.1852C21.1511 11.1662 20.3675 10.2342 19.3345 10.2342H14.1534C13.6399 10.2342 13.2489 9.77328 13.332 9.26598L13.9947 5.22142C14.1024 4.56435 14.0716 3.892 13.9044 3.24752C13.7659 2.71364 13.354 2.28495 12.8123 2.11093L12.6673 2.06435C12.3399 1.95918 11.9826 1.98365 11.6739 2.13239C11.3342 2.29611 11.0856 2.59473 10.9935 2.94989L10.5178 4.78374C10.3664 5.36723 10.146 5.93045 9.8617 6.46262C9.44634 7.24017 8.80416 7.86246 8.13663 8.43769L6.69789 9.67749C6.29223 10.0271 6.07919 10.5506 6.12535 11.0844L6.93752 20.4771C7.01201 21.3386 7.73231 22 8.59609 22H13.2447C16.726 22 19.697 19.5744 20.2694 16.265Z" fill="#dcdcdc"></path> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 9.48508C3.36893 9.46777 3.71261 9.76963 3.74721 10.1698L4.71881 21.4063C4.78122 22.1281 4.21268 22.7502 3.48671 22.7502C2.80289 22.7502 2.25 22.1954 2.25 21.5129V10.2344C2.25 9.83275 2.5664 9.5024 2.96767 9.48508Z" fill="#dcdcdc"></path> </g></svg>
        </v-btn>
        </v-card-actions>
        <v-card-actions style="padding: 0 5px;">
          <v-btn variant="tonal" class="flex items-center" style="color: red;" @click="cdislike">
                <span class="mr-2">({{ dc }})</span>
                <svg viewBox="0 0 24 24" width="20" v-show="!dislike" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2694 8.48505L20.9749 12.5648C21.1511 13.5838 20.3675 14.5158 19.3345 14.5158H14.1534C13.6399 14.5158 13.2489 14.9767 13.332 15.484L13.9947 19.5286C14.1024 20.1857 14.0716 20.858 13.9044 21.5025C13.7659 22.0364 13.354 22.465 12.8123 22.6391L12.6673 22.6856C12.3399 22.7908 11.9826 22.7663 11.6739 22.6176C11.3342 22.4539 11.0856 22.1553 10.9935 21.8001L10.5178 19.9663C10.3664 19.3828 10.146 18.8195 9.8617 18.2874C9.44634 17.5098 8.80416 16.8875 8.13663 16.3123L6.69789 15.0725C6.29223 14.7229 6.07919 14.1994 6.12535 13.6656L6.93752 4.27293C7.01201 3.41139 7.73231 2.75 8.59609 2.75H13.2447C16.726 2.75 19.697 5.17561 20.2694 8.48505Z" fill="#dcdcdc"></path> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 15.2651C3.36893 15.2824 3.71261 14.9806 3.74721 14.5804L4.71881 3.34389C4.78122 2.6221 4.21268 2 3.48671 2C2.80289 2 2.25 2.55474 2.25 3.23726V14.5158C2.25 14.9174 2.5664 15.2478 2.96767 15.2651Z" fill="#dcdcdc"></path> </g></svg>
                <svg viewBox="0 0 24 24" width="20" v-show="dislike" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2694 8.48505L20.9749 12.5648C21.1511 13.5838 20.3675 14.5158 19.3345 14.5158H14.1534C13.6399 14.5158 13.2489 14.9767 13.332 15.484L13.9947 19.5286C14.1024 20.1857 14.0716 20.858 13.9044 21.5025C13.7659 22.0364 13.354 22.465 12.8123 22.6391L12.6673 22.6856C12.3399 22.7908 11.9826 22.7663 11.6739 22.6176C11.3342 22.4539 11.0856 22.1553 10.9935 21.8001L10.5178 19.9663C10.3664 19.3828 10.146 18.8195 9.8617 18.2874C9.44634 17.5098 8.80416 16.8875 8.13663 16.3123L6.69789 15.0725C6.29223 14.7229 6.07919 14.1994 6.12535 13.6656L6.93752 4.27293C7.01201 3.41139 7.73231 2.75 8.59609 2.75H13.2447C16.726 2.75 19.697 5.17561 20.2694 8.48505Z" fill="red"></path> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 15.2651C3.36893 15.2824 3.71261 14.9806 3.74721 14.5804L4.71881 3.34389C4.78122 2.6221 4.21268 2 3.48671 2C2.80289 2 2.25 2.55474 2.25 3.23726V14.5158C2.25 14.9174 2.5664 15.2478 2.96767 15.2651Z" fill="red"></path> </g></svg>
              </v-btn>
        </v-card-actions>
        </div>
      </div>
    </v-card>
  </div>
</template>
