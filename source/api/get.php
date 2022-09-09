<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/registro.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $registro = new Registro($db);

        $res = $registro->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {

            $registro = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                array_push($registro, array( 'id' => $id, 'type' => $type, 'deleted' => $deleted));
            }
            
            echo json_encode($registro);

        } else {
            echo json_encode(array('message' => "Nenhum registro foi encontrado"));
        }
    } else {
        echo json_encode(array('message' => "Erro: método não encontrado"));
    }