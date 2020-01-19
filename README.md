# Searchable Staff Directory

- [About](#about)
- [Technology](#technology)
- [Project Configuration](#project-configuration)
- [References](#references)

## About
This is a searchable staff directory where user can search for their staff easily across various departments and can modify their inforamtion. Also, user can import staff's data using `csv` file. 

## Technology
```
- Laravel 6
- PHP
- MySql
- JavaScript
- jQuery
- AJAX
- HTML
- CSS
- Bootstrap
```

## Project Configuration
- Download and install composer - [link](https://getcomposer.org/)
- Clone Project from github `git clone https://github.com/abhishekH1992/staff_directory.git`
- Rename `.env.example` file to `.env`
- Open `Command Prompt`
- Run `composer install`
- Run `php artisan key:generate` to generate `app` key
- Connect to `DB` server. Open `.env` file and make below changes
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= //your db name
DB_USERNAME= //your db username
DB_PASSWORD= // your db password
```
- Run migration `php artisan migrate`
- Generate seed. Run `php artisan db:seed`
- Run `php artisan serve` to `run` project

## References
Please see official [laravel](https://laravel.com/docs/6.x) documantation for more information.
