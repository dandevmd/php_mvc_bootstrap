<?php

namespace app\Core\Validation\Validator\Validators;

use app\Core\Validation\Rule\Rules\Password;
use app\Core\Validation\Validator\Validator;
use app\Core\Validation\Rule\Rules\EmailRule;
use app\Core\Validation\Rule\Rules\RequiredRule;
use app\Core\Validation\Rule\Rules\MinLengthRule;
use app\Core\Validation\Rule\Rules\PasswordConfirmation;

class LoginValidator extends Validator
{
  public static function validateLoginFields(array $fields): array
  {
    $rules = [
      'email' => [
        new EmailRule(),
        new RequiredRule(),
      ],
      'password' => [
        new RequiredRule(),
        new MinLengthRule(3),
      ],
    ];

    return self::validate($fields, $rules);
  }
}