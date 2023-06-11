# John Task Manager

# Getting started

## Installation

Clone the repository

    git clone git@github.com:Adshow/john-task-list.git

Switch to the repo folder

    cd john-task-list

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

To run the local tests

    php artisan test

## Deploy with Docker

To execute this project with Docker exec

```bash
  docker-compose up --build
```

To run the migration

```bash
  docker-compose exec web php artisan migrate
```

To run the tests

```bash
  docker-compose exec web php artisan test
```
