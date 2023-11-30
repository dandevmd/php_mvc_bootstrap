<?php

namespace dandevmd\mvccore\Validation\Validator\Validators;

use dandevmd\mvccore\Validation\Rule\Rules\Password;
use dandevmd\mvccore\Validation\Validator\Validator;
use dandevmd\mvccore\Validation\Rule\Rules\EmailRule;
use dandevmd\mvccore\Validation\Rule\Rules\RequiredRule;
use dandevmd\mvccore\Validation\Rule\Rules\MinLengthRule;
use dandevmd\mvccore\Validation\Rule\Rules\PasswordConfirmation;

class RegisterValidator extends Validator
{
  public static function validateRegisterFields(array $fields): array
  {
    $rules = [
      'name' => [
        new RequiredRule(),
      ],
      'email' => [
        new EmailRule(),
        new RequiredRule(),
      ],
      'password' => [
        new RequiredRule(),
        new MinLengthRule(3),
        new Password()
      ],
      'password_confirmation' => [
        new RequiredRule(),
        new MinLengthRule(3),
        new PasswordConfirmation($fields['password'])
      ]

    ];

    return self::validate($fields, $rules);
  }
}