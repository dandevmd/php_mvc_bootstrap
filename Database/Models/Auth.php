<?php

namespace app\Database\Models;

use dandevmd\mvccore\Model;
use dandevmd\mvccore\Application;
use dandevmd\mvccore\Response;


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

    Application::$app->session->set('user', ['id' => $user['id'], 'name' => $user['name']]);
    return $user;
  }

  static function logout()
  {
    Application::$app->session->delete('user');
  }


}