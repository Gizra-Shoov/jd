Feature: Homepage
  In order to be able to view and get info about the site
  As an anonymous user
  We need to be able to have access to the homepage

  @javascript
  Scenario: Visit the homepage
    Given I am an anonymous user
    When  I visit the item page
    And   I click on add to cart button
    Then  I should see 1 item in my cart
