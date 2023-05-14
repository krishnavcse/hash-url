# hash-url
You can hash any URL

edit .env.example file and make it as .env change APP_URL and data base setup based on your preference

Eg: APP_URL=http://localhost/User-Authentication/public

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=user-authentication //database name 

DB_USERNAME=root // username 

DB_PASSWORD=password // password

Commands to be executed: 

composer install

php artisan key:generate

php artisan migrate

php artisan optimize:clear


In case of Linux giving required permission: 

sudo chgrp -R www-data /var/www/hash-url

chmod -R 644 /var/www/hash-url

chmod -R +X /var/www/hash-url