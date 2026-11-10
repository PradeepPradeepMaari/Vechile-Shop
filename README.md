# Markham Infiniti - Vehicle Showroom

A Laravel + MySQL vehicle showroom management application with an admin panel.

## Tech Stack
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript, jQuery
- **Backend:** PHP 8.2, Laravel 10, MySQL, Eloquent ORM

## Requirements
- PHP >= 8.1
- MySQL >= 5.7
- Composer
- XAMPP (or equivalent Apache/MySQL stack)

## Installation & Setup

### 1. Create the MySQL Database
Open phpMyAdmin (http://localhost/phpmyadmin) or MySQL CLI and create the database:
```sql
CREATE DATABASE shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Configure Environment
The `.env` file is already configured for XAMPP defaults:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shop
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Run Migrations & Seeders
```bash
cd C:\xampp\htdocs\shop
php artisan migrate
php artisan db:seed
```

This will:
- Create the `users` table (with username support)
- Create the `model_showrooms` table
- Seed 1 admin user and 14 sample vehicles
- Copy vehicle images to storage

### 4. Create Storage Link (already done)
```bash
php artisan storage:link
```

### 5. Access the Application
- **Homepage:** http://localhost/shop/public/
- **Admin Login:** http://localhost/shop/public/admin/login

### Admin Credentials (Development Only)
| Field    | Value            |
|----------|------------------|
| Username | `admin`          |
| Email    | `admin@gmail.com`|
| Password | `password`       |

> **⚠️ IMPORTANT:** Change the default password before production deployment:
> ```bash
> php artisan tinker
> >>> User::find(1)->update(['password' => Hash::make('your-secure-password')]);
> ```

## Project Structure
```
shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php          # Customer homepage
│   │   │   └── Admin/
│   │   │       ├── AdminLoginController.php # Admin auth
│   │   │       └── ModelShowroomController.php # CRUD + Dashboard
│   │   └── Requests/
│   │       ├── StoreModelShowroomRequest.php
│   │       └── UpdateModelShowroomRequest.php
│   └── Models/
│       ├── User.php
│       └── ModelShowroom.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── AdminSeeder.php
│       ├── ModelShowroomSeeder.php
│       └── DatabaseSeeder.php
├── public/assets/
│   ├── frontend/   # Customer UI assets
│   └── admin/      # Admin UI assets
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php      # Customer layout
│   │   └── admin.blade.php    # Admin layout
│   ├── partials/
│   │   ├── header.blade.php   # Customer header
│   │   ├── footer.blade.php   # Customer footer
│   │   └── admin/
│   │       ├── sidebar.blade.php
│   │       ├── topbar.blade.php
│   │       └── footer.blade.php
│   ├── home.blade.php         # Customer homepage
│   └── admin/
│       ├── login.blade.php
│       ├── dashboard.blade.php
│       └── models/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── edit.blade.php
├── routes/web.php
├── storage/app/public/vehicles/  # Uploaded images
└── ui/                           # Original static UI (backup)
```

## Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | `home` | Customer homepage |
| GET | `/admin/login` | `admin.login` | Admin login form |
| POST | `/admin/login` | — | Process login |
| POST | `/admin/logout` | `admin.logout` | Logout |
| GET | `/admin/dashboard` | `admin.dashboard` | Admin dashboard |
| GET | `/admin/models` | `admin.models.index` | List models |
| GET | `/admin/models/create` | `admin.models.create` | Add model form |
| POST | `/admin/models` | `admin.models.store` | Save new model |
| GET | `/admin/models/{id}/edit` | `admin.models.edit` | Edit model form |
| PUT | `/admin/models/{id}` | `admin.models.update` | Update model |
| DELETE | `/admin/models/{id}` | `admin.models.destroy` | Delete model |
