# API Businesses
Tech Stack : Laravel 8.*

## Description
Aplikasi ini merupakan aplikasi untuk mengelola data business, pengerjaan aplikasi ini menggunakan referensi dari ***yelp***. Aplikasi ini digunakan untuk keperluan technical test disalah satu perusahaan.

Aplikasi ini memiliki 5 endpoint yang terdiri dari:
- Endpoint POST /auth/token untuk mendapatkan token yang akan digunakan untuk memanggil semua api business
- Endpoint POST /business untuk menambahkan data business
- Endpoint POST /business/{id atau alias} untuk merubah data business ( ***Important Notice:*** pastikan mengirim params _method=PUT)
- Endpoint DELETE /business/{id atau alias} untuk menghapus data business serta segala relasinya
- Endpoint GET /business untuk melakukan pencarian data business

Untuk bermain dengan API yang dibuat oleh aplikasi ini, silahkan menggunakan postman dan import collection **62_Teknologi.postman_collection.json**

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