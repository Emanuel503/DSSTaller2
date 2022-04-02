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
        <img class="titulo-img" src="img/estudiantes.png" alt="Estudiantes">

        <div class="botones">
            <a class="btn btn-success" href="PDF.php" target="_blank">Generar PDF</a>
            <button type="button" class="btn btn-primary btn-registrar" data-toggle="modal" data-target="#modalRegistrar">Registar Estudiante</button>
        </div>

        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr class="table-secondary">
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Fecha de nacimiento</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                <?php
                    include("conexion.php");
                    $query ="SELECT * FROM estudiantes";
                    $resultado = $conexion->query($query) or die ($conexion->error);
                    WHILE($row = $resultado->fetch_assoc())
					{
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['nombres'];?></td>
                    <td><?php echo $row['apellidos'];?></td>
                    <td><?php echo $row['grado'];?></td>
                    <td><?php echo $row['fechaNacimiento'];?></td>
                    <td>
                        <a class="btn btn-secondary" href="modificar.php?id=<?php echo $row['id'];?>">Modificar</a>
                        <a class="btn btn-danger" href="eliminar.php?id=<?php echo $row['id'];?>">Eliminar</a>
                    </td>
                </tr>
                <?php 
					}
				?>
            </tbody>
        </table>

        <!--Modal guardar-->
        <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registar estudiante</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="registrar.php" method="post">
                        <div class="modal-body">
                            <div class="row g-5 align-items-center">
                                <div class="col-5">
                                  <label for="nombres" class="col-form-label">Nombres: </label>
                                </div>
                                <div class="col-auto">
                                  <input type="text" id="nombres" name="nombres" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="row g-5 align-items-center">
                                <div class="col-5">
                                  <label for="apellidos" class="col-form-label">Apellidos: </label>
                                </div>
                                <div class="col-auto">
                                  <input type="text" id="apellidos" name="apellidos" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="row g-5 align-items-center">
                                <div class="col-5">
                                  <label for="grado" class="col-form-label">Grados:</label>
                                </div>
                                <div class="col-auto">
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
                            <div class="row g-5 align-items-center">
                                <div class="col-5">
                                  <label for="fechaNacimiento" class="col-form-label">Fecha de nacimiento: </label>
                                </div>
                                <div class="col-auto">
                                  <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Estudiante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>