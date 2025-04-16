<?php

session_start();

header("Content-Type:application/json");


$data = json_decode(file_get_contents('php://input'),true);

$email      = $data['email'];
$password   = $data['password'];

include('conexion.php');

$conexion = new conexion();
$password_hash = $conexion->getPassword($email);
$userId = $conexion->getUserId($email);
$conexion->closeConection();


if($password_hash != null){
    if(password_verify($password,$password_hash)){
        $_SESSION['user'] = $email;
        $_SESSION['user_id'] = $userId;
        echo json_encode(['status' => 'success' , 'message' => 'Inicio de sesion exitoso']);
    }else{
        echo json_encode(['status' => 'failed' , 'message' => 'Inicio de sesion fallido, contrasena o correo incorrectos']);
    }
}else{
    echo json_encode(['status' => 'failed' , 'message' => 'No existe usuario']);
}



?>
