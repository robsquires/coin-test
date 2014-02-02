<?php

namespace CoinTest\Controller;

use CoinTest\Application;
use CoinTest\Converter\ToPenceConverter as Converter;
use CoinTest\Calculator\CoinsInPenceCalculator as Calculator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class FormController
{

    /**
     * @var CoinTest\Application the coin-test application
     **/
    private $app;

    /**
     * @var  CoinTest\Converter\ToPenceConverter
     */
    private $converter;

    /**
     * @var  CoinTest\Calculator\CoinsInPenceCalculator
     */
    private $calculator;


    public function __construct(Application $app, Converter $converter, Calculator $calculator)
    {
        $this->app = $app;
        $this->converter = $converter;
        $this->calculator = $calculator;
    }

    public function indexAction(Request $request)
    {
        $app = $this->app;
        //building the form
        //could move this out of the controller
        $form = $app['form.factory']
            ->createBuilder('form')
            ->add('amount', 'text', [
                'constraints' => [
                    new Assert\NotBlank(), //validating 'empty string'
                    new Assert\Regex([ // validating 'missing digits'
                         'pattern'     => '/[0-9]/',
                         'message' => 'Your amount should contain at least one numeric digit'
                    ]),
                    new Assert\Regex([ // validating 'non-numeric characters'
                         'pattern'     => '/^[0-9 £.p]+$/',
                         'message' => 'Your amount should not contain non-numeric characters'
                    ])
                ]
            ]) //adding the 'amount' text field
            ->getForm()
        ;
        
        //parse user input
        $form->handleRequest($request);

        /**
         * initialising view variables
         */
        $viewVars = [
            'form' => $form->createView(),
            'coins' => []
        ];


        /**
         * processing user input if data is valid
         */
        if($form->isValid()){

            //get user input
            $data = $form->getData();
            $amount = $data['amount'];

            //convert to pence
            $penceAmount = $this->converter->convert($amount);

            //count the number of coins
            $coins = $this->calculator->calculate($penceAmount);

            //assign coins to the view
            $viewVars['coins'] = $coins;
        }


        //rendering and returning the HTML back to the application
        return $app['twig']
            ->render(
                'index.html.twig',
                $viewVars
            )
        ;
    }
}