<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Then /^I should see the coins:$/
     */
    public function iShouldSeeTheCoins(TableNode $table)
    {   
        $coinEls = $this
            ->getSession()
            ->getPage()
            ->findAll('css', '.coin')
        ;

        $actual = [];
        foreach($coinEls as $el){
            $coin = $el->find('css','.designation')->getText();
            $count = $el->find('css', '.count')->getText();
            $actual[$coin] = $count;
        }

        foreach($table->getHash() as $coinData){
            $coin = $coinData['coin'];
            $desiredCount = $coinData['count'];
            $actualCount = $actual[$coin];

            if( $actualCount != $desiredCount){
                throw new \Exception(
                    sprintf(
                        'Error with coin %s : Expected %s, found %s',
                        $coin,
                        $desiredCount,
                        $actualCount
                    )
                );
            }
        }
    }
}
