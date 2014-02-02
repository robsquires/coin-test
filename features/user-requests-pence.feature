Feature: User requests number of pence for a given amount


    Scenario: An input field can be used to enter the number of pennies
        When I go to the homepage
         Then I should see text matching "Coin Test"
          And the "form_amount" field should contain "Please enter an amount in pence"


    Scenario: The application should display an error when invalid input is provided
        Given I am on the homepage
         When I press "Submit"
         Then I should see "Sorry, please enter a valid amount"

