<?php

namespace CoinTest\Converter;

class ToPenceConverter
{

    /**
     * convert
     * 
     * converts an monetary amount to pence
     * 
     * @param (string) $amount monetary amount
     * @return (integer) the value in pence
     */
    public function convert($amount)
    {
        $matches = [];
        var_dump($amount);
        preg_match('/(\d+)\.?(\d+)?/', $amount, $matches);

        if(count($matches) > 2){ //must have found a decimal

        }
        var_Dump($matches);
        return (integer) $matches[0];
    }
}
