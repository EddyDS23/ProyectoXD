<?php

session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'),true);

$method = $_SERVER['REQUEST_METHOD'];
$name = $data['name'] ?? null;
$description = $data['description'] ?? null;
$userId = $_SESSION['user_id'];

include('conexion.php');
$conexion = new conexion();

switch($method){
    case 'POST':

        $result = $conexion->addTask($name,$description,$userId);
    
        if($result === true){
            echo json_encode(['status' => 'success','message' => 'Tarea registrada']);
        }else{
            echo json_encode(['status' => 'failed', 'message' => 'Tarea no registrada '.$result]);
        }

        break;
    case 'GET':

        $result = $conexion->getTaskUserById($userId);
        
        if(is_array($result)){
            echo json_encode(['status' => 'success', 'tasks' => $result]);
        }else{
            echo json_encode(['status' => 'failed', 'message' => 'Tareas Error '.$result]);
        }

        break;
}
    $conexion->closeConection();


?>