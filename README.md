# Doc

## Installation guide

### Install dependencies

```bash
git clone https://github.com/Codeshaper-bd/dashcode-laravel.git
cd dashcode-laravel
cp .env.example .env
# If you are using api make IS_API_PROJECT=true in env file
composer install
php artisan key:generate
php artisan blueprint:build
php artisan migrate
php artisan db:seed
# if public/storage folder is present in public folder then remove it.
php artisan storage:link
npm install
```
