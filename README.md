# Doc

## Installation guide

```bash
git clone https://github.com/iqbaliamal/technical-test-jarivis.git
cd technical-test-jarivis
cp .env.example .env
# setup your database
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```
