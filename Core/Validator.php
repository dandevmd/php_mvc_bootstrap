<?php

namespace app\Core;

class Validator
{


  public static function validateLoginFields(array $fields): array
  {
    $errors = [];

    foreach ($fields as $fieldName => $fieldValue) {
      switch ($fieldName) {
        case 'email':
          if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL) || empty($fieldValue)) {
            $errors[$fieldName] = 'Email must be a valid email address';
          }
          break;
        case 'password':
          if (!is_string($fieldValue) || empty($fieldValue)) {
            $errors[$fieldName] = 'Password must be a non-empty field';
          }
          break;
      }
    }
    return $errors;
  }

  static function validateRegistrationFields(array $fields): array
  {
    $errors = [];

    foreach ($fields as $fieldName => $fieldValue) {
      switch ($fieldName) {
        case 'name':
          if (!is_string($fieldValue) || empty($fieldValue) || strlen($fieldValue) <= 3) {
            $errors[$fieldName] = 'Name must be a non-empty field with at least 3 characters';
          }
          break;
        case 'email':
          if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL) || empty($fieldValue)) {
            $errors[$fieldName] = 'Email must be a valid email address';
          }
          break;
        case 'password':
          if (!is_string($fieldValue) || empty($fieldValue)) {
            $errors[$fieldName] = 'Password must be a non-empty field';
          }
          break;
        case 'password_confirmation':
          if (!is_string($fieldValue) || empty($fieldValue)) {
            $errors[$fieldName] = 'Password confirmation must be a non-empty field';
          } elseif ($fieldValue !== $fields['password']) {
            $errors[$fieldName] = 'Password confirmation does not match password';
          }
          break;
      }
    }

    return $errors;
  }
}