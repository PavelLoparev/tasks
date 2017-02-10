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
    // Bottle without a hole.
    if (is_null($this->hole_position)) {
      // Square of a bottom.
      $sub_square = 0;

      foreach ($this->bottom as $bottom_height) {
        // Cut bottom to waterline height if needed.
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
      // Square without water.
      $free_square = 0;

      // Count square like if there is no hole.
      $original_hole_position = $this->hole_position;
      $this->hole_position = NULL;
      $square_without_hole = $this->getResult();

      // Make a hole again.
      $this->hole_position = $original_hole_position;

      // Count free square (left side).
      // Start from a hole position and move to the left.
      $last_bottom_height = 0;

      for ($i = $this->hole_position; $i >= 0; $i--) {
        $free_square += $this->getPartOfFreeSquare($this->bottom[$i], $last_bottom_height);
      }

      // Count free square (right side).
      // Start from a hole position + 1 and move right.
      $right_side_start_index = $this->hole_position + 1;
      $last_bottom_height = $this->bottom[$right_side_start_index] > $this->water_line ? $this->water_line : $this->bottom[$right_side_start_index];

      for ($i = $right_side_start_index; $i < count($this->bottom); $i++) {
        $free_square += $this->getPartOfFreeSquare($this->bottom[$i], $last_bottom_height);
      }

      $result = $square_without_hole - $free_square;
    }

    return $result;
  }

  /**
   * Returns part of free space.
   *
   * @param int $current_bottom_height
   * @param int $last_bottom_height
   * @return int
   */
  private function getPartOfFreeSquare($current_bottom_height, &$last_bottom_height) {
    // Cut down bottom height if it higher that a waterline.
    if ($current_bottom_height > $this->water_line) {
      $current_bottom_height = $this->water_line;
    }

    // Count free space and update last bottom height if needed.
    if ($current_bottom_height < $last_bottom_height) {
      $result = $this->water_line - $last_bottom_height;
    }
    else {
      $result = $this->water_line - $current_bottom_height;
      $last_bottom_height = $current_bottom_height;
    }

    return $result;
  }

}
