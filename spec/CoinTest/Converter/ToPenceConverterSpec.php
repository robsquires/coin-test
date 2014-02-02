<?php

namespace spec\CoinTest\Converter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ToPenceConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CoinTest\Converter\ToPenceConverter');
    }


    function it_should_convert_numerical_strings_to_pence()
    {
        $io = [4 => 4, 85 => 85];

        foreach($io as $input => $output){
            $this->convert($input)->shouldReturn($output);
        }
    }



}
