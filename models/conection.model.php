<?php

class Connection
{
  private static $instance = null; // Singleton instance

  private function __construct()
  {
    // Evitar instanciación directa
  }

  private function __clone()
  {
    // Evitar clonación
  }

  public static function connect()
  {
    if (self::$instance === null) {
      try {
        $envFile = '.env';

        if (!file_exists($envFile)) {
          throw new Exception("El archivo .env no existe.");
        }

        $env = parse_ini_file($envFile);

        $bdType = $env["BDtype"] ?? 'MySQL';

        switch ($bdType) {
          case 'MySQL':
            $servername = $env["BDservername"];
            $username = $env["BDusername"];
            $password = $env["BDpassword"];
            $dbname = $env["BDname"];

            self::$instance = new PDO(
              "mysql:host=$servername;dbname=$dbname",
              $username,
              $password,
              [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true, // Conexión persistente
              ]
            );
            self::$instance->exec("set names utf8");
            break;

          case 'SQLite':
            $sqlitePath = $env["BDsqlitePath"] ?? "database.sqlite";

            self::$instance = new PDO(
              "sqlite:$sqlitePath",
              null,
              null,
              [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              ]
            );
            break;

          default:
            throw new Exception("Tipo de base de datos no soportado: $bdType");
        }
      } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
      } catch (Exception $e) {
        die("Error: " . $e->getMessage());
      }
    }

    return self::$instance;
  }
}
