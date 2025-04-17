<?php

require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;



session_start();

header("Content-Type:application/json");

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

$key = $_ENV['JWT_SECRET_KEY'];

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


        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'uid' => $userId
        ];

        $jwt = JWT::encode($payload,$key, 'HS256');

        echo json_encode(['status' => 'success' , 'token' => $jwt , 'message' => 'Inicio de sesion exitoso']);
    }else{
        echo json_encode(['status' => 'failed' , 'message' => 'Inicio de sesion fallido, contrasena o correo incorrectos']);
    }
}else{
    echo json_encode(['status' => 'failed' , 'message' => 'No existe usuario']);
}



?>
