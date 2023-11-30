<?php

namespace dandevmd\mvccore\Validation\Rule\Rules;

use dandevmd\mvccore\Validation\Rule\Rule;

class Password extends Rule
{
  public function __construct()
  {
    parent::__construct('password', 'Passwords must contain 4 or more characters (1 upper case, 1 lower case, 1 number and 1 special character)');
  }

  public function validate($fieldValue): bool
  {

    $uppercase = preg_match('@[A-Z]@', $fieldValue);
    $lowercase = preg_match('@[a-z]@', $fieldValue);
    $number = preg_match('@[0-9]@', $fieldValue);
    $specialChars = preg_match('@[^\w]@', $fieldValue);

    return $uppercase && $lowercase && $number && $specialChars;
  }
}