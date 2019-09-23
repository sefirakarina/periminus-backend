# periminus backend

This is a web-based program for customer to buy books, and the admin can organize the books and customers’ orders. JWT authentication is implemented. The deployment was done with Digital Ocean.

## Environment Setup

To run this program, the following things are required:
- PHP 
- Composer
- Any relational DB (ex: MySql/PostgreSql)

After cloning/ downloading the project, go to the project folder (carShareBackend) from cmd/terminal and run these following commands


```bash
composer install
php artisan key:generate
php artisan jwt:secret
```

A database is needed. Create your DB, but don't create any table. The tables will be migrated from the code. 

To do that, you will need a .env file to connect to the db. Just change the .env.example file name in the root directory to .env

In the .env file, complete your DB credentials. Our team uses MySql DB for this project.

```bash
DB_CONNECTION= the DB you use (mysql/pgsql/etc)
DB_HOST=127.0.0.1
DB_PORT= your DB port
DB_DATABASE= your DB name
DB_USERNAME= your DB username
DB_PASSWORD= your DB password
```

After that, run the following command to migrate the DB

```bash
php artisan migrate
```

## Running the Program
To run the program, use the following command

```bash
php artisan serve
```

If the command is successfully running, it will say that the program is running on port 7000 of your localhost. Now you can test the APIs. to see the list of available API use the following command

```bash
php route:list
```
