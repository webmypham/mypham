## Buil project

 + git clone https://github.com/vanthanh638/shopmypham.git
 + composer install
 + chmod bootstrap/cache, storage

 ## install adminlte
  + php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets
  + composer update jeroennoten/laravel-adminlte