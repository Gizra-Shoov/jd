<?php

use Drupal\DrupalExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

class FeatureContext extends MinkContext implements SnippetAcceptingContext {

  /**
   * @Given I am an anonymous user
   */
  public function iAmAnAnonymousUser() {
    // Just let this pass-through.
  }

  /**
   * @When I visit the homepage
   */
  public function iVisitTheHomepage() {
    $this->getSession()->visit($this->locatePath('/'));
  }

  /**
   * @Then I should have access to the page
   */
  public function iShouldHaveAccessToThePage() {
    $this->assertSession()->statusCodeEquals('200');
  }

  /**
   * @Then I should not have access to the page
   */
  public function iShouldNotHaveAccessToThePage() {
    $this->assertSession()->statusCodeEquals('403');
  }


  /**
   * @When I visit the item page
   */
  public function iVisitTheItemPage() {
    $this->getSession()->visit('http://item.jd.com/1082263.html');
  }

  /**
   * @When I click on add to cart button
   */
  public function iClickOnAddToCartButton() {
    $page = $this->getSession()->getPage();
    $add_to_cart_button = $page->find('css', '#InitCartUrl');
    $add_to_cart_button->click();
  }

  /**
   * @Then I should see :arg1 item in my cart
   */
  public function iShouldSeeItemInMyCart($items) {
    $page = $this->getSession()->getPage();
    $number_of_items = $page->find('css', '#shopping-amount');
    $number_of_items->click();
    $number_of_items = $page->find('css', '#shopping-amount')->getText();
    if ($number_of_items == $items) {
      print_r("you have " . $number_of_items . " in the cart");
    }
    else {
      throw new \Exception(sprintf("You do not have the same items like you expect"));
    }

  }
}
