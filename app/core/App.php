<?php

class App
{

  protected $controller = 'Home';
  protected $method = 'index';
  protected $params = [];


  public function __construct()
  {
    $url = $this->parseURL();
    //mengecek apakah ada file di /app/controllers
    //url[0] adalah nama dr index pertama url dan digabung dgn extensi file
    //kalau ada controller default di replace dgn contrler baru
    //unset untuk menghapus url pertama
    //contoh : home/index/satu/dua menjadi index/satu/dua
    if (file_exists('../app/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    //memanggil file controller yg baru kemudian instansiasi supaya bisa 
    //memanggil method yg dibutuhkan

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    //method berada di url index ke 1
    //kemudian mengecek apakah ada method di controller yang sudah 
    //diinisiasi diatas dengan method_exist
    //kalau ada, maka method ditimpa dengan method baru
    //kemudian unset lagi
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    //berikutnya mengambil nilai dr parameter
    // ketika 2 url pertama sudah dihapus dan masih ada nilai selanjutnya
    //nilai selanjutnya disebut parameter
    if (!empty($url)) {
      $this->params = array_values($url);
    }

    //jalankan controller & method , serta kirimkan params jika ada
    //dengan call_user_func_array()

    call_user_func_array([$this->controller, $this->method], $this->params);
  }




  public function parseURL()
  {

    //jika ada url yang dikirimkan
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/'); //menghapus tanda '/' di akhir url
      $url = filter_var($url, FILTER_SANITIZE_URL); // membersihkan url dari karakter yang aneh dan ngaco
      $url = explode('/', $url); // pecah bbrp url dgn tanda pemisahnya(delimiter) '/'
      return $url;
    }
  }
}
