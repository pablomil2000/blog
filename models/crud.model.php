<?php

class CrudModel
{
  static public function index($table, $skip = false, $xPage = false)
  {
    $sql = "SELECT * FROM $table";

    if ($skip || $xPage) {
      $sql .= " LIMIT $skip, $xPage";
    }

    $stmt = Connection::connect()->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  static public function search($table, $data, $order = [])
  {
    $sql = "SELECT * FROM $table WHERE ";
    $where = [];

    foreach ($data as $key => $value) {
      $where[] = "$key like :$key";
    }
    $sql .= implode(' AND ', $where);

    if ($order != []) {
      $sql .= " ORDER BY ";

      foreach ($order as $key => $value) {
        $sql .= "$key $value, ";
      }

      $sql = substr($sql, 0, -2);
    }
    $stmt = Connection::connect()->prepare($sql);

    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value); // Usar bindValue
    }

    // var_dump($sql);  // Muestra el SQL
    // var_dump($data); // Muestra los datos

    $stmt->execute();

    return $stmt->fetchAll();
  }

  static public function update($table, $id, $data)
  {
    $sql = "UPDATE $table SET ";
    $set = [];

    foreach ($data as $key => $value) {
      $set[] = "$key = :$key";
    }
    $sql .= implode(', ', $set);
    $sql .= " WHERE id like :id";

    $stmt = Connection::connect()->prepare($sql);
    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value); // Usar bindValue
    }
    $stmt->bindValue(":id", $id); // Usar bindValue

    $stmt->execute();
    return $stmt->rowCount();
  }

  static public function create($table, $data)
  {
    $sql = "INSERT INTO $table (";
    $columns = [];
    $values = [];

    foreach ($data as $key => $value) {
      $columns[] = $key;
      $values[] = ":$key";
    }
    $sql .= implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';

    $stmt = Connection::connect()->prepare($sql);

    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value); // Usar bindValue
    }
    // var_dump($sql);  // Muestra el SQL
    // var_dump($data); // Muestra los datos
    $stmt->execute();
    return Connection::connect()->lastInsertId();
  }

  static public function delete($table, $data)
  {
    $sql = "DELETE FROM $table WHERE ";

    foreach ($data as $key => $value) {
      $sql .= "$key like :$key AND ";
    }

    $sql = rtrim($sql, " AND ");
    $stmt = Connection::connect()->prepare($sql);

    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value); // Usar bindValue
    }
    // var_dump($sql);  // Muestra el SQL
    // var_dump($data); // Muestra los datos

    $stmt->execute();
    return $stmt->rowCount();
  }

  static public function updateNot($table, $id, $data = [])
  {
    $sql = "UPDATE $table SET ";
    $set = [];

    foreach ($data as $key => $value) {
      $set[] = "$key = :$key";
    }
    $sql .= implode(', ', $set);
    $sql .= " WHERE id NOT LIKE :id";

    $stmt = Connection::connect()->prepare($sql);
    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value); // Usar bindValue
    }
    $stmt->bindValue(":id", $id); // Usar bindValue

    $stmt->execute();
    return $stmt->rowCount();
  }

  static public function getLastInsert($table)
  {
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
    $stmt = Connection::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
  }
}
