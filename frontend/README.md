# Multi-Tenant App Frontend

Фронтенд приложения на Vue.js 3 для развертывания на Vercel.

## Установка

```bash
npm install
```

## Разработка

```bash
npm run dev
```

## Сборка

```bash
npm run build
```

## Развертывание на Vercel

1. Создайте аккаунт на [Vercel](https://vercel.com)
2. Подключите ваш GitHub репозиторий
3. Установите переменные окружения:
   - `VITE_API_URL` - URL вашего API на Railway
4. Развертывание произойдет автоматически

## Переменные окружения

Скопируйте `.env.example` в `.env` и настройте:

```bash
cp .env.example .env
```

- `VITE_API_URL` - URL API бэкенда
- `VITE_APP_NAME` - Название приложения
- `VITE_APP_ENV` - Окружение (production/development)

## Структура проекта

```
src/
├── components/     # Переиспользуемые компоненты
├── views/          # Страницы приложения
├── router/         # Конфигурация маршрутов
├── store/          # Управление состоянием (Pinia)
├── utils/          # Утилиты и API сервисы
└── assets/         # Статические ресурсы
```