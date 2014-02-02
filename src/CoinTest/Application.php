<?php

namespace CoinTest;

use Silex\Application as SilexApplication;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\TranslationServiceProvider;

use CoinTest\Controller\FormController;

/**
 * class Application
 **/
class Application extends SilexApplication
{
    
    
    public function __construct()
    {
        parent::__construct();

        //need '$app' for the closures
        $app = $this;

        $app['debug'] = true;
        $app->register(new ServiceControllerServiceProvider()); //can DI controllers
        $app->register(new FormServiceProvider()); //to build forms
        $app->register(new ValidatorServiceProvider()); //to validate form input
        $app->register(new TwigServiceProvider(), [ 
            'twig.path' => __DIR__.'/views',
        ]);

        $app->register(new TranslationServiceProvider(), [
            'locale_fallbacks' => ['en'],
        ]);

        $app['app.controller.form'] = $app->share(function() use ($app) {
            return new FormController($app);
        });

        // Routing
        $this->match('/', 'app.controller.form:indexAction');
    }
}