<?php

namespace app\Database\Migrations;

use app\Core\Application;

class m0002_add_password_column
{

  public function up()
  {
    $db = Application::$container->resolve('app\Core\Database');
    $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL";
    $db->connection->exec($sql);
  }

  public function down()
  {
    $db = Application::$container->resolve('app\Core\Database');
    $sql = "ALTER TABLE users DROP COLUMN password";
    $db->connection->exec($sql);
  }
}