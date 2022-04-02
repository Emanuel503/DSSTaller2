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
        
        <h1 class="titulo">Registro de empleados</h1>
        <img class="titulo-img" src="img/empleados.png" alt="Empleados">

        <div class="botones">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrar">Registar Empleado</button>
            <a class="btn btn-success btn-pdf" href="PDF.php" target="_blank">Generar PDF</a>
            
        </div>

        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr class="table-secondary">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cargo</th>
                    <th>Fecha de nacimiento</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                <?php
                    $contador=0;
                    $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
                    $query ="SELECT * FROM empleados";
                    $resultado = pg_query($conexion, $query);
                    WHILE($row = pg_fetch_object($resultado)){
                        $contador++;
                ?>
                <tr>
                    <td><?php echo $contador;?></td>
                    <td><?php echo $row->nombres;?></td>
                    <td><?php echo $row->apellidos;?></td>
                    <td><?php echo $row->cargo;?></td>
                    <td><?php echo $row->fecha_nacimiento;?></td>
                    <td>
                        <a class="btn btn-secondary" href="modificar.php?id=<?php echo $row->id;?>">Modificar</a>
                        <button class="btn btn-danger" onclick="eliminar(<?php echo $row->id;?>)">Eliminar</button>
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
                                  <label for="grado" class="col-form-label">Cargos:</label>
                                </div>
                                <div class="col-auto">
                                  <select id="cargo" name="cargo" class="form-select" required>
                                      <option>Jefe</option>
                                      <option>Gerente</option>
                                      <option>Supervisor</option>
                                      <option>Empleado</option>
                                  </select>
                                </div>
                            </div>
                            <br>
                            <div class="row g-5 align-items-center">
                                <div class="col-5">
                                  <label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento: </label>
                                </div>
                                <div class="col-auto">
                                  <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/funciones.js"></script>
</body>
</html>

<?php
    if(isset($_GET["eliminado"])){
        echo '
        <div class="alert alert-danger alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Empleado eliminado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    if(isset($_GET["guardado"])){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Empleado guardado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    if(isset($_GET["modificado"])){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Empleado modificado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

?>