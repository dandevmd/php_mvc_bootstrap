<?php

namespace app\Database;



class DB extends \PDO
{
  public \PDO $connection;

  public function __construct(string $dsn = '', string $user = '', string $password = '')
  {
    $dsn = $_ENV['DB_DSN'] ?? $dsn;
    $user = $_ENV['DB_USER'] ?? $user;
    $password = $_ENV['DB_PASSWORD'] ?? $password;
    $defaultOptions = [
      \PDO::ATTR_PERSISTENT => true,
      \PDO::ATTR_EMULATE_PREPARES => false,
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ];

    try {
      $this->connection = new \PDO($dsn, $user, $password, $defaultOptions);
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }

  public function runMigrations()
  {
    $this->createMigrationTable();
    $existingMigrations = $this->existingMigrations();

    $newMigrations = [];

    $files = scandir(__DIR__ . "/Migrations");
    $toApplyMigrations = array_diff($files, $existingMigrations);


    foreach ($toApplyMigrations as $migration) {
      if ($migration === '.' || $migration === '..')
        continue;

      require_once __DIR__ . "/Migrations/$migration";
      $className = pathinfo($migration, PATHINFO_FILENAME);
      $classToInstanciate = "app\Database\Migrations\\$className";
      $instance = new $classToInstanciate();
      $this->log("Applying migration $migration");
      $instance->up();
      $this->log("Applied migration $migration");
      $newMigrations[] = $migration;
    }

    if (!empty($newMigrations)) {
      $this->saveMigrations($newMigrations);
    } else {
      $this->log("All migrations are applied");
    }
  }


  public function createMigrationTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS migrations(
      id INT AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )ENGINE=InnoDB;";

    $this->connection->exec($sql);
  }

  public function existingMigrations()
  {

    $statement = $this->connection->prepare("SELECT migration FROM migrations");
    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }

  public function saveMigrations(array $migrations)
  {

    $str = implode(",", array_map(fn($m) => "('$m')", $migrations)); //"('m1') , ('m2')"
    $sql = "INSERT INTO migrations (migration) VALUES $str";

    $this->connection->exec($sql);
  }

  protected function log(string $message)
  {
    echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
  }


}