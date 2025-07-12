<template>
  <div class="register">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Register</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleRegister">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="name" 
                  v-model="form.name"
                  required
                >
              </div>
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
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password_confirmation" 
                  v-model="form.password_confirmation"
                  required
                >
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  {{ loading ? 'Registering...' : 'Register' }}
                </button>
              </div>
            </form>
            <div class="text-center mt-3">
              <router-link to="/login">Already have an account? Login</router-link>
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
  name: 'Register',
  setup() {
    const router = useRouter()
    const loading = ref(false)
    const form = ref({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    })

    const handleRegister = async () => {
      if (form.value.password !== form.value.password_confirmation) {
        alert('Passwords do not match')
        return
      }

      loading.value = true
      try {
        await apiService.register(form.value)
        alert('Registration successful! Please log in.')
        router.push('/login')
      } catch (error) {
        console.error('Registration failed:', error)
        alert('Registration failed. Please try again.')
      } finally {
        loading.value = false
      }
    }

    return {
      form,
      loading,
      handleRegister
    }
  }
}
</script>