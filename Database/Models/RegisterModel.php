<?php

namespace app\Database\Models;

class RegisterModel
{

  static function create(array $fields)
  {
    $email = $fields['email'];

    // check if user exist
    $heExist = DB::query('SELECT * FROM users WHERE email = :email', ['email' => $email]);

    if ($heExist) {
      return false;
    }

    $query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
    $values = [
      'name' => $fields['name'],
      'email' => $fields['email'],
      'password' => hash('sha256', $fields['password']),
    ];
    $result = DB::query($query, $values);

    if (!$result) {
      return false;
    }

    return true;
  }
}