<template>
  <div class="home">
    <div class="hero-section text-center py-5">
      <h1 class="display-4">Welcome to Multi-Tenant App</h1>
      <p class="lead">Manage your tenants and users efficiently</p>
      <router-link to="/login" class="btn btn-primary btn-lg me-3">Get Started</router-link>
      <router-link to="/register" class="btn btn-outline-primary btn-lg">Register</router-link>
    </div>
    
    <div class="row mt-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Multi-Tenancy</h5>
            <p class="card-text">Manage multiple tenants with isolated data and configurations.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">User Management</h5>
            <p class="card-text">Comprehensive user management with roles and permissions.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">API Ready</h5>
            <p class="card-text">RESTful API ready for integration with any frontend.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>

<style scoped>
.hero-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 10px;
  margin-bottom: 2rem;
}

.card {
  height: 100%;
  transition: transform 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}
</style>