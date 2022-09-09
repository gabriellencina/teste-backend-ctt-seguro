<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/registro.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $registro = new Registro($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)) {
            $registro->id = $data->id;

            if($registro->fetchOne()) {

                print_r(json_encode(array(
                    'id' => $registro->id,
                    'type' => $registro->type,
                    'deleted' => $registro->deleted
                )));

            } else {
                echo json_encode(array('message' => "Nenhum registro foi encontrado"));
            }
        } else {
            echo json_encode(array('message' => "Erro: método incorreto!"));
        }
    } 
   