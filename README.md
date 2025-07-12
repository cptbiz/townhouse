# Multi-Tenant Laravel Application

Это приложение Laravel 5.8 с multi-tenancy поддержкой, адаптированное для развертывания на Railway (бэкенд) и Vercel (фронтенд).

## Архитектура

- **Бэкенд**: Laravel 5.8 с API на Railway
- **Фронтенд**: Vue.js 3 с Vite на Vercel
- **База данных**: MySQL (Railway)
- **Мульти-тенанси**: Hyn Multi-Tenant package

## Развертывание

### Бэкенд на Railway

1. Создайте аккаунт на [Railway](https://railway.app)
2. Подключите GitHub репозиторий
3. Добавьте MySQL сервис
4. Установите переменные окружения:

```bash
APP_NAME=YourApp
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your-mysql-password

CORS_ALLOWED_ORIGINS=https://your-frontend.vercel.app
```

5. Railway автоматически развернет приложение

### Фронтенд на Vercel

1. Перейдите в папку `frontend/`
2. Создайте аккаунт на [Vercel](https://vercel.com)
3. Подключите GitHub репозиторий
4. Установите переменные окружения:

```bash
VITE_API_URL=https://your-backend.railway.app/api
```

5. Vercel автоматически развернет приложение

## Локальная разработка

### Бэкенд

```bash
# Установка зависимостей
composer install

# Настройка переменных окружения
cp .env.example .env
php artisan key:generate

# Миграции
php artisan migrate

# Запуск сервера
php artisan serve
```

### Фронтенд

```bash
# Переход в папку фронтенда
cd frontend/

# Установка зависимостей
npm install

# Настройка переменных окружения
cp .env.example .env

# Запуск dev сервера
npm run dev
```

## API Endpoints

### Аутентификация
- `POST /api/register` - Регистрация
- `POST /api/login` - Вход
- `POST /api/logout` - Выход

### Тенанты
- `GET /api/tenants` - Список тенантов
- `POST /api/tenants` - Создание тенанта
- `GET /api/tenants/{id}` - Получение тенанта
- `PUT /api/tenants/{id}` - Обновление тенанта
- `DELETE /api/tenants/{id}` - Удаление тенанта

### Пользователи
- `GET /api/user` - Текущий пользователь

## Конфигурация

### Переменные окружения

#### Бэкенд (.env)
```bash
APP_NAME=YourApp
APP_ENV=production
APP_URL=https://your-app.railway.app
DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
CORS_ALLOWED_ORIGINS=https://your-frontend.vercel.app
```

#### Фронтенд (.env)
```bash
VITE_API_URL=https://your-backend.railway.app/api
VITE_APP_NAME=YourApp
```

## Структура проекта

```
├── app/                    # Laravel приложение
├── frontend/              # Vue.js фронтенд
│   ├── src/
│   │   ├── components/
│   │   ├── views/
│   │   ├── router/
│   │   └── utils/
│   ├── package.json
│   └── vite.config.js
├── routes/                # API маршруты
├── config/                # Конфигурация Laravel
├── railway.json           # Конфигурация Railway
├── nixpacks.toml          # Конфигурация Nixpacks
└── Procfile              # Процессы для Railway
```

## Безопасность

1. **CORS**: Настройте разрешенные домены в `config/cors.php`
2. **API Keys**: Используйте Laravel Passport для API аутентификации
3. **Environment Variables**: Не коммитьте `.env` файлы
4. **Database**: Используйте защищенные соединения

## Мониторинг

- **Railway**: Встроенные логи и метрики
- **Vercel**: Аналитика и функции
- **Laravel**: Логи в `storage/logs/`

## Поддержка

Для вопросов и проблем создайте issue в GitHub репозитории.
