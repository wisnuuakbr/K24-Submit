# K24 Submit Test

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirements
Starter template laravel is currently extended with the following requirements.  
Instructions on how to use them in your own application are linked below.
| Requirement | Version   |
|-------------|-----------|
| PHP         |   8.1.10  |
| Mysql       |   8.0.30  |

## Installation
Make sure all requirements are installed on the system.
Clone the project and install dependencies:
```bash
$ git clone https://github.com/wisnuuakbr/K24-Submit.git
$ cd K24-Submit
$ composer install
```

## Configuration
Copy the .env.example file and rename it to .env  
Change the config for your local server
```bash
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=K-24_db
DB_USERNAME=root
DB_PASSWORD=
```

## Generate App Key
Generate the application key using the following command:
```bash
$ php artisan key:generate
```

## Migration & Seeder
Run the migrations:
```bash
$ php artisan migrate
```
Run the seeder:
```bash
$ php artisan db:seed
```

## Run Application
Run the application:
```bash
$ php artisan serve
```
## Endpoints

These are the endpoints we will use to create, read, update and delete the course data.

```bash
GET members → http://localhost:8000/api/members → Retrieves all the members list
```
