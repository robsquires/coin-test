Feature: User requests number of pence for a given amount


    Scenario: A user can visit the homepage
         When I go to the homepage
         Then I should see text matching "Coin Test"


    Scenario Outline: The application should display an error when invalid input is provided
        Given I am on the homepage
         When fill in "form_amount" with "<value>"
         When I press "Submit"
         Then I should see "<message>"

         Examples:
            | value | message                                                 |
            |       | This value should not be blank.                         |
            | £p    | Your amount should contain at least one numeric digit   |
