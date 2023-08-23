<script setup>
import SelectCategorie from "./SelectCategorie.vue";
const props = defineProps({
  publicationModal: Boolean,
  categories: Object,
  article: Object,
});
</script>

<template>
  <div
    class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
    v-if="publicationModal"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <form>
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Titre : </label>
                <input
                  v-model="article.titre"
                  type="text"
                  required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="Titre de votre article"
                />
              </div>

              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                  >Votre publication :
                </label>
                <textarea
                  v-model="article.texte"
                  required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="Ecrivez ici ...."
                />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                  >Catégories :
                </label>
                <SelectCategorie :data="categories" v-model="article.categorie">
                </SelectCategorie>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md sm:ml-3 sm:w-auto">
              <button
                @click="$emit('addarticle')"
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-800 text-base leading-6 font-medium text-white hover:bg-green-700 focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              >
                Publier
              </button>
            </span>
            <span class="mt-3 flex w-full rounded-md sm:mt-0 sm:w-auto">
              <button
                style="background-color: rgb(197, 31, 31)"
                type="button"
                @click="$emit('closearticle')"
                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 text-white leading-6 font-medium focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              >
                Annuler
              </button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
