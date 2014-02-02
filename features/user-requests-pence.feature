Feature: User requests number of pence for a given amount


    Scenario: A user can visit the homepage
         When I go to the homepage
         Then I should see text matching "Coin Test"


    Scenario: The application should display an error when invalid input is provided
        Given I am on the homepage
         When I press "Submit"
         Then I should see "This value should not be blank."

