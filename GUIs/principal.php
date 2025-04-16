
<?php

include('../php/auth.php')

?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="../css/principal.css">
</head>
<body>
    <div class="sidebar">
        <h2>MiApp</h2>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="/GUIs/tareas.php">Tareas</a></li>
            <li><a href="#">Configuración</a></li>
            <li><a href="/php/logout.php">Cerrar sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Bienvenida, Monique 👋</h1>
            <p>Nos alegra tenerte de vuelta</p>
        </header>

        <section class="cards">
            <div class="card">
                <h3>Tareas Pendientes</h3>
                <p>3 tareas por completar</p>
            </div>
            <div class="card">
                <h3>Última conexión</h3>
                <p>14 de abril, 2025</p>
            </div>
            <div class="card">
                <h3>Mi progreso</h3>
                <p>70% completado</p>
            </div>
        </section>
    </div>
</body>
</html>
