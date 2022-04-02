<?php
    include("conexion.php");

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $grado = $_POST['grado'];
    $fechaNacimiento = $_POST['fechaNacimiento'];

    $query = "INSERT INTO estudiantes(nombres,apellidos,grado,fechaNacimiento) VALUES ('$nombres','$apellidos','$grado','$fechaNacimiento')";
    $resultado=$conexion->query($query);
    Header( 'location: index.php');
?>