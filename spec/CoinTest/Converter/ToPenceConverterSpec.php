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
        $this->assertConvertBehaviour([ 
            4 => 4,
            85 => 85 
        ]);
    }

    function it_should_ignore_the_pence_character()
    {
        $this->assertConvertBehaviour([
            '197p' => 197,
            '2p' => 2
        ]);
    }

    function it_should_take_the_decimal_place_into_account()
    {
        $this->assertConvertBehaviour([
            '1.87' => 187
        ]);
    }

    /**
     * @param $io   input + output values in form [ input => output ]
     */
    protected function assertConvertBehaviour($io)
    {
        foreach($io as $input => $output){
            $this->convert($input)->shouldReturn($output);
        }
    }

}
