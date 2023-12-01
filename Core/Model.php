<?php
namespace app\Core;

use app\Core\Application;

abstract class Model
{
  abstract public function tableName(): string;
  abstract public function attributes(): array;

  public function save()
  {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(fn($atr) => ":$atr", array_keys($attributes));
    $values = array_values($attributes);

    $statement = $this->prepare("INSERT INTO $tableName (" . implode(',', array_keys($attributes)) . ") VALUES (" . implode(',', $params) . ")");

    return $statement->execute($values);
  }

  public function findOne($where)
  {

    $tableName = $this->tableName();
    $attributes = array_keys($where);
    $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
    $statement = $this->prepare("SELECT * FROM $tableName WHERE $sql");
    foreach ($where as $key => $item) {
      $statement->bindValue(":$key", $item);
    }

    $statement->execute();

    return $statement->fetch();
  }

  public function prepare($sql)
  {
    return Application::resolve('app\Core\Database')->connection->prepare($sql);

  }
}