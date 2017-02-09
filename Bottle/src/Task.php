<?php

/**
 * @file
 * Contains definition of a Task class.
 */

namespace Bottle;

/**
 * Task class.
 */
class Task {

  /**
   * Bottom array.
   */
  private $bottom;

  /**
   * Waterline.
   */
  private $water_line;

  /**
   * Hole position.
   */
  private $hole_position;

  /**
   * Square of the bottle.
   */
  private $bottle_square;

  /**
   * BottleClass constructor.
   *
   * @param array $bottom
   * @param int $water_line
   * @param mixed $hole_position
   */
  public function __construct(array $bottom, $water_line, $hole_position = NULL) {
    $this->bottom = $bottom;
    $this->water_line = $water_line;
    $this->hole_position = $hole_position;
    $this->bottle_square = count($this->bottom) * $this->water_line;
  }

  /**
   * Returns result.
   *
   * @return int
   *   Water square.
   */
  public function getResult() {
    $result = 0;
    $sub_square = 0;

    // Bottle without a hole.
    if (is_null($this->hole_position)) {
      foreach ($this->bottom as $bottom_height) {
        if ($bottom_height > $this->water_line) {
          $sub_square += $this->water_line;
        }
        else {
          $sub_square += $bottom_height;
        }
      }

      $result = $this->bottle_square - $sub_square;
    }
    // Bottle with a hole.
    else {
      // TODO: implement resolution for bottle with a hole.
    }

    return $result;
  }

}
