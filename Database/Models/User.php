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
      'name' => ucfirst($this->fields['name']),
      'email' => $this->fields['email'],
      'status' => isset($this->fields['status']) ? $this->fields['status'] : 1,
      'password' => hash('sha256', $this->fields['password']),
    ];

    return $attr;
  }

  public function save()
  {
    if ($this->ifExists($this->fields['email'])) {
      return false;
    }
    return parent::save();
  }


  public function ifExists(string $email): bool
  {
    $stmt = Application::$app->DB->connection->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0;
  }

}