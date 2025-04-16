<?php

include('../php/auth.php');

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tareas</title>
  <link rel="stylesheet" href="../css/tareas.css" />
  <script src="/js/tareas.js" defer></script>
</head>
<body>
  <div class="container">
    <h1>Gestión de Tareas</h1>

    <form id="taskForm">
      <input type="text" id="taskName" placeholder="Nombre de la tarea" required />
      <textarea id="taskDescription" placeholder="Descripción" required></textarea>
      <button  id="btnTaskSend" type="button">Agregar tarea</button>
    </form>

    <h2>Tareas actuales</h2>
    <div id="taskList"></div>
  </div>

</body>
</html>
