<?php

namespace Drupal\Tests\sailor\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Tests for the Sailor theme file.
 *
 * @group sailor
 */
class SailorThemeTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    require_once __DIR__ . '/../../../sailor.theme';
    return parent::setUp();
  }

  /**
   * Test the footer region.
   */
  public function testFooterRegions() {
    $regions = sailor_footer_regions();

    $this->assertInternalType('array', $regions);

    $expected = [
      'footer_first',
      'footer_second',
      'footer_third',
      'footer_fourth',
      'footer_copy',
    ];
    $this->assertArrayEquals($expected, $regions);
  }

}
