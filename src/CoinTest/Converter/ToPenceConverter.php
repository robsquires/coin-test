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
        if(
            preg_match('/^£((?!\.).)*$/', $amount ) ||
            preg_match('/^£\d+\.p$/', $amount ) //given the time using a seperate regex here
        ) {
            $poundsToPence = 100;
        }

        preg_match('/(\d+)\.?(\d\d)?(\d)?/', $amount, $matches);

        $pence = $matches[1];
        if(count($matches) > 2){ //must have found a decimal
            $pence = $matches[1] . $matches[2];
        }

        //found a 3rd decimal point so rounding to nearest whole pence
        if(isset($matches[3])){
            if($matches[3] >= 5){
                $pence++;
            }

        }

        return (integer) ($pence * $poundsToPence);
    }
}
