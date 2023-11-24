<?php

namespace app\Core\Validation\Validator\Validators;

use app\Core\Validation\Rule\Rules\Password;
use app\Core\Validation\Validator\Validator;
use app\Core\Validation\Rule\Rules\EmailRule;
use app\Core\Validation\Rule\Rules\RequiredRule;
use app\Core\Validation\Rule\Rules\MinLengthRule;
use app\Core\Validation\Rule\Rules\PasswordConfirmation;

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