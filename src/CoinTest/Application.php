<?php

namespace CoinTest;

use Silex\Application as SilexApplication;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\TranslationServiceProvider;

use Symfony\Component\Validator\Constraints as Assert;
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

        $app->register(new FormServiceProvider()); //to build forms
        $app->register(new ValidatorServiceProvider()); //to validate form input
        $app->register(new TwigServiceProvider(), [ 
            'twig.path' => __DIR__.'/views',
        ]);

        $app->register(new TranslationServiceProvider(), [
            'locale_fallbacks' => ['en'],
        ]);


        // Routing
        $this->match('/', function (Request $request) use ( $app ) {



            //building the form
            $form = $app['form.factory']
                ->createBuilder('form')
                ->add('amount', 'text', [
                    'constraints' => [ 
                        new Assert\NotBlank(), //validating 'empty string'

                        new Assert\Regex([ // validating 'missing digits'
                             'pattern'     => '/[0-9]/',
                             'message' => 'Your amount should contain at least one numeric digit'
                        ])
                    ]
                ]) //adding the 'amount' text field
                ->getForm()
            ;

            $form->handleRequest($request);


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