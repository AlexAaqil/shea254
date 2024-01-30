# Shea.254
Ecommerce website made using Laravel 10

## Installation
1. **Clone the Repository:**
    ```bash
    git clone <repository_url>
    ```
1. **copy the `.env` file:**
    - copy the .env.example and rename it to .env
    - update the database and other configuration settings in the `.env` file
1. **Build the docker containers:**
    ```bash
    docker compose build
    ```
1. **Start the docker containers in detached mode:**
    ```bash
    docker compose up -d
    ```
1. **Execute the laravel_backend container in interactive mode:**
    ```bash
    docker exec -it laravel_backend bash
    ```
1. **While inside the interactive mode in the laravel_backend container, run the following commands:**
    ```bash
    composer install
    ```
    ```bash
    npm install
    ```
    ```bash
    npm run build
    ```
    ```bash
    php artisan key:generate
    ```
     ```bash
    php artisan migrate --seed
    ```
    ```bash
    php artisan cache:clear
    ```
    ```bash
    php artisan storage:link
    ```
1. **Access the laravel application on your browser:**\
    [http://localhost:8000](http://localhost:8000)
1. **Access phpmyadmin on your browser:**\
    [http://localhost:9001](http://localhost:9001)
