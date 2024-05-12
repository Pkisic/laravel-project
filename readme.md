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

## Known errors
- Handle ngnix service not starting

In my case the git repository had an entry point script with Unix line endings (\n). But when the repository was checked out on a windows machine, git decided to try and be clever and replace the line endings in the files with windows line endings (\r\n).

This meant that the shebang didn't work because instead of looking for /bin/bash, it was looking for /bin/bash\r.

The solution for me was to disable git's automatic conversion:
```
git config --global core.autocrlf input
```
Reset the repo using this (don't forget to save your changes):
```
git rm --cached -r .
git reset --hard
```
And then rebuild.

-  No application encryption key has been specified. 

Run the command
```
php artisan key:generate
```

## Usage

To manage the platform, go to admin page [http://localhost:8000/admin](http://localhost:8000/admin)

Type 
```
admin@admin.com
``` 
as email and 
```
admin
``` 
as password
## Contributing

Contributions are welcome! Please follow the guidelines outlined in the CONTRIBUTING.md file.

## License