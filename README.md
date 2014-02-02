#BBC Coin Algorithm Test

First 2 hours - building application skeleton

3 + 4th hour - implementing business logic

5th hour - deployment


##Application requirements

1. PHP 5.5

2. Composer

3. Rake (optional)


##Installation instructions

1. `composer install` to install dependancies

2. `rake` to install vhost and configure /etc/hosts

(Nginx vhost can be installed manually replacing APP_PATH, APP_NAME with appropriate values)


##Running tests

1. `bin/behat` to run feature suite

2. `bin/phpspec run -f pretty` to run unit tests