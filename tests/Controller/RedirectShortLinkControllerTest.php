<?php

namespace Drupal\custom_short_links\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the custom_short_links module.
 */
class RedirectShortLinkControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "custom_short_links RedirectShortLinkController's controller functionality",
      'description' => 'Test Unit for module custom_short_links and controller RedirectShortLinkController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests custom_short_links functionality.
   */
  public function testRedirectShortLinkController() {
    // Check that the basic functions of module custom_short_links.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
