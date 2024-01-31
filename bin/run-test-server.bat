set MYPDO_ENV=test
set APP_DIR=%cd%
php -d display_errors -d auto_prepend_file=%cd%\vendor\autoload.php -S localhost:8080 -t public/
