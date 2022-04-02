<?php
    include("conexion.php");

    $id = $_REQUEST['id'];

    $query = "DELETE FROM estudiantes WHERE id='$id'";
    $resultado=$conexion->query($query);
    Header( 'location: index.php');
?>