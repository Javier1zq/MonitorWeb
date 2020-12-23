<?php

namespace App\Helpers;

class Helper
{
  /**
   * Private constructor, `new` is disallowed by design.
   */
  private function __construct()
  { }

  public static function removeAccents($string) {
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
    }
}
