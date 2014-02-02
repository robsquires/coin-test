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

    /**
     * calculate
     * 
     * given an amount in pence, calculates the minimum number of whole coins required
     * 
     * @param integer $amount amount in whole pence
     * @return array all the coins in the current bank, with a count of the coins included
     */
    public function calculate($amount)
    {
        $coins = [];

        $remainingAmount = $amount;

        foreach($this->bank->getCoinValues() as $designation => $value){

            $coin = [ 'designation' => $designation ];

            $numberCoins = floor( $remainingAmount / $value); //always floor as we're interested in whole coins only

            if($numberCoins > 0){   //if we've found coins, work out how much is left
                $remainingAmount =  $remainingAmount % $value;
            }
            $coin['count'] = (integer) $numberCoins; //makes sense for the count to be an integer
          
            $coins[] = $coin;
        }

        return $coins;
    }

}
