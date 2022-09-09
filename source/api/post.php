<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../config/Database.php';
    include_once '../models/registro.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $db = new Database();
      $db = $db->connect();

      $registro = new Registro($db);

      $data = json_decode(file_get_contents("php://input"));

      $registro->id = $data->id;
      $registro->type = $data->type;
      $registro->deleted = $data->deleted;
    
      if($registro->postData()) {
        echo json_encode(array('message' => 'Registro adicionado'));
      } else {
        echo json_encode(array('message' => 'Registro não adicionado, tente novamente!'));
      }
    } else {
        echo json_encode(array('message' => "Erro: método incorreto!"));
    }