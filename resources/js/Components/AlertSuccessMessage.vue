<script setup>
defineProps({
  on: Boolean,
});
</script>

<template>
  <transition
    enter-active-class="transition ease-in duration-1000"
    leave-active-class="transition ease-in duration-1000"
    leave-from-class="opacity-100"
    enter-from-class="opacity-0"
    leave-to-class="opacity-0"
    enter-to-class="opacity-100"
  >
    <div v-show="on" class="rounded mess">
      <div class="text-sm text-white">
        <div
          class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
          role="alert"
        >
          <svg
            class="flex-shrink-0 inline w-4 h-4 mr-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            width="20px"
            height="20px"
            viewBox="0 0 1024 1024"
          >
            <path
              d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"
            />
          </svg>

          <div>
            <span class="font-medium"> <slot name="message" /></span>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style>
.mess {
  position: fixed;
  bottom: 10px;
  right: 10px;
}
</style>
