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

        preg_match('/(\d+)\.?(\d+)?/', $amount, $matches);
        
        $pounds = '';
        $pence = $matches[1];
        
        if(count($matches) == 3){ //must have found a decimal
            $pounds = $matches[1];
            $pence = $matches[2];
        }

        return (integer) ($pounds . $pence);
    }
}
