<?php

namespace app\Database\Migrations;

use app\Core\Application;

class m0001_initial
{


  public function up()
  {
    $db = Application::resolveContainer('app\Core\Database');
    $sql = "CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) ,
      email VARCHAR(255) UNIQUE NOT NULL,
      status TINYINT DEFAULT 0,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )ENGINE=InnoDB;";

    $db->connection->exec($sql);
  }

  public function down()
  {
    $db = Application::resolveContainer('app\Core\Database');
    $sql = "DROP TABLE IF EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) ,
      email VARCHAR(255) UNIQUE NOT NULL,
      status TINYINT DEFAULT 0,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )ENGINE=InnoDB;";

    $db->connection->exec($sql);
  }

}