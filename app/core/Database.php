<?php

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;

  private $dbh;
  private $stmt;

  public function __construct()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION


    ];


    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  //memberi functn query yg digukanakan untuk query apapun
  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  //bind digunakan untuk menentukan valuea atau tipe data dari query
  // contoh pada klausa where id = 1, berarti data id tipe integer dan value 1

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  //setelah menentukan query kemudian di execute
  public function execute()
  {
    $this->stmt->execute();
  }

  //jika hasilnya banyak maka menggunakan fungsi/method resultSet()
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //jika hasilnya hanya 1 maka menggunakan method single()

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  //membuat fungsi menghitung hasil record yg dikembalikan bernama rowCount
  //sedangkan pada $this->stmt-> method rowCount() merupakan milik dari PDO
  public function rowCount()
  {
    return $this->stmt->rowcount();
  }
}
