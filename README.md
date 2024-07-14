## Run flow

```shell
git clone git@github.com:o2relax/hicaliber.git folder
cd folder
composer install
php artisan sail:install # for modify .env
#or set .env DB_DATABASE=laravel DB_USERNAME=sail DB_PASSWORD=password
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail npm i 
./vendor/bin/sail npm run dev # or build
```
