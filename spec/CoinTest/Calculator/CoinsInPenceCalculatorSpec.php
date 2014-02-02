<?php

namespace spec\CoinTest\Calculator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CoinsInPenceCalculatorSpec extends ObjectBehavior
{
    
    /**
     * @param CoinTest\Bank\SterlingBank $bank
     */
    function let($bank)
    {
        $this->beConstructedWith($bank);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CoinTest\Calculator\CoinsInPenceCalculator');
    }

    function it_should_find_the_number_of_coins_when_only_the_first_coin_is_required($bank)
    {
        $bank->getCoinValues()->willReturn(['£1' => 100, '50p' => 50 ]);

        $this->calculate(100)->shouldReturn([
            ['designation' => '£1',  'count' => 1],
            ['designation' => '50p', 'count' => 0]
        ]);
    }

    function it_should_find_the_number_of_coins_when_only_the_last_coin_is_required($bank)
    {
        $bank->getCoinValues()->willReturn(['£1' => 100, '50p' => 50, '20p' => 20 ]);

        $this->calculate(40)->shouldReturn([
            ['designation' => '£1',  'count' => 0],
            ['designation' => '50p', 'count' => 0],
            ['designation' => '20p', 'count' => 2]
        ]);
    }

    function it_should_find_the_number_of_coins_when_all_coins_are_required($bank)
    {
        $bank->getCoinValues()->willReturn(['£1' => 100, '50p' => 50, '20p' => 20 ]);

        $this->calculate(290)->shouldReturn([
            ['designation' => '£1',  'count' => 2],
            ['designation' => '50p', 'count' => 1],
            ['designation' => '20p', 'count' => 2]
        ]);
    }

    function it_should_deal_with_not_finding_any_coins_that_match($bank)
    {
        $bank->getCoinValues()->willReturn(['£1' => 100, '50p' => 50, '20p' => 20 ]);

        $this->calculate(5)->shouldReturn([
            ['designation' => '£1',  'count' => 0],
            ['designation' => '50p', 'count' => 0],
            ['designation' => '20p', 'count' => 0]
        ]);
    }
}
