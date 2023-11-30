<?php

namespace dandevmd\mvccore\Validation\Rule\Rules;

use dandevmd\mvccore\Validation\Rule\Rule;

class PasswordConfirmation extends Rule
{
  private $password;
  public function __construct($password)
  {
    $this->password = $password;
    parent::__construct('password_confirmation', 'Passwords do not match');
  }

  public function validate($password_confirmation): bool
  {
    return $this->password === $password_confirmation;
  }
}