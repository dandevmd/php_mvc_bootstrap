<?php

namespace dandevmd\mvccore\Validation\Rule\Rules;

use dandevmd\mvccore\Validation\Rule\Rule;

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