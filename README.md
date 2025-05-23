# EPI Health Tracker Backend

Health tracker for EPI, including tracking food, medication, and symptoms. Including a Laravel-based authentication backend that provides secure user management using Laravel Sanctum and Fortify. This project also includes API authentication, registration, login, and user management.

## Tech Stack

- **Laravel** – Backend framework  
- **Laravel Sanctum** – API authentication  
- **Laravel Fortify** – Authentication backend  
- **Laravel Breeze** – Simple authentication scaffolding  
- **MySQL** – Default database (but any database can be used)  

## Frontend Integration

This backend is designed to work seamlessly with a Vue.js frontend that I built. You can find my custom Vue.js implementation here:

[EPI-Health-Tracker-Frontend](https://github.com/Tabs467/EPI-Health-Tracker-Frontend)

## Project Setup

### Install dependencies

```sh
composer install
```

### Create .env file

```sh
cp .env.example .env
```

### Generate app key

```sh
php artisan key:generate
php artisan config:clear
```

### Create db and run migrations

### Run dev server

```sh
php artisan serve
```
