## About The Project
Back-end, MIS of the DeTechnologies website, which is a website for a company that provides services in the field of web and information technology. This project is built using Laravel framework and MySQL database. This project consists of APIs for the front and back end.


## prerequisite
This project uses the version of PHP version (8.0) and Laravel framework (9.19).

## Usage

1. Clone the repo

    ```sh
    git clone https://github.com/imhamad/mis-backend.git
    ```

2. update env file and change the database credentials, database is located inside the database folder, which will be updated time to time.

    ```sh
    cp .env.example .env
    ```

3. install composer packages

    ```sh
    composer install
    ```

4. generate key

    ```sh
    php artisan key:generate
    ```

5. migrate database

    ```sh
    php artisan migrate
    ```

6. start server

    ```sh
    php artisan serve
    ```

7. access website at

    ```sh
    http://127.0.0.1:8000
    ```

## Built With

-   [Laravel](https://laravel.com)

## SMTP
- 
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.hostinger.com
  MAIL_PORT=465
  MAIL_USERNAME=notification@deknows.com
  MAIL_PASSWORD=Dev@Doe123
  MAIL_ENCRYPTION=ssl
  MAIL_FROM_ADDRESS=notification@deknows.com
  MAIL_FROM_NAME="${APP_NAME}"

## Keep in mind

Never delete the public/images folder on the cpanel
