# Laravel Developer Challenge

a challenge for Laravel developer position in Masr team. 
Create a Pizza order application 
laravel authentication for laravel 6 using JWT Auth



# Docker Installing 

## Require

+ Docker

## Setup


1. Clone your project  

    ```
    git clone https://github.com/ghadaSaidAhmad/pizza-order.git
    ```


2. cd pizza-order/laradock 

    ```
   cd pizza-order/laradock
    ```

3. build inital  container 

    ```
    $ docker-compose up -d apache2 mariadb phpmyadmin
    ```

4. edit your hostes file  \etc\hostes

    ```
    pizza.test
    ```

5. access the main docker workspace bash

    ```
    $winpty docker exec -it laradock_workspace_1 bash

    ``` 
6. migrte database

    ```
    $php artisan migrate 

    ``` 

7. accesss project using pizza.test

8.if you need access phpmyadmin  http://localhost:8888/

    ```
    server:mariadb
    username:root
    password:root 

    ```
    



## Running the tests







