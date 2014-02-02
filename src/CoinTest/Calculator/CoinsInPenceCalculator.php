<?php

namespace CoinTest\Calculator;

use CoinTest\Bank\SterlingBank;

class CoinsInPenceCalculator
{
    /**
     * @param CoinTest\Bank\SterlingBank $bank
     */
    protected $bank;

    public function __construct(SterlingBank $bank)
    {
        $this->bank = $bank;
    }

    public function calculate($amount)
    {
        $coins = [];

        $remainingAmount = $amount;

        foreach($this->bank->getCoinValues() as $designation => $value){

            $coin = [ 'designation' => $designation ];

            $numberCoins = floor( $remainingAmount / $value); //always floor as we're interested in whole coins only
            //var_dump($remainingAmount, $designation, $value, $numberCoins);
            if($numberCoins > 0){
                $remainingAmount =  $remainingAmount % $value;
            }
            $coin['count'] = (integer) $numberCoins; //makes sense for the count to be an integer
          
            $coins[] = $coin;
        }

        return $coins;
    }

}
