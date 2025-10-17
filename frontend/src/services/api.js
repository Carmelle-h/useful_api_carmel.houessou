import { useAuthStore } from '@/stores/authStore';
import axios from 'axios';
 

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  withCredentials:true,
  headers: {
    'Content-Type': 'application/json', 
    // 'Access-Control-Allow-Origin':'http://127.0.0.1:8000',
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Credentials': true,
    
  },
});
 
// Intercepteur pour ajouter le token
api.interceptors.request.use(config => {
  const authStore = useAuthStore()
  authStore.loadTokenFromStorage()
  if (authStore.token) {
    config.headers.Authorization = 'Bearer ' + authStore.token
  }
  return config
}, error => {
  return Promise.reject(error)
})
export default api;