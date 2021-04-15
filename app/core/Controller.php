<?php
class Controller
//terdapat 2 parameter, parameter pertama adalah $view ditangkap dari
// controllers/Home.php 
//parameter kedua adalah data yang mungkin dikirim, diberi nilai array
// karena bisa lebih dari 1 data
{

  public function view($view, $data = [])
  {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($model)
  {
    require_once '../app/models/' . $model . '.php';
    return new $model;
  }
}
