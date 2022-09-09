<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '/var/www/source/config/Database.php';
    include_once '/var/www/source/models/registro.php';

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

		$db = new Database();
		$db = $db->connect();

		$registro = new Registro($db);

		$data = json_decode(file_get_contents("php://input"));

		$registro->id = isset($data->id) ? $data->id : NULL;

		if(! is_null($registro->id)) {
	
			if($registro->delete()) {
			echo json_encode(array('message' => 'Registro deletado'));
			} else {
			echo json_encode(array('message' => 'Registro não deletado, tente novamente!'));
			}
		}
	} else {
		echo json_encode(array('message' => "Erro: método errado!"));
	}