# Women in Business Portal
<p align="center"><img src="https://portal.womeninbusiness-network.com/images/logo.png" width="150"></p>


## About Women in Business Portal

The portal is a web application designed as a networking platform for business women in the MENA region. The platform is built using:

- [Laravel 8.x](https://laravel.com/docs/8.x)
- [Semantic UI 2.4](https://semantic-ui.com/)


## Contributing

Thank you for considering contributing to the platform! To contribute, please email the developer @ [haytham.mones@gmail.com](mailto:haytham.mones@gmail.com).


## Security Vulnerabilities

If you discover a security vulnerability within the platform, please send an e-mail to Haytham Mones via [haytham.mones@gmail.com](mailto:haytham.mones@gmail.com). All security vulnerabilities will be promptly addressed.

## Setting up the project for local development
1. Clone the repository into your local machine
2. Install PHP8.0 and composer into your local machine. Make sure to install the gd and zip extensions for php by running `sudo apt install php8.0-gd php8.0-zip`
3. If you have a higher version of php on your machine, you can downgrade and select php8.0 by following this article: https://blog.devops.dev/downgrade-php8-1-to-php8-0-or-php7-4-on-ubuntu-22-04-2fab4a6a3be3
4. Run `composer install` to install all dependencies
5. Add a local configuration by copying the `.env.example` file to `.env` and modifying the content. Make sure to name the database which will be created on first run of sail
6. Run `./vendor/bin/sail` to build the docker images for the application
7. If there's an issue with folder permissions, you can run this command `docker compose exec laravel.test chmod -R 777 storage/framework` and `docker compose exec laravel.test chmod -R 777 storage/logs`
8. Create the application key by running `./vendor/bin/sail artisan key:generate`
9. Run the migrations from within the application container by running the command `./vendor/bin/sail artisan migrate:fresh --seed`
10. To create a new user for backend, you can visit `php artisan tinker` then create a user of the `Admin` model
