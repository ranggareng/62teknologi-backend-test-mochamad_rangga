# API Businesses
Tech Stack : Laravel 8.*

## Description
Aplikasi ini dibuat berdasarkan referensi dari API yang disediakan oleh *yelp*, segala macam dokumentasi terkait API yang dibuat pada sistem ini bisa melihat file 62 Teknologi.postman_collection.json

## Getting started
### Dependencies
- Composer
- NPM
- NodeJs
- PHP >= 7.4
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Mysql 8 atau MariaDB setingkat

### Installing
- Prepare The Environment dengan cara copy .env.example ke .env
- Setup database configuration
- Install Composer Dependencies
```
composer install
```
- Generate key application
```
php artisan key:generate
```
- Run Database Migration and Seed
```
php artisan migration --seed
```

### Executing Program
- Run Laravel Server
```
php artisan serve
```