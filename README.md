
git clone 

cd 

composer update

composer require laravel/ui
php artisan ui vue --auth
composer require laravel/passport


php artisan make:model Order -m
php artisan make:model UserCart -m
php artisan make:model OrderItem -m

...

php artisan make:factory OrderFactory
php artisan make:seeder UserCartSeeder
php artisan make:seeder OrderItemSeeder

php artisan migrate

php artisan db:seed



Setting Passport:

in app/Models/User.php, app/Providers/AuthServiceProvider.php, config/auth.php, routes/api.php
