<?php
class Mahasiswa_model
{
  // private $mhs = [
  //   [
  //     "nama" => "Didin Wahyu",
  //     "nim" => "0812331",
  //     "email" => "dd@yahoo.cc",
  //     "jurusan" => "Teknik Komputer"
  //   ],

  //   [
  //     "nama" => "Sandhi Ka",
  //     "nim" => "081233",
  //     "email" => "sdk@yahoo.cc",
  //     "jurusan" => "Teknik Mesin"
  //   ],
  //   [
  //     "nama" => "Muh Wahyu",
  //     "nim" => "08131331",
  //     "email" => "muhd@yahoo.cc",
  //     "jurusan" => "Teknik Sipil"
  //   ]
  // ];
  //dbh = database handler, stmt = statement query
  //database dgn php data object
  //dsn = data source name
  // private $dbh;
  // private $stmt;

  private $table = 'mahasiswa';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  public function getAllMahasiswa()
  {

    // //setelah query di prepare, kemudian di eksekusi dgn prnth execute
    // $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
    // $this->stmt->execute();
    // //kemudian data di fetch sebagai assoc dgn PDO::FETCH_ASSOC
    // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getMahasiswaById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id =:id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }
}
