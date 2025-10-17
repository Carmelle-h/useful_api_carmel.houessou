<template>
  <header class="bg-white fixed shadow-md z-15 top-0 w-full py-3">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex-1 md:flex md:items-center md:gap-12">
          <router-link to="/" class="flex" >
            <p class="text-dark font-black text-2xl">Your</p>
            <p class="text-blue-600 font-black text-2xl ms-2"> workplace</p>
          </router-link>
        </div>

        <div class="md:flex md:items-center md:gap-12">
          <nav aria-label="Global" class="hidden md:block">
            <ul class="flex items-center gap-6 text-sm">
              <li>
                <router-link
                  to="/signup"
                  class="text-gray-600 transition hover:text-blue-600/75 hover:font-medium"
                  href="#"
                >
                  Sing up
                </router-link>
              </li>
            </ul>
          </nav>

          <div class="flex items-center gap-4">
            <div class="sm:flex sm:gap-4">
              <router-link
                to="/login"
                v-if="authStore.isAuth != true"
                class="rounded-full bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm"
              >
                Login
              </router-link>
              <!-- SVG PROFILE  -->

              <router-link to="/" v-if="authStore.isAuth == true">
                <img :src="authStore.user.avatar" alt="" class="w-10 h-10 rounded-full" />
              </router-link>
            </div>

            <!-- TOGGLE BUTTON -->
            <div class="block md:hidden">
              <button
                @click="isMenuOpen = !isMenuOpen"
                class="rounded-sm bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- MOBILE MENU -->
      <transition name="fade">
        <nav v-if="isMenuOpen" class="md:hidden mt-3 bg-white p-4">
          <ul class="flex flex-col gap-4 text-gray-700"></ul>
        </nav>
      </transition>
    </div>
  </header>
</template>

<script setup>
import { useAuthStore } from '@/stores/authStore'
import { ref } from 'vue'
// import router from '@/router'
// import { useRouter } from 'vue-router'
const authStore = useAuthStore()
const isMenuOpen = ref(false)

// const closeMenu = () => {
//   isMenuOpen.value = false;
// };
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
