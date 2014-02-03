Feature: User requests number of pence for a given amount

    Background:
        Given I am on the homepage

    Scenario: A user can visit the homepage
         Then I should see text matching "Coin Test"
          And I should see text matching "Enter an monetary amount above - for example £1.50"


    Scenario Outline: The application should display an error when invalid input is provided
         When fill in "form_amount" with "<value>"
         When I press "Submit"
         Then I should see "<message>"

         Examples:
            | value  | message                                                 |
            |        | This value should not be blank.                         |
            | £p     | Your amount should contain at least one numeric digit   |
            | 1x     | Your amount should not contain non-numeric characters   |
            | £1x.0p | Your amount should not contain non-numeric characters   |

    Scenario: The application should return the combination of coins for the amount provided
        Given fill in "form_amount" with "4"
         When I press "Submit"
         Then I should see the coins:
            | coin | count  |
            | £2   | 0      |
            | £1   | 0      |
            | 50p  | 0      |
            | 20p  | 0      |
            | 2p   | 2      |
            | 1p   | 0      |
