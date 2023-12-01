<?php

namespace app\Database\Models;

use app\Core\Model;
use app\Core\Application;
use app\Core\Response;


class Auth extends Model
{
  public array $fields;

  public function __construct(array $fields = [])
  {
    $this->fields = $fields;
  }

  public function tableName(): string
  {
    return 'users';
  }

  public function attributes(): array
  {
    $attr = [
      'email' => $this->fields['email'],
      'password' => hash('sha256', $this->fields['password']),
    ];

    return $attr;
  }

  public function auth()
  {
    $user = parent::findOne(['email' => $this->fields['email']]);

    if (!$user) {
      return false;
    }

    if (!password_verify($this->fields['password'], $user['password'])) {
      return false;
    }

    Application::resolveContainer('app\Core\Session')->set('user', ['id' => $user['id'], 'name' => $user['name']]);
    return $user;
  }

  static function logout()
  {
    Application::resolveContainer('app\Core\Session')->delete('user');
  }


}