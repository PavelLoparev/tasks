<?php

/**
 * @file
 * Bottle tests.
 */

namespace BottleTests;

use PHPUnit\Framework\TestCase;
use Bottle\Task;

/**
 * BottleTest class.
 */
class BottleTest extends TestCase
{

  /**
   * Test bottle without a hole.
   *
   * Flat bottom.
   *
   * @code
   *  00000
   *  00000
   *  00000
   *  00000
   *  00000
   * @endcode
   */
  public function testNoBottom()
  {
    $bottle = new Task([
      0,
      0,
      0,
      0,
      0,
    ], 5);

    $this->assertEquals($bottle->getResult(), 25);
  }

  /**
   * Test bottle without a hole.
   *
   * Bottom height equals waterline.
   *
   * @code
   *  11111
   *  11111
   *  11111
   *  11111
   *  11111
   * @endcode
   */
  public function testBottomEqualsWaterLine()
  {
    $bottle = new Task([
      5,
      5,
      5,
      5,
      5,
    ], 5);

    $this->assertEquals($bottle->getResult(), 0);
  }

  /**
   * Test bottle without a hole.
   *
   * Rough bottom. Highest bottom line is not higher than waterline.
   *
   * @code
   *  0000000
   *  0000100
   *  0000100
   *  0010111
   *  1111111
   * @endcode
   */
  public function testRoughLowBottom()
  {
    $bottle = new Task([
      1,
      1,
      2,
      1,
      4,
      2,
      2,
    ], 5);

    $this->assertEquals($bottle->getResult(), 22);
  }

  /**
   * Test bottle without a hole.
   *
   * Rough bottom. Highest bottom line is higher than waterline.
   *
   * @code
   *      1
   *      1
   *  0000100
   *  0000100
   *  0000100
   *  0010111
   *  1111111
   * @endcode
   */
  public function testRoughHighBottom()
  {
    $bottle = new Task([
      1,
      1,
      2,
      1,
      7,
      2,
      2,
    ], 5);

    $this->assertEquals($bottle->getResult(), 21);
  }

}
