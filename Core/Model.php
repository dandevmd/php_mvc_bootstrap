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

    $statement->execute($values);
  }

  public function prepare($sql)
  {
    return Application::$app->DB->connection->prepare($sql);
  }
}