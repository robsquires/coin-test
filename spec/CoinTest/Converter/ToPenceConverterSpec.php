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

    function it_should_understand_the_decimal_point()
    {
        $this->assertConvertBehaviour([
            '1.87' => 187
        ]);
    }

    function it_should_understand_the_pound_sign()
    {
        $this->assertConvertBehaviour([
            '£2'    => 200,
            '£10'   => 1000
        ]);
    }

    function it_should_understand_how_the_pound_sign_and_decimal_point_behave_together()
    {
        $this->assertConvertBehaviour([
            '£1.23'    => 123
        ]);
    }

    function it_should_ignore_pence_symbol_given_a_pound_or_decimal()
    {
        $this->assertConvertBehaviour([
            '£1.87p'    => 187,
            '£1p'       => 100,
            '£1.p'      => 100
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
