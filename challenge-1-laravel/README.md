# Task Result

## Used Technologies / Frameworks
I use the following technologies / frameworks in my project:

- PHP / Laravel

I chose Laravel because it provides an excellent library that allows to work
with Excel, and also the Eloquent library works excellent to work with databases.

## Used 3rd Party Libraries
Name | Reason
--- | ---
[laravel-excel](https://laravel-excel.com/) | For processing Excel files like CSV.
[Bootstrap](https://getbootstrap.com/) | Simple RWD framework for designing the front end.

## Installation / Run
The following components must be installed locally:
- [nodejs](https://nodejs.org/en/) v13.2.0
- [composer](https://getcomposer.org/download/)  v2.3.3

First of all, to create the database open phpMyAdmin and go to SQL and type:
`
create db if not exists code_challenge;
use code_challenge;
`

Now you have to add the .env file provided in the .env.zip to the root folder. It's very important that the file contains this data:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=code_challenge
DB_USERNAME=root
DB_PASSWORD=
```

To run the project locally, on the command line, go to the root directory of the project and enter the command:

```
composer update
php artisan migrate:fresh --seed
php artisan serve
```

Now you can open your browser and type [http://127.0.0.1:8000/](http://127.0.0.1:8000/), which is the local server provided by laravel

