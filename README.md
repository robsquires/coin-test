#BBC Coin Algorithm Test

**Hours 1 + 2**

created basic Silex application, added behat features, implemented Form and validation rules

**Hours 3 + 4**

implemented business logic

**5th hour**

added twitter bootstrap, deployed to AWS


##Application requirements

1. PHP 5.4 (tested on 5.5)

2. `intl` extension (+ `curl` if you want to run the feature suite)

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

1. Wrap form validation into a custom validator - I'd then be able to unit test it

2. The application's understanding of `£` `.` and `p` isnt very DRY - would consider reworking how these symbols are fed into validation + the `toPenceConverter`

3. Tidy up theme - use twig's `form_row` method to output the form elements, this way twitter bootstrap will be completely implemented
