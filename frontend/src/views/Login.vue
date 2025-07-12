<template>
  <div class="login">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Login</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleLogin">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                  type="email" 
                  class="form-control" 
                  id="email" 
                  v-model="form.email"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password" 
                  v-model="form.password"
                  required
                >
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  {{ loading ? 'Logging in...' : 'Login' }}
                </button>
              </div>
            </form>
            <div class="text-center mt-3">
              <router-link to="/register">Don't have an account? Register</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import apiService from '../utils/api'

export default {
  name: 'Login',
  setup() {
    const router = useRouter()
    const loading = ref(false)
    const form = ref({
      email: '',
      password: ''
    })

    const handleLogin = async () => {
      loading.value = true
      try {
        const response = await apiService.login(form.value)
        // Store token and redirect
        localStorage.setItem('token', response.data.token)
        router.push('/')
      } catch (error) {
        console.error('Login failed:', error)
        alert('Login failed. Please check your credentials.')
      } finally {
        loading.value = false
      }
    }

    return {
      form,
      loading,
      handleLogin
    }
  }
}
</script>