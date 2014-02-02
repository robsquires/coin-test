<?php

namespace CoinTest\Bank;

class SterlingBank
{

    /**
     * @var array currency configuration
     */
    protected $config;

    public function __construct()
    {
        $this->config = [
            '£2'     => 200,
            '£1'     => 100,
            '50p'    => 50,
            '20p'    => 20,
            '2p'     => 2,
            '1p'     => 1
        ];
    }

    public function getCoinValues()
    {
        return $this->config;
    }
}
