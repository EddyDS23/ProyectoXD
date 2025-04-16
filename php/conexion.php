<?php

// Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

class conexion {
    private $server = "localhost";
    private $user = "wacho";
    private $password = "1234";
    private $database = "test";
    private $conn;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $this->conn = new mysqli($this->server, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            return 'Conexión fallida: ' . $this->conn->connect_error;
        }

        return $this->conn;
    }

    public function closeConection() {
        $this->conn->close();
    }

    public function getUserId($email){
        $query = "SELECT usr_id FROM tbUsers WHERE usr_email = ?";

        $stmt = $this->conn->prepare($query);
        $stmt -> bind_param("s",$email);

        if(!$stmt->execute()){
            return false;
        }

        $result = $stmt -> get_result();

        if($result -> num_rows > 0){
            
            $row = $result->fetch_assoc();
            return $row['usr_id'];
        }else{
            return false;
        }

        $stmt->close();
    }    

    public function getPassword($email){
        $query = "SELECT usr_pass FROM tbUsers WHERE usr_email = ?";

        $stmt = $this->conn->prepare($query);
        $stmt -> bind_param("s",$email);

        if(!$stmt->execute()){
            return null;
        }

        $result = $stmt -> get_result();

        if($result -> num_rows > 0){
            
            $row = $result->fetch_assoc();
            return $row['usr_pass'];
        }else{
            return null;
        }

        $stmt->close();
    }

    function getTaskUserById($userId){
        $query = "SELECT * FROM tbTask WHERE tas_usr_id = ?";

        $stmt = $this->conn->prepare($query);

        if($stmt == false){
            return ['status' => 'failed', 'message' => 'Error al preprar consulta '.$this->conn->error];
        }

        $stmt->bind_param('s',$userId);

        if(!$stmt->execute()){
            return ['status' => 'failed', 'message' => 'Error al ejecutar consulta '.$stmt->error];
        }

        $result = $stmt->get_result();
        
        $tasks=[];

        while($row = $result->fetch_assoc()){
            $tasks[] = $row; 
        }

        return $tasks;
    }

    public function addUser($name, $email, $password) {
        $query = "INSERT INTO tbUsers(usr_name, usr_email, usr_pass) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return 'Error al preparar la consulta: ' . $this->conn->error;
        }

        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            return true;
        } else {
            $error = 'Error al agregar usuario: ' . $stmt->error;
            return $error;
        }
         $stmt->close();
    }

    public function addTask($name,$description,$userId){

        $query = "INSERT INTO tbTask(tas_name,tas_description,tas_usr_id) VALUES (?,?,?)";

        $stmt = $this->conn->prepare($query);

        if($stmt === false){
            return 'Error al preparar consulta '.$this->conn->error;
        }

        $stmt->bind_param("ssi",$name,$description,$userId);

        if($stmt->execute()){
            return true;
        }else{
            $error = "Error al agregar tarea: ".$stmt->error;
            return $error;
        }
        $stmt->close();

    }   

    public function updateStatusTask($taskId){
        $query = 'UPDATE  tbTask SET tas_status = "success" WHERE tas_id = ?';

        $stmt = $this->conn->prepare($query);

        if($stmt === false){
            return ['status' => 'failed', 'message' => 'Error al preparar consulta de actualizacion '.$this->conn->error];
        }

        $stmt->bind_param('i',$taskId);

        if($stmt -> execute()){
            return true;
        }else{
            return ['status' => 'failed', 'message' => 'Tarea no actualizada '.$stmt->error];
        }

    }
    
}
?>
