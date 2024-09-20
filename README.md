<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## REST API for ToDoList Application

### Installation

- `git clone ...` clone the project locally
- `cd api-crud` - change directory into project folder
- `composer install` - install necessary dependencies
- `cp .env.example .env` - make a copy of example env file
- make changes in DB configraion according to your preference
- `php artisan key:generate` - generate application key
- `php artisan migrate` - populate database with required tables
- `php artisan db:seed` - populate tables with required data (user creds)
- `php artisan serve` - start the server

### Versions

- PHP v8.1
- Laravel v9.19
- MySQL v8.0 (optional, if you use another driver)
- php8.2-sqlite3 extensions for in-memory testing

### Credentials

- *email:* test@example.com
- *password:* 123456

Also available in `database/seeders/DatabaseSeeder.php` file

### Postman

Postman collection can be exported using `todo-api.postman_collection.json` file
