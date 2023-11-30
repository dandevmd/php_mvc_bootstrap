<?php

namespace dandevmd\mvccore\Validation\Validator\Validators;

use dandevmd\mvccore\Validation\Rule\Rules\Password;
use dandevmd\mvccore\Validation\Validator\Validator;
use dandevmd\mvccore\Validation\Rule\Rules\EmailRule;
use dandevmd\mvccore\Validation\Rule\Rules\RequiredRule;
use dandevmd\mvccore\Validation\Rule\Rules\MinLengthRule;
use dandevmd\mvccore\Validation\Rule\Rules\PasswordConfirmation;

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