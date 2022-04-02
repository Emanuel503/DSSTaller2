<?php
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cargo = $_POST['cargo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
    $query = "INSERT INTO empleados(nombres,apellidos,cargo,fecha_nacimiento) VALUES ('$nombres','$apellidos','$cargo','$fecha_nacimiento')";
    pg_query($conexion, $query);
    Header( 'location: index.php?guardado');
?>