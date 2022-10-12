<?php
    require('functions/connection.php');
    $errors = array();

    $flag = 0;

    if(isset($_GET['id'])){
        $mi_id = $mysqli -> real_escape_string($_GET['id']);
        if(!empty($mi_id)){
            $sql = "SELECT * FROM semestre WHERE id = '$mi_id'";
            $result = $mysqli -> query($sql);
            if($result -> num_rows > 0){
                $flag = 1;
                $datos = $result -> fetch_assoc();
            }else{
                $errors[] = "No hay semestres";
            }
        }else{
            $errors[] = "ID vacio";
        }
    }else{
        $errors[] = "No enviaste ningun ID";
    }

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
    <div class="container" style="margin-top: 20rem">
        <div class="registro col-4 position-relative top-50 start-50 translate-middle">
            <div class="tittle">
                <h1 class="">Semestre</h1>
            </div>
            <?php

            if(count($errors) > 0){
                echo "<div>";
                foreach($errors as $error){
                    echo $error."<br>";
                }
                echo "</div>";
            }
            if($flag = 1){

            ?>
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <form action="modificaSemestre.php" method="POST">
                    <span class="">Semestre</span>
                    <input type="text" name="nombreSemestre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php echo $datos['nombre']; ?>"><br>
                    <input type="hidden" name="miId" value="<?php echo $datos['id']; ?>">
                    <button type="submit" name="enviar" class="">Guardar</button>
                </form>
            </div>
            <?php
            }
            if(count($errors) > 0){
                echo "<div class='error'>";
                foreach($errors as  $error){
                    echo $error."<br>";
                }
                echo "</div>";
            }
            ?>
      </div>
    </div>

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
            <button type="submit" name="enviar" class="">Guardar</button>
        </div>
    </div>

</html>