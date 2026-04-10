# Laravel React Project - Schema Visualizer

A clean Laravel 11 + React 18 project with an interactive database schema visualizer.

## 🎯 What's Included

This is a minimal Laravel + React setup containing:
- **Essential Laravel Tables**: Users, cache, jobs, sessions
- **Schema Visualizer**: Interactive web-based tool to visualize your database structure
- **Clean Slate**: Ready for your custom models, controllers, and migrations

## 📁 Project Structure

```
db_demo/
├── database/
│   ├── migrations/              # Essential Laravel migrations only
│   └── seeders/                 # Empty seeder ready for your data
├── app/
│   ├── Models/
│   │   └── User.php             # Laravel User model
│   └── Http/
│       └── Controllers/
│           ├── Controller.php   # Base controller
│           └── Api/
│               └── SchemaController.php  # Schema API endpoint
├── resources/
│   └── js/
│       ├── components/
│       │   └── SchemaVisualizer.jsx      # Visualizer component
│       └── pages/
│           └── SchemaVisualizerPage.jsx  # Visualizer page
└── routes/
    ├── api.php              # Empty - ready for your API routes
    └── web.php              # Schema route + SPA catch-all
```

## 🚀 Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Installation

1. **Install dependencies:**
```bash
composer install
npm install
```

2. **Set up environment:**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configure database in `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uni_db
DB_USERNAME=root
DB_PASSWORD=
```

4. **Run migrations:**
```bash
php artisan migrate
```

5. **Start development servers:**
```bash
# Terminal 1: Laravel backend
php artisan serve

# Terminal 2: Vite frontend
npm run dev
```

6. **Open browser:**
- Visit: `http://localhost:8000/`
- Or: `http://localhost:8000/schema-visualizer`

## 📊 Current Database Tables

The project includes only essential Laravel tables:
- `users` - User authentication
- `cache` - Application cache
- `cache_locks` - Cache locks
- `jobs` - Queue jobs
- `job_batches` - Job batches
- `failed_jobs` - Failed jobs
- `password_reset_tokens` - Password resets
- `sessions` - User sessions
- `migrations` - Migration tracking

## 🔧 API Endpoints

- `GET /schema` - Returns complete database schema as JSON

## 🎨 Schema Visualizer Features

- Interactive visualization of all database tables
- Shows columns with data types
- Displays table relationships
- Responsive design
- Pan and zoom functionality

## 📝 Building Your Application

### 1. Create Migrations
```bash
php artisan make:migration create_your_table_name
```

### 2. Create Models
```bash
php artisan make:model YourModel -m
```

### 3. Create Controllers
```bash
php artisan make:controller YourController --api
```

### 4. Add API Routes
Edit `routes/api.php`:
```php
Route::apiResource('your-resource', YourController::class);
```

### 5. Create React Components
Add components in `resources/js/components/`

### 6. Update Router
Edit `resources/js/app.jsx` to add new routes

## 🛠️ Technology Stack

- **Backend:** Laravel 11
- **Frontend:** React 18 + Vite
- **Styling:** Tailwind CSS
- **Database:** MySQL

## 🧪 Testing

```bash
php artisan test
```

## 📦 Production Build

```bash
npm run build
php artisan optimize
```

## 📄 License

Open-source under the MIT License.

---

**This is a clean starting point for any Laravel + React application. Build your dream project! 🚀**
