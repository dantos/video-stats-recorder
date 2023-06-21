# Video Stats Recorder

> About

VSR is a platform used to decrypt and display statistics of a video related to its performance, such as frame rate, latency, buffering...

## Requirements
- PHP 7.3 
- MySQL 5.8.^ | MariaDB 11.^
- Laravel 8

## Installation

Once the project has been cloned, perform the following steps from the root directory:
- run `composer install`
- Copy the file 'example.env' and rename it to '.env'
- Create database in mysql and set the corresponding database name and credentials in the '.env' file
- run `php artisan key:generate`

Populate the database
- run `php artisan migrate:fresh --seed`

## Serve the project in your development environment

- run `php artisan serve`

## Test credentials and login

- You can use any of the credentials listed in the seeder file: `CreateAdminAccountTableSeeder.php`
- You can browse to your default local server address or http://localhost:8000/ and continue to login. 
