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
      'password' => password_hash($this->fields['password'], PASSWORD_DEFAULT),
    ];

    return $attr;
  }

  public function save()
  {
    if (parent::findOne(['email' => $this->fields['email']])) {
      return false;
    }
    return parent::save();
  }

}