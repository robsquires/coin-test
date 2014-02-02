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

            
            if($remainingAmount == 0 ){//if nothing left will continue to loop through all designations
                $coin['count'] = 0;

            }else{ //otherwise work how how many coins and work to the remainder
                $coin['count'] = (integer) $remainingAmount / $value;
                $remainingAmount =  $amount % $value;
            }
            $coins[] = $coin;
        }

        return $coins;
    }

}
