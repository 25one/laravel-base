<b>1.В каталоге, доступном из web (var/www или ваш вариант настройки), выполните следующие команды:</b>
<br>git clone https://github.com/25one/laravel-base.git 
<br>cd laravel-base
<br>rm -rf .git
<br>sudo chmod -R 777 storage
<br>sudo chmod -R 777 bootstrap/cache
<br><br>
<b>2.В файле config/database.php(в секции mysql) откорректируйте следующие строки настроек доступа к mysql(host, database, username, password) на свои параметры подключения к mysql:</b>
    <br>...
    <br>'host' => env('DB_HOST', '127.0.0.1'),
    <br>...
    <br>'database' => env('DB_DATABASE', 'laravel'),
    <br>'username' => env('DB_USERNAME', 'root'),
    <br>'password' => env('DB_PASSWORD', 'password'),
    <br>...
<br>В файле .env(в секции mysql) откорректируйте следующие строки настроек доступа к mysql(host, database, username, password) на свои параметры подключения к mysql:</b>
    <br>...
    <br>DB_HOST=127.0.0.1
    <br>...
    <br>DB_DATABASE=laravel
    <br>DB_USERNAME=root
    <br>DB_PASSWORD=password
    <br>..
<br><br>
<b>3.Запустите миграции для формирования таблиц бд(!обязательно после выполнения п.2):</b> 
<br>php artisan migrate    
<br><br>
<b>4.Запуск laravel-приложения(как пример по-умолчанию запускается приложение house):</b>
<br>laravel-base/public/house 
