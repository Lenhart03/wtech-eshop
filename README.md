# Instructions

1. Clone repository
```
git clone https://github.com/Lenhart03/wtech-eshop
```

2. Get vendor for laravel. Copy it from somewhere or run:
```
composer install
```

3. Set up database server

4. Set up .env file ([example](https://github.com/laravel/laravel/blob/master/.env.example))
   - Set up database connection example:
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=wtech_eshop
DB_USERNAME=root
DB_PASSWORD=a1b2c3d4
```

5. Generate key
```
php artisan key:generate
```

6. Link the storage
```
php artisan storage:link
```

7. Run migrations
```
php artisan migrate
```

8. Run npm installation
```
npm install
```

9. Run following command in parallel terminal
```
npm run dev
```