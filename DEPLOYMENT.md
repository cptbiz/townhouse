# Руководство по развертыванию

## Подготовка к развертыванию

### 1. Подготовка репозитория

Убедитесь, что у вас есть:
- Аккаунт на GitHub
- Репозиторий с кодом проекта
- Структура проекта с папкой `frontend/` для фронтенда

### 2. Настройка переменных окружения

Создайте файлы `.env` на основе примеров:

**Бэкенд (.env):**
```bash
cp .env.example .env
php artisan key:generate
```

**Фронтенд (frontend/.env):**
```bash
cd frontend/
cp .env.example .env
```

## Развертывание бэкенда на Railway

### Шаг 1: Настройка Railway

1. Перейдите на [Railway](https://railway.app)
2. Войдите через GitHub
3. Нажмите "New Project"
4. Выберите "Deploy from GitHub repo"
5. Выберите ваш репозиторий

### Шаг 2: Добавление базы данных

1. В проекте нажмите "New Service"
2. Выберите "Database" → "MySQL"
3. Railway автоматически создаст базу данных

### Шаг 3: Настройка переменных окружения

В настройках проекта Railway добавьте:

```bash
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}

CORS_ALLOWED_ORIGINS=https://your-frontend.vercel.app,http://localhost:3000
API_DOMAIN=your-app.railway.app
```

**Важно:** Railway автоматически заполнит переменные MySQL из сервиса базы данных.

### Шаг 4: Развертывание

1. Railway автоматически развернет приложение
2. Проверьте логи на наличие ошибок
3. Откройте URL приложения
4. Проверьте endpoint здоровья: `https://your-app.railway.app/api/health`

## Развертывание фронтенда на Vercel

### Шаг 1: Настройка Vercel

1. Перейдите на [Vercel](https://vercel.com)
2. Войдите через GitHub
3. Нажмите "New Project"
4. Выберите ваш репозиторий
5. Настройте корневую папку на `frontend/`

### Шаг 2: Настройка сборки

В настройках проекта Vercel:

**Build Command:**
```bash
npm run build
```

**Output Directory:**
```bash
dist
```

**Install Command:**
```bash
npm install
```

### Шаг 3: Настройка переменных окружения

В настройках Vercel добавьте:

```bash
VITE_API_URL=https://your-backend.railway.app/api
VITE_APP_NAME=YourAppName
VITE_APP_ENV=production
```

### Шаг 4: Развертывание

1. Vercel автоматически развернет приложение
2. Проверьте логи на наличие ошибок
3. Откройте URL приложения

## Проверка работоспособности

### Тестирование API

1. Откройте `https://your-backend.railway.app/api/health`
2. Должен вернуться JSON с статусом "ok"

### Тестирование фронтенда

1. Откройте `https://your-frontend.vercel.app`
2. Попробуйте зарегистрироваться
3. Попробуйте войти в систему

## Обновление переменных окружения

### После развертывания обновите:

**В Railway (бэкенд):**
```bash
CORS_ALLOWED_ORIGINS=https://your-actual-frontend.vercel.app
```

**В Vercel (фронтенд):**
```bash
VITE_API_URL=https://your-actual-backend.railway.app/api
```

## Настройка домена (опционально)

### Для бэкенда (Railway):
1. Перейдите в настройки проекта
2. В разделе "Domains" добавьте свой домен
3. Настройте DNS записи

### Для фронтенда (Vercel):
1. Перейдите в настройки проекта
2. В разделе "Domains" добавьте свой домен
3. Настройте DNS записи

## Автоматическое развертывание

### Настройка CI/CD:

1. **Railway**: Автоматически развертывает при push в основную ветку
2. **Vercel**: Автоматически развертывает при push в основную ветку

### Настройка webhooks:

Для уведомлений о развертывании можно настроить webhooks в настройках проектов.

## Мониторинг и логи

### Railway:
- Логи: В панели управления проектом
- Метрики: Встроенные метрики производительности
- Уведомления: Настройки alerts

### Vercel:
- Логи: В панели управления проектом
- Аналитика: Встроенная аналитика
- Функции: Мониторинг serverless функций

## Решение проблем

### Частые ошибки:

1. **500 Internal Server Error**: Проверьте логи Railway
2. **CORS Error**: Проверьте настройки CORS в Laravel
3. **Database Connection**: Проверьте переменные базы данных
4. **Build Failed**: Проверьте зависимости и команды сборки

### Отладка:

1. Включите `APP_DEBUG=true` для отладки (не для production!)
2. Проверьте логи в Railway и Vercel
3. Используйте инструменты разработчика браузера

## Безопасность

### Рекомендации:

1. Используйте HTTPS для всех соединений
2. Настройте правильные CORS политики
3. Не выносите секретные ключи в код
4. Регулярно обновляйте зависимости
5. Используйте сильные пароли для базы данных

## Обслуживание

### Регулярные задачи:

1. Мониторинг производительности
2. Обновление зависимостей
3. Бэкап базы данных
4. Проверка логов на ошибки

### Масштабирование:

1. **Railway**: Автоматическое масштабирование
2. **Vercel**: Автоматическое масштабирование Edge Functions
3. **База данных**: Возможность апгрейда плана MySQL

## Поддержка

- Railway: [Документация](https://docs.railway.app)
- Vercel: [Документация](https://vercel.com/docs)
- Laravel: [Документация](https://laravel.com/docs)
- Vue.js: [Документация](https://vuejs.org/guide/)