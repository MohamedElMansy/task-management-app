## Task Management App

This is a simple web application to manage tasks and authentication system.

## Technologies
using laravel 8 ,livewire 2.10 , bootstrap and jquery

## Setup steps
Clone the repository

    git clone git@github.com:MohamedElMansy/task-management-app.git

Switch to the repo folder

    cd task-management-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run admin seeder to create the admin

    php artisan db:seed --class=AdminSeeder

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000/tasks

Note*
Admin credentials
email -> admin@example.com
password -> 123 
