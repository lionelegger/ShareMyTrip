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

The categories can be inserted with: 
```sql
INSERT INTO `categories` (`id`, `name`) 
VALUES  (1, 'Travel'), 
        (2, 'Lodging'), 
        (3, 'Activity'), 
        (4, 'Other');
```

The types can be inserted with: 
```sql
INSERT INTO `types` (`id`, `name`, `category_id`) 
    VALUES  (NULL, 'Plane', '1'), 
            (NULL, 'Train', '1'), 
            (NULL, 'Taxi', '1'), 
            (NULL, 'Car', '1'), 
            (NULL, 'Boat', '1'), 
            (NULL, 'Bicycle', '1'), 
            (NULL, 'Foot', '1'), 
            (NULL, 'Other transportation', '1'), 
            (NULL, 'Hotel', '2'), 
            (NULL, 'Bed & Breakfast', '2'), 
            (NULL, 'Camping', '2'), 
            (NULL, 'Other lodging', '2'), 
            (NULL, 'Restaurant', '3'), 
            (NULL, 'Shopping', '3'), 
            (NULL, 'Museum', '3'), 
            (NULL, 'Tour', '3'), 
            (NULL, 'Concert/Theatre', '3'), 
            (NULL, 'Other activity', '3'), 
            (NULL, 'Bank Withdrawal', '4'),
            (NULL, 'Other expenses', '4'),  
            (NULL, 'Any other action', '4');
```

The methods can be inserted with: 
```sql
INSERT INTO `methods` (`id`, `name`) 
VALUES  (NULL, 'Cash'), 
        (NULL, 'Bank transfert'), 
        (NULL, 'Credit card'), 
        (NULL, 'ATM'),
        (NULL, 'Paypal');
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
bin/cake bake all Departures
bin/cake bake all Arrivals
bin/cake bake all Categories
bin/cake bake all Types
bin/cake bake all Trips
bin/cake bake all Methods
bin/cake bake all Payments
bin/cake bake all Participations
bin/cake bake all Actions
```


