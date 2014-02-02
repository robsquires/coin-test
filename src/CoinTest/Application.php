<?php

namespace CoinTest;

use Silex\Application as SilexApplication;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\TranslationServiceProvider;
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

        $app->register(new FormServiceProvider()); //used to build forms

        $app->register(new TwigServiceProvider(), [ 
            'twig.path' => __DIR__.'/views',
        ]);

        $app->register(new TranslationServiceProvider(), [
            'locale_fallbacks' => ['en'],
        ]);


        // Routing
        $this->get('/', function () use ( $app ) {


            $data = [ 'amount' => 'Please enter an amount in pence'];

            //building the form
            $form = $app['form.factory']
                ->createBuilder('form', $data)
                ->add('amount', 'text') //adding the 'amount' text field
                ->getForm()
            ;
            //rendering and returning the HTML back to the application
            return $app['twig']
                ->render(
                    'index.html.twig',
                    ['form' => $form->createView()]
                )
            ;
        });
    }
}