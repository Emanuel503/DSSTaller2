<?php
    $id = $_REQUEST['id'];

    $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
    $query ="DELETE FROM empleados WHERE id='$id'";
    pg_query($conexion, $query);
    Header( 'location: index.php?eliminado');
?>