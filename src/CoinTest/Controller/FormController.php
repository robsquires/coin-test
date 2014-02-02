<?php

namespace CoinTest\Controller;

use CoinTest\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class FormController
{

    /**
     * @var CoinTest\Application the coin-test application
     **/
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function indexAction(Request $request)
    {
        $app = $this->app;
        //building the form
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
        $form->handleRequest($request);

        if($form->isValid()){

            $data = $form->getData();
            $amount = $data['amount'];

            var_dump($data);
        }


        //rendering and returning the HTML back to the application
        return $app['twig']
            ->render(
                'index.html.twig',
                ['form' => $form->createView()]
            )
        ;
    }
}