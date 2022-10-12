<?php
    require('functions/connection.php');
    $errors = array();

    $flag = 0;

    if(isset($_GET['id'])){
      $mi_id = $mysqli -> real_escape_string($_GET['id']);
      if(!empty($mi_id)){
          $sql = "SELECT * FROM alumno WHERE numControl = '$mi_id'";
          $result = $mysqli -> query($sql);
          if($result -> num_rows > 0){
              $flag = 1;
              $datos = $result -> fetch_assoc();
          }else{
              $errors[] = "No hay usuarios";
          }
        }else{
            $errors[] = "ID vacio";
        }
    }else{
        $errors[] = "No envias ningun ID";
    }

    $sql_alumno = "SELECT * FROM alumno WHERE numControl = '$mi_id'";
    $result_alumno = $mysqli -> query($sql_alumno);

    $sql_materia = "SELECT * FROM materia";
    $result_materias = $mysqli -> query($sql_materia);

    $sql_parcial = "SELECT * FROM parcial";
    $result_parciales = $mysqli -> query($sql_parcial);


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
    <h2>
        <?php

        if($result_alumno){
            if($result_alumno -> num_rows > 0){
                while($alumno = $result_alumno -> fetch_assoc()){
                    echo $alumno['nombreAlumno']." ". $alumno['apellidoPaterno']." ". $alumno['apellidoMaterno'];
                }
            }else{
                $errors[] = "No hay ningun alumno";
            }
        }else{
            $errors[] = "Hubo un error";
        }
        ?>
    </h2>
    <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Registrar calificacion</button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Semestre 1</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            
            if($result_materias){
                if($result_materias -> num_rows > 0){
                    while($materia = $result_materias -> fetch_assoc()){

            ?>
                <th scope="row"><?php echo $materia['nombreMateria']; ?></th>
                <?php
                    }
                }else{
                    $errors[] = "No hay ninguna materia";
                }
            }else{
                $errors[] = "Hubo un error";
            }
            
            ?>
        </tr>
        <?php
        
        if($result_parciales){
            if($result_parciales -> num_rows > 0){
                while($parcial = $result_parciales -> fetch_assoc()){

        ?>
        <tr>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
            <td scope="row"><?php echo $parcial['nombre']; ?></td>
        </tr>
        <?php
                }
            }else{
                $errors[] = "No hay ningun parcial";
            }
        }else{
            $errors[] = "Hubo un error";
        }
        ?>
            <tr>
                <td scope="row">Promedio: 10</td>
                <td scope="row">Promedio: 10</td>
                <td scope="row">Promedio: 10</td>
                <td scope="row">Promedio: 10</td>
                <td scope="row">Promedio: 10</td>
                <td scope="row">Promedio: 10</td>
            </tr>
    </table>

    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Registrar calificacion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <span class="">Materia</span>
            <input type="text" name="nombreMateria" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
            <span class="">Semestre</span>
            <input type="text" name="nombreSemestre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
            <span class="">Parcial</span>
            <input type="text" name="nombreParcial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
            <span class="">calificacion</span>
            <input type="text" name="calificacion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
            <button type="submit" name="enviar" class="">Guardar</button>
        </div>
    </div>

</html>