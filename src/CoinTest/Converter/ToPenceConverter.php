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

        $poundsToPence = 1;

        //if starts with & and doesnt contain a decimal point,
        //we need to convert to pence from pounds
        if(preg_match('/^£((?!\.).)*$/', $amount )) {
            $poundsToPence = 100;
        }

        preg_match('/(\d+)\.?(\d+)?/', $amount, $matches);

        $pence = $matches[1];
        if(count($matches) == 3){ //must have found a decimal
            $pence = $matches[1] . $matches[2];
        }
        var_dump($amount);
        var_Dump($pence);
        var_dump($poundsToPence);



        return (integer) ($pence * $poundsToPence);
    }
}
