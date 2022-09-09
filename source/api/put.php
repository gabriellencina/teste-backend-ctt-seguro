<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../config/Database.php';
    include_once '../models/registro.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$db = new Database();
		$db = $db->connect();

		$registro = new Registro($db);

		$data = json_decode(file_get_contents("php://input"));

		$registro->id = isset($data->id) ? $data->id : NULL;
		$registro->type = $data->type;
		$registro->deleted = $data->deleted;
		

		if(! is_null($registro->id)) {

			if($registro->putData()) {
			echo json_encode(array('message' => 'Registro alterado'));
			} else {
			echo json_encode(array('message' => 'Registro não alterado, tente novamente!'));
			}
	} else {
		
        echo json_encode(array('message' => "Erro: método incorreto!"));
	}
}