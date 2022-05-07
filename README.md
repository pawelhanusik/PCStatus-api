# PC Status - API

PC Status – monitoring tool for processes running on pc

The project consists of 3 subprograms:

- [PC Status API](https://github.com/pawelhanusik/PCStatus-api)

- [PC Status client-pc](https://github.com/pawelhanusik/PCStatus-client-pc)

- [PC Status client-android](https://github.com/pawelhanusik/PCStatus-client-android)

## Goal

The goal of the project is to add new feature to the smartphone by connecting it with pc. By doing so it will gain remote monitoring functionalities.

## Use cases

Progress of any bash script, any process, monitoring RAM, cpu usage & more.

---

## Usage

Creating new user

`php artisan user:register username password`

Listing users

`php artisan user:list`

Deleting the user

`php artisan user:delete username`

Generating new token

`php artisan token:create username token_name`

Listing existing tokens

`php artisan token:list username`

Deleting token

`php artisan token:remove username token_name`

## Installation

1. Clone repository.

1. Install php 8 (with mbstring, dom, curl extensions)

1. Install php dependencies:

    ```
    composer install
    ```

1. Create default config file:

    ```
    cp .env.example .env
    ```

1. Generate app key:

    ```
    php artisan key:generate
    ```

1. Configure database:

- setup for MySQL

    - install and enable mysql php extension

    - in .env file: 
        ```
        DB_CONNECTION=mysql
        DB_HOST=<database_host>
        DB_PORT=<database_port>
        DB_DATABASE=<database_name>
        DB_USERNAME=<database_username>
        DB_PASSWORD=<database_password>
        ```

- setup for SQLite

    - install and enable sqlite php extension.

    - in .env:

        ```
        DB_CONNECTION=sqlite
        ```

        and REMOVE all other vars prefixed with DB_

    - create db file:
        
        ```
        touch database/database.sqlite
        ```

1. Generate database:

    ```
    php artisan migrate
    ```

## Running

Just host `public` directory as a root directory in your domain.

## Clearing database

```
php artisan migrate:fresh
```

# Production

In .env:

```
APP_ENV=production
APP_DEBUG=false
```
