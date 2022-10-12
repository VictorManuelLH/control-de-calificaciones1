<?php
  require('functions/connection.php');
      $errors = array();

      if(isset($_POST['enviar'])){
          //Si existe enviar en POST
          $mi_numeroControl = $_POST['numeroControl'];
          $mi_nombre = $_POST['nombreAlumno'];
          $mi_apellidoPaterno = $_POST['apellidoPaterno'];
          $mi_apellidoMaterno = $_POST['apellidoMaterno'];
          $mi_correoElectronico = $_POST['correoElectronico'];

          if(!empty($mi_numeroControl) && !empty($mi_nombre) && !empty($mi_apellidoPaterno) && !empty($mi_apellidoMaterno) && !empty($mi_correoElectronico)){
              $sql = "INSERT INTO alumno(numControl, nombreAlumno, apellidoPaterno, apellidoMaterno, correoElectronico) VALUES('$mi_numeroControl', '$mi_nombre', '$mi_apellidoPaterno', '$mi_apellidoMaterno', '$mi_correoElectronico')";
              $result = $mysqli -> query($sql);
            }else{
              $errors[] = "Rellena todos los campos";
            }
        }

        $sql_alumnos = "SELECT * FROM alumno";
        $result_alumnos = $mysqli -> query($sql_alumnos);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <header>
      <nav class="navbar navbar-expand-lg bg-light">
          <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Alumnos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="semestres.php">Gestion</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <body>
    <h2>Alumnos</h2>
    <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Registrar alumno</button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Numero de control</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido paterno</th>
                <th scope="col">Apellido materno</th>
                <th scope="col">Correo electronico</th>
                <th scope="col">Editar-Ver calificacion-Eliminar</th>
            </tr>
        </thead>
        <?php

        if($result_alumnos){
            if($result_alumnos -> num_rows > 0){
                while($alumno = $result_alumnos -> fetch_assoc()){

        ?>
        <tbody>
            <tr>
                <td><?php echo $alumno['numControl']; ?></td>
                <td><?php echo $alumno['nombreAlumno']; ?></td>
                <td><?php echo $alumno['apellidoPaterno']; ?></td>
                <td><?php echo $alumno['apellidoMaterno']; ?></td>
                <td><?php echo $alumno['correoElectronico']; ?></td>
                <td><a name="enviar" href="editarAlumno.php?id=<?php echo $alumno['numControl'];?>">Editar</a> - <a href="calificacionAlumno.php?id=<?php echo $alumno['numControl'];?>">Ver calificaciones</a> - <a name="enviar" href="eliminarAlumno.php?id=<?php echo $alumno['numControl'];?>">Eliminar</a></td>
            </tr>
        </tbody>
        <?php
                }
            }else{
                $errors[] = "No hay ningun alumno";
            }
        }else{
            $errors[] = "Hubo un error";
        }
        if(count($errors) > 0){
            echo "<div class='error'>";
            foreach($errors as  $error){
                echo $error."<br>";
            }
            echo "</div>";
        }
        ?>
    </table>

    
    

    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    </body>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Registrar alumno</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span class="">Numero de control</span>
                <input type="text" name="numeroControl" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                <span class="">Nombre del alumno</span>
                <input type="text" name="nombreAlumno" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                <span class="">Apellido paterno</span>
                <input type="text" name="apellidoPaterno" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                <span class="">Apellido materno</span>
                <input type="text" name="apellidoMaterno" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                <span class="">Correo electronico</span>
                <input type="text" name="correoElectronico" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                <button type="submit" name="enviar">Guardar</button>
            </form>
        </div>
    </div>

</html>