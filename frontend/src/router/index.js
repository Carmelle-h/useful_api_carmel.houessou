import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'
import HomeView from '@/views/HomeView.vue'
import SignIn from '@/views/auth/SignIn.vue'
import SignUp from '@/views/auth/SignUp.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true },
    },

    {
      path: '/signup',
      name: 'signup',
      component: SignUp,
      meta: { requiresAuth: false },
    },

    {
      path: '/login',
      name: 'login',
      meta: { requiresAuth: false },
      component: SignIn,
    },
  ],
})

router.beforeEach((to) => {
  const auth = useAuthStore()

  if (to.meta.requiresAuth && !auth.token) {
    return { name: 'login' }
  }

  if (to.name === 'login' && auth.token) {
    return { name: 'home' }
  }
  if (to.name === 'signup' && auth.token) {
    return { name: 'home' }
  }
})

export default router
