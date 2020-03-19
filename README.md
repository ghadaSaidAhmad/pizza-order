# Laravel Developer Challenge

A challenge for laravel developer position in Masr team.
Creating a pizza order application
using laravel JWT authentication.

# Installation Guidelines

## Prerequisites

- Docker

## Installation Setups

1. Clone the project files

   ```
   git clone https://github.com/ghadaSaidAhmad/pizza-order.git
   ```

2) cd into project directory

   ```
   cd /pizza-order/laradock
   ```

3) Build the required docker containers through `docker-compose`

   ```
   docker-compose up -d apache2 mariadb phpmyadmin
   ```

4) Append this DNS record to your hostes file Linux/Mac: `/etc/hostes` or Windows: `C:\Windows\System32\Drivers\hosts`

   ```
   # Pissa dockerized laravel project domain
   127.0.0.1 pizza.test
   ```

5) Access the main docker workspace bash

   ```
   winpty docker exec -it laradock_workspace_1 bash
   # winpty: for windows users

   ```

6) Migrte your database

   ```
   php artisan migrate

   ```

7) Open your browser and go to [pizza.test](pizza.test)

8.if you need access phpmyadmin http://localhost:8888/

    ```
    Server: mariadb
    Username: root
    Password: root

    ```

9. To start, restart or stop docker containers

   ```
   docker-compose [start,stop,restart]
   ```

## Running the tests
