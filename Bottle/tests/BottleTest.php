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
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
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
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
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
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
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
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
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

  /**
   * Test bottle with a hole.
   *
   * Flat bottom.
   *
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
   *
   * @code
   *  00000
   *  00000
   *  00000
   *  00000
   *  00200
   * @endcode
   */
  public function testNoBottomHole() {
    $bottle = new Task([
      0,
      0,
      0,
      0,
      0,
    ], 5, 2);

    $this->assertEquals($bottle->getResult(), 0);
  }

  /**
   * Test bottle with a hole.
   *
   * Rough bottom. Highest bottom line is not higher than waterline.
   *
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
   *
   * @code
   *  00000000000000
   *  00010000010000
   *  00110000010010
   *  00110100011011
   *  00111100011011
   *  11111100011111
   *  11111111211111
   * @endcode
   */
  public function testRoughBottomLowHole()
  {
    $bottle = new Task([
      2,
      2,
      5,
      6,
      3,
      4,
      1,
      1,
      0,
      6,
      4,
      2,
      5,
      4,
    ], 7, 8);

    $this->assertEquals($bottle->getResult(), 19);
  }

  /**
   * Test bottle with a hole.
   *
   * Rough bottom. Highest bottom line is higher than waterline.
   *
   * 0 - water.
   * 1 - bottom.
   * 2 - hole.
   *
   * @code
   *
   *           1
   *           1
   *  00000000010000
   *  00010000010000
   *  00010000010000
   *  00110000010010
   *  00110100011011
   *  00111100011011
   *  11111100011111
   *  11111111211111
   * @endcode
   */
  public function testRoughBottomHighHole()
  {
    $bottle = new Task([
      2,
      2,
      5,
      7,
      3,
      4,
      1,
      1,
      0,
      10,
      4,
      2,
      5,
      4,
    ], 8, 8);

    $this->assertEquals($bottle->getResult(), 30);
  }

}
