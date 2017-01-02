# ShareMyTrip 
made by [Lionel EGGER](mailto:lionelegger@gmail.com)

##Server PHP
Installation of MAMP with phpMyAdmin (that administrates mySQL)
NB: Be sure that environment variable points to the the right MAMP version

## Creation of CakePHP Application Skeleton

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.x.
The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

### Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`:
A. In shell, go to the directory where you want to install composer
B. run the following instructions:
```sql
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
```
2. Run `php composer.phar create-project --prefer-dist cakephp/app ShareMyTrip`.

You should now be able to visit the path to where you installed the app and see the setup traffic lights.

### Configuration
Edition of `config/app.php` and setup the 'Datasources' and any other configuration relevant for the application:
- username: ‘root’
- password: ‘root’
- database: ‘ShareMyTrip’


## creation of ShareMyTrip DATABASE
Creation of a DATABASE called 'ShareMyTrip' in phpMyAdmin
The relational design of the ShareMyTrip database has been created with [MySQL Workbench](http://dev.mysql.com/downloads/workbench/):
- [mwb](/db/ShareMyTrip.mwb) contains the whole database made with MySQL Workbench program (editable file)
- [sql](/db/ShareMyTrip.sql) contains the sql code to create the database in PhpMyAdmin (copy/paste)
- [pdf](/db/ShareMyTrip.pdf) contains a static image of the database

Once the database created in phpMyAdmin by copy/pasting the sql requests, all traffic lights are green when accessing the [http://localhost:8888](http://localhost:8888/).

The categories, types and methods entries can be inserted with: 
```sql
INSERT INTO `categories` (`id`, `name`) 
VALUES  (1, 'Travel'), 
        (2, 'Lodging'), 
        (3, 'Activity'), 
        (4, 'Other');

INSERT INTO `types` (`id`, `name`, `category_id`) 
    VALUES  (1, 'Plane', '1'), 
            (2, 'Train', '1'), 
            (3, 'Taxi', '1'), 
            (4, 'Car', '1'), 
            (5, 'Boat', '1'), 
            (6, 'Bicycle', '1'), 
            (7, 'Foot', '1'), 
            (8, 'Other transportation', '1'), 
            (9, 'Hotel', '2'), 
            (10, 'Bed & Breakfast', '2'), 
            (11, 'Camping', '2'), 
            (12, 'Other lodging', '2'), 
            (13, 'Restaurant', '3'), 
            (14, 'Shopping', '3'), 
            (15, 'Museum', '3'), 
            (16, 'Tour', '3'), 
            (17, 'Concert/Theatre', '3'), 
            (18, 'Other activity', '3'), 
            (19, 'Bank Withdrawal', '4'),
            (20, 'Other expenses', '4'),  
            (21, 'Any other action', '4');

INSERT INTO `methods` (`id`, `name`) 
VALUES  (1, 'Cash'), 
        (2, 'Bank transfert'), 
        (3, 'Credit card'), 
        (4, 'ATM'),
        (5, 'Paypal');
```

## CAKEPHP 3

### Generation of all tables with CakePhp

Before using bake command, install it with Composer (run where composer has been installed):
```sh
composer require --dev cakephp/bake:~1.0
```

Then, in shell, run the following instructions.
```sh
bin/cake bake all Users
bin/cake bake all Trips
bin/cake bake all TripsUsers
bin/cake bake all Categories
bin/cake bake all Types
bin/cake bake all Trips
bin/cake bake all Methods
bin/cake bake all Payments
bin/cake bake all Participations
bin/cake bake all Actions
```

### Creating RESTful Routes
[CAKEPHP documentation](http://book.cakephp.org/3.0/en/development/routing.html#resource-routes)

In *config/routes.php*:
```php
Router::scope('/', function ($routes) {
    $routes->extensions(['json']);
});
```

### CakePHP [USERS controller](/src/Controller/Component/UsersController.php):

* function login() : Log in a user and redirects to homepage
* function logout() : Log out a user and redirects to homepage
* function current() : Gets the current user logged
