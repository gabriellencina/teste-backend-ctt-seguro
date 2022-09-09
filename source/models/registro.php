<?php
class Registro {

    private $conn;
    
    public $id;
    public $type;
    public $deleted;


    public function __construct($db){
        $this->conn = $db;
    }

    public function fetchAll() {
        
        $stmt = $this->conn->prepare('SELECT * FROM registros');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->conn->prepare('SELECT  * FROM registros WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->type = $row['type'];
            $this->deleted = $row['deleted'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO registros SET id = :id, type = :type, deleted = :deleted');

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':deleted', $this->deleted);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE registros type = :type, deleted = :deleted WHERE id = :id');

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':deleted', $this->deleted);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->conn->prepare('DELETE FROM registros WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}