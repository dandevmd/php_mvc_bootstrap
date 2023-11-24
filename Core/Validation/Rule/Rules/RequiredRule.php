<?php

namespace app\Core\Validation\Rule\Rules;

use app\Core\Validation\Rule\Rule;

class RequiredRule extends Rule
{
  public function __construct()
  {
    parent::__construct('string', 'This field is required');
  }

  public function validate($fieldValue): bool
  {
    return !empty($fieldValue) && $fieldValue !== null;
  }
}