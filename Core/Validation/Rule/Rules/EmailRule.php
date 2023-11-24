<?php

namespace app\Core\Validation\Rule\Rules;

use app\Core\Validation\Rule\Rule;

class EmailRule extends Rule
{
  public function __construct()
  {
    parent::__construct('email', 'Field must be a valid email');
  }

  public function validate($fieldValue): bool
  {
    return filter_var($fieldValue, FILTER_VALIDATE_EMAIL);
  }
}