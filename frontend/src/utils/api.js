import axios from 'axios'

// Создаем экземпляр axios с базовой конфигурацией
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

// Интерцептор для добавления токена к запросам
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// Интерцептор для обработки ошибок
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

const apiService = {
  // Аутентификация
  login: (credentials) => api.post('/login', credentials),
  register: (userData) => api.post('/register', userData),
  logout: () => api.post('/logout'),
  
  // Пользователи
  getUser: () => api.get('/user'),
  updateUser: (userData) => api.put('/user', userData),
  
  // Тенанты
  getTenants: () => api.get('/tenants'),
  createTenant: (tenantData) => api.post('/tenants', tenantData),
  updateTenant: (id, tenantData) => api.put(`/tenants/${id}`, tenantData),
  deleteTenant: (id) => api.delete(`/tenants/${id}`)
}

export default apiService