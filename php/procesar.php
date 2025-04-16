<?php

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
    exit;
}

if (!isset($data['name'], $data['email'], $data['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos en la solicitud.']);
    exit;
}

$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$conexion = new conexion();
$resultado = $conexion->addUser($name, $email, $password);
$conexion->closeConection();

if ($resultado === true) {
    echo json_encode(['status' => 'success', 'message' => 'Usuario registrado exitosamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => $resultado]);
}
?>
