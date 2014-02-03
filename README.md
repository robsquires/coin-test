#BBC Coin Algorithm Test

First 2 hours - building application skeleton

3 + 4th hour - implementing business logic

5th hour - deployment


##Application requirements

1. PHP 5.4 (tested on 5.5)

2. Composer

3. Rake (optional)


##Installation instructions

1. `composer install` to install dependancies

2. `rake` to install vhost and configure /etc/hosts

(Nginx vhost can be installed manually replacing APP_PATH, APP_NAME with appropriate values)


##Running tests

1. `bin/behat` to run feature suite

2. `bin/phpspec run -f pretty` to run unit tests


##Given more time

1. Inject the `SterlingBank` with it's coin config - this is currently inititiated in the constructor

2. Move the form construction out of the controller

3. Tidy up the theme - create a layout and inject the form view only

4. Improve the user interface