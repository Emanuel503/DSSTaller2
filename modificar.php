<?php

    $id = $_REQUEST['id'];
    include("conexion.php");
    $query ="SELECT * FROM estudiantes WHERE id='$id'";
    $resultado = $conexion->query($query) or die ($conexion->error);
    $row = $resultado->fetch_assoc();
        
    $nombres = $row['nombres'];
    $apellidos = $row['apellidos'];
    $grado = $row['grado'];
    $fechaNacimiento = $row['fechaNacimiento'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <title>Taller 1 - Generacion de PDF</title>
</head>
<body>
    <div class="container">
        
        <h1 class="titulo">Registro de estudiantes</h1>
        <img class="titulo-img" src="img/estudiantes.png" alt="Estudiantes"><br><br><br><br><br><br>

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
                    <div class="row g-auto align-items-center">
                        <div class="col-2">
                            <label for="grado" class="col-form-label">Grados:</label>
                        </div>
                        <div class="col-5">
                            <select id="grado" name="grado" class="form-select" required>
                                <option selected>Primer grado</option>
                                <option>Segundo grado</option>
                                <option>Tercer grado</option>
                                <option>Cuarto grado</option>
                                <option>Quinto grado</option>
                                <option>Sexto grado</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row g-auto align-items-center">
                        <div class="col-2">
                            <label for="fechaNacimiento" class="col-form-label">Fecha de nacimiento: </label>
                        </div>
                        <div class="col-5">
                            <input value="<?php echo $fechaNacimiento;?>" type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
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

    $id = $_REQUEST['id'];

    if (isset($_POST['modificar'])) {

        include("conexion.php");

        echo $_POST['nombres'];
        echo $id;

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $grado = $_POST['grado'];
        $fechaNacimiento = $_POST['fechaNacimiento'];

        $query = "UPDATE estudiantes SET nombres='$nombres', apellidos='$apellidos', grado='$grado', fechaNacimiento='$fechaNacimiento' WHERE id='$id'";
        $resultado=$conexion->query($query);
        Header( 'location: index.php');
    }
?>