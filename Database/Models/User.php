<?php

namespace app\Database\Models;

use app\Core\Model;
use app\Core\Application;
use app\Core\Response;


class User extends Model
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
      'name' => $this->fields['name'],
      'email' => $this->fields['email'],
      'status' => $this->fields['status'] ? $this->fields['status'] : 1,
      'password' => hash('sha256', $this->fields['password']),
    ];

    return $attr;
  }

  public function save()
  {
    if ($this->alreadyExists($this->fields['email'])) {
      return false;
    }
    return parent::save();
  }


  public function alreadyExists(string $email): bool
  {
    $heExist = Application::$app->DB->connection->prepare('SELECT * FROM users WHERE email = :email');
    $heExist = $heExist->execute([
      'email' => $email
    ]);

    return $heExist ? true : false;
  }


}