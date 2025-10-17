<template>
  <div class="min-h-screen py-10 px-4">
    <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 max-w-xl w-full mx-auto">
      <h2 class="text-2xl font-bold text-center text-blue-600 mb-8">Registration</h2>

      <!-- Message global -->
      <div
        v-if="authStore.error"
        class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg animate-shake"
      >
        <div class="flex items-start gap-3">
          <span class="text-2xl"><i class="fa-solid fa-xmark text-red-600"></i> </span>
          <div class="flex-1">
            <p class="font-semibold text-red-800">{{ authStore.error }}</p>
            <!-- Liste des erreurs -->
            <ul v-if="authStore.hasErrors" class="mt-2 space-y-1">
              <li
                v-for="(errorList, field) in authStore.errors"
                :key="field"
                class="text-sm text-red-700"
              >
                {{ errorList[0] }}
              </li>
            </ul>
          </div>
          <button
            @click="authStore.clearAllErrors()"
            class="text-red-800 hover:text-red-700 text-xl transition"
          >
            ✕
          </button>
        </div>
      </div>

      <!-- Message de succès -->
      <div
        v-if="authStore.message && !authStore.error"
        class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg"
      >
        <div class="flex items-start gap-3">
          <span class="text-2xl"><i class="fa-solid fa-check text-green-600"></i> </span>
          <p class="flex-1 font-semibold text-green-800">{{ authStore.message }}</p>
        </div>
      </div>

      <!-- Formulaire -->
      <form @submit.prevent="gererSignUp" class="space-y-6">
        <!-- Name -->
        <div>
          <label for="name" class="block text-blue-600 font-semibold mb-2"> Name </label>
          <input
            type="text"
            id="name"
            v-model="data.name"
            :class="inputClasses('name')"
            placeholder="Enter your name"
            @input="authStore.clearFieldError('name')"
            required
          />

          <!-- Erreur du champ -->
          <p
            v-if="authStore.getFieldError('name')"
            class="text-red-600 text-sm mt-1 flex items-center gap-1"
          >
            <showFormErrors :error="authStore.getFieldError('name')" />
          </p>
          <!-- Validation locale -->
          <p v-else-if="data.name && data.name.length < 3" class="text-red-600 text-sm mt-2">
            <AlertTriangle class="w-5 h-5" />
            Le nom doit contenir au moins 3 caractères
          </p>
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-blue-600 font-semibold mb-2"> Email </label>
          <input
            type="email"
            id="email"
            v-model="data.email"
            :class="inputClasses('email')"
            placeholder="Enter your email"
            @input="authStore.clearFieldError('email')"
            required
          />
          <p
            v-if="authStore.getFieldError('email')"
            class="text-red-600 text-sm mt-1 flex items-center gap-1"
          >
            <showFormError :error="authStore.getFieldError('email')" />
          </p>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-blue-600 font-semibold mb-2"> Password </label>
          <div class="relative">
            <input
              type="password"
              id="password"
              v-model="data.password"
              :class="inputClasses('password')"
              placeholder="Enter your password"
              @input="authStore.clearFieldError('password')"
              required
            />
          </div>
          <p
            v-if="authStore.getFieldError('password')"
            class="text-red-600 text-sm mt-1 flex items-center gap-1"
          >
            <showFormError :error="authStore.getFieldError('password')" />
          </p>
          <p v-else class="text-xs text-gray-500 mt-1">
            Min 8 characters, 1 uppercase, 1 lowercase, 1 number
          </p>
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="confirm-password" class="block text-blue-600 font-semibold mb-2">
            Confirm Password
          </label>
          <input
            type="password"
            id="confirm-password"
            v-model="data.password_confirmation"
            :class="inputClasses('password_confirmation')"
            placeholder="Confirm your password"
            @input="authStore.clearFieldError('password_confirmation')"
            required
          />
          <p
            v-if="authStore.getFieldError('password_confirmation')"
            class="text-red-600 text-sm mt-1 flex items-center gap-1"
          >
            <showFormError :error="authStore.getFieldError('password_confirmation')" />
          </p>
          <!-- Validation locale -->
          <p
            v-else-if="
              data.password &&
              data.password_confirmation &&
              data.password !== data.password_confirmation
            "
            class="text-red-600 text-sm mt-1"
          >
            <AlertTriangle class="w-5 h-5" />
            Les mots de passe ne correspondent pas
          </p>
        </div>

        <!-- Bouton Submit -->
        <button
          type="submit"
          :disabled="authStore.loading || !isFormValid"
          class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-600 focus:outline-none transition-all duration-300 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
        >
          <span v-if="authStore.loading" class="flex items-center justify-center gap-2">
            <span class="animate-spin">⏳</span>
            Registration in progress...
          </span>
          <span v-else>Register</span>
        </button>
      </form>

      <!-- Lien connexion -->
      <p class="text-center text-gray-600 mt-6">
        Already have an account?
        <router-link
          to="/login"
          class="text-blue-600 font-semibold hover:underline transition-colors duration-300"
        >
          Sign In
        </router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import router from '@/router'
import { showSuccess, showError } from '@/helpers/toast'
import showFormError from '@/components/showFormError.vue'

const authStore = useAuthStore()

// Données du formulaire
const data = ref({
  name: null,
  location: null,
  birth_date: null,
  email: null,
  password: null,
  password_confirmation: null,
})

//Vérifier si le formulaire est valide
const isFormValid = computed(() => {
  return (
    data.value.name &&
    data.value.name.length >= 3 &&
    data.value.email &&
    data.value.password &&
    data.value.password.length >= 8 &&
    data.value.password_confirmation &&
    data.value.password === data.value.password_confirmation
  )
})

function inputClasses(field) {
  const baseClasses =
    'w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 transition-all duration-300'
  const errorClasses = 'border-red-500 focus:ring-red-500 bg-red-50'
  const normalClasses = 'border-gray-200 focus:ring-indigo-800'

  return `${baseClasses} ${authStore.hasFieldError(field) ? errorClasses : normalClasses}`
}

const gererSignUp = async () => {
  authStore.clearAllErrors()

  if (!isFormValid.value) {
    showError('Veuillez remplir correctement tous les champs')
    return
  }

  const result = await authStore.signup(data.value)

  if (result.success) {
    showSuccess(result.message || 'Account created successfully!')

    setTimeout(() => {
      router.push('/email-sent')
    }, 1000)
  } else {
    showError(result.message || 'Registration failed')

    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}
</script>

<style scoped>
/* Animation shake pour les erreurs */
@keyframes shake {
  0%,
  100% {
    transform: translateX(0);
  }
  10%,
  30%,
  50%,
  70%,
  90% {
    transform: translateX(-5px);
  }
  20%,
  40%,
  60%,
  80% {
    transform: translateX(5px);
  }
}

.animate-shake {
  animation: shake 0.5s;
}

/* Animation spin */
.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Transition douce pour les inputs */
input:focus,
select:focus {
  transform: scale(1.01);
}
</style>
