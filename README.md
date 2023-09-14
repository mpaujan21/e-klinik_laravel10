Steps:

- ```composer install --ignore-platform-reqs```
- ```cp .env.example .env```
- ```DB_DATABASE=e-klinik``` di file .env
- Buat database e-klinik di phpmyadmin
- ```php artisan migrate```
- ```php artisan db:seed``` 
- ```php artisan serve``` 
- ```admin:password``` 