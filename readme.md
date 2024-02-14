# Laravel e-commerce website

This is a dockerized Laravel application.

## Getting Started

To get started with this project, follow the steps below, before hand setup the copy .env.example to the same directory named .env and setup acordingly:
```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel-ecommerce
    DB_USERNAME=root
    DB_PASSWORD=root
```

1. Build the Docker container by running the following command:
    ```
    docker-compose up -d --build
    ```

2. Access the container by running the following command:
    ```
    docker exec -it app_laravel-ecommerce bash
    ```

3. Set the appropriate permissions by running the following command:
    ```
    chmod 777 -R storage/
    ```

4. Use command:
    ```
    php artisan migrate --seed
    ```

5. Navigate to the site with default products and images:
    [http://localhost:8000](http://localhost:8000)

## Usage

Once the container is up and running, you can start using the Laravel application.

## Contributing

Contributions are welcome! Please follow the guidelines outlined in the CONTRIBUTING.md file.

## License