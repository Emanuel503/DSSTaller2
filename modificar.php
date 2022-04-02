<?php
    $id = $_REQUEST['id'];
    
    $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
    $query ="SELECT * FROM empleados WHERE id='".$id."'";
    $resultado = pg_query($conexion, $query);
    WHILE($row = pg_fetch_object($resultado)){
        $nombres = $row->nombres;
        $apellidos = $row->apellidos;
        $cargo = $row->cargo;
        $fecha_nacimiento = $row->fecha_nacimiento;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <title>Taller 2 - Conexión a bases de datos PostgreSQL desde PHP</title>
</head>
<body>
    <div class="container">
        
        <h1 class="titulo">Registro de estudiantes</h1>
        <img class="titulo-img" src="img/empleados.png" alt="Estudiantes"><br><br><br><br><br><br>

        <div class="p-5 mb-4 bg-light rounded-3">
            <h2>Modificar estudiante</h2>
            <div class="container-fluid py-5">
                <form action="modificar.php?id=<?php echo $_REQUEST['id']; ?>" method="post">
                    <div class="row g-auto align-items-center">
                        <div class="col-2">
                            <label for="nombres" class="col-form-label">Nombres: </label>
                        </div>
                        <div class="col-5">
                            <input value="<?php echo $nombres;?>" type="text" id="nombres" name="nombres" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row g-auto align-items-center">
                        <div class="col-2">
                            <label for="apellidos" class="col-form-label">Apellidos: </label>
                        </div>
                        <div class="col-5">
                            <input value="<?php echo $apellidos;?>" type="text" id="apellidos" name="apellidos" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row g-5 align-items-center">
                        <div class="col-2">
                            <label for="grado" class="col-form-label">Cargos:</label>
                        </div>
                        <div class="col-5">
                            <select id="cargo" name="cargo" class="form-select" required>
                                <option <?php if($cargo=="Jefe"){echo "selected";}?>>Jefe</option>
                                <option <?php if($cargo=="Gerente"){echo "selected";}?>>Gerente</option>
                                <option <?php if($cargo=="Supervisor"){echo "selected";}?>>Supervisor</option>
                                <option <?php if($cargo=="Empleado"){echo "selected";}?>>Empleado</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row g-auto align-items-center">
                        <div class="col-2">
                            <label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento: </label>
                        </div>
                        <div class="col-5">
                            <input value="<?php echo $fecha_nacimiento;?>" type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <a href="index.php" class="btn btn-secondary">Cerrar</a>
                    <button type="submit" name="modificar" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if (isset($_POST['modificar'])) {

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $cargo = $_POST['cargo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
        $query ="UPDATE empleados SET nombres='$nombres', apellidos='$apellidos', cargo='$cargo', fecha_nacimiento='$fecha_nacimiento' WHERE id='$id'";
        pg_query($conexion, $query);
        Header( 'location: index.php?id='.$id.'&modificado');
    }
?>