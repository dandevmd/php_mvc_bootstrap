<?php

namespace dandevmd\mvccore\Validation\Validator;

class Validator
{
  public static function validate(array $fields, array $rules): array
  {
    $errors = [];



    foreach ($fields as $fieldName => $fieldValue) {
      foreach ($rules[$fieldName] as $rule) {
        if (!$rule->validate($fieldValue)) {
          $errors[$fieldName] = $rule->getErrorMessage();
          break;
        }
      }
    }

    return $errors;
  }
}