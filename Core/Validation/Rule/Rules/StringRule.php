<?php

namespace app\Core\Validation\Rule\Rules;

use app\Core\Validation\Rule\Rule;

class StringRule extends Rule
{
  public function __construct()
  {
    parent::__construct('string', 'Field must be a valid string');
  }

  public function validate($fieldValue): bool
  {
    return is_string($fieldValue);
  }
}