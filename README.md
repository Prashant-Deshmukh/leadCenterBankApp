1. git clone https://github.com/Prashant-Deshmukh/leadCenterBankApp.git

2. composer install

3. Create a .env file and copy the content of .env.example into newly created .env.

4. Open the .env file in a text editor and configure your database settings. You will need to set values for DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD.

(Adding sample DB configuration)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leadCenterBank
DB_USERNAME=root
DB_PASSWORD=mysqlDocker

5. Generate a unique key by running: php artisan key:generate

6. php artisan migrate

7. php artisan serve (http://127.0.0.1:8000/)
