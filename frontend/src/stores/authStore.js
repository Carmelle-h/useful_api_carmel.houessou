import { defineStore } from 'pinia'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: null,
    user: null,
    loading: false,
    error: null,
    errors: {},
    message: null,
    isAuth: false,
  
  }),

  actions: {

    async signup(dataRegister) {
      this.loading = true
      this.error = null
      this.errors = {}
      this.message = null

      try {
        const { data } = await api.post('auth/register', dataRegister)

        // Succès
        this.message = data.message || 'Singn up successful!'

        return { success: true, message: this.message }

      } catch (err) {
        if (err.response) {
          const responseData = err.response.data

          // Erreur de validation 
          if (err.response.status === 500) {
             this.error = responseData.message || 'An error occurred during registration'
            this.errors = responseData.errors || {}
          }
         
        }
        else {
          this.error = 'An unexpected error has occurred'
        }

        return { success: false, message: this.error, errors: this.errors }

      } finally {
        this.loading = false
      }
    },


    //Connexion

    async login(email, password) {
      this.loading = true
      this.error = null
      this.errors = {}
      this.message = null

      try {
        const { data } = await api.post('auth/login', { email, password })

        if (data.access_token) {
          this.token = data.access_token
          this.user = data.user
          localStorage.setItem('token', data.access_token)
          this.isAuth = true
          this.error = null
          this.message = 'Connection successful!'

          return { success: true, message: this.message }
        } else {
          this.error = data.message || 'Login echoué'
          return { success: false, message: this.error }
        }

      } catch (err) {
        if (err.response) {
          const responseData = err.response.data
          this.error = responseData.message || 'Incorrect data'
          this.errors = responseData.errors || {}
        } else {
          this.error = 'An error has occurred'
        }

        return { success: false, message: this.error, errors: this.errors }

      } finally {
        this.loading = false
      }
    },

    //Déconnexion

    logout() {
      this.token = null
      this.user = null
      this.isAuth = false
      this.isAdmin = false
      this.error = null
      this.errors = {}
      this.message = null
      localStorage.removeItem('token')
    },


    //Charger le token depuis le localStorage

    loadTokenFromStorage() {
      const token = localStorage.getItem('token')
      if (token) {
        this.token = token
        this.isAuth = true
      }
    },



    //Obtenir l'erreur d'un champ spécifique

    getFieldError(field) {
      return this.errors[field]?.[0] || null
    },


    setFieldError(field, message) {
      this.fieldErrors[field] = message
    },


    //Vérifier si un champ a une erreur

    hasFieldError(field) {
      return !!this.errors[field]
    },


    //Effacer l'erreur d'un champ

    clearFieldError(field) {
      if (this.errors[field]) {
        delete this.errors[field]
      }
      // Si plus d'erreurs, effacer le message global
      if (Object.keys(this.errors).length === 0) {
        this.error = null
      }
    },

    //Effacer toutes les erreurs
    clearAllErrors() {
      this.error = null
      this.errors = {}
      this.message = null
    },
  
  },

  getters: {
    //Vérifier s'il y a des erreurs
    hasErrors: (state) => {
      return Object.keys(state.errors).length > 0
    },

    //Compter le nombre d'erreurs
    errorCount: (state) => {
      return Object.values(state.errors).reduce((total, fieldErrors) => {
        return total + fieldErrors.length
      }, 0)
    }
  },

  persist: {
    key: 'auth',
    paths: ['token', 'user', 'isAdmin'],
  },
})