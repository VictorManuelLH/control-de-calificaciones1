<?php
  require('functions/connection.php');
      $errors = array();

      if(isset($_POST['enviar'])){
        //Si existe enviar en POST
        $mi_nombreSemestre = $_POST['nombreSemestre'];

        if(!empty($mi_nombreSemestre)){
            $sql = "INSERT INTO semestre(nombre) VALUES('$mi_nombreSemestre')";
            $result = $mysqli -> query($sql);
          }else{
            $errors[] = "Rellena todos los campos";
          }
      }

        $sql_semestre = "SELECT * FROM semestre";
        $result_semestres = $mysqli -> query($sql_semestre);
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Semestres</title>
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
                          <a class="nav-link" aria-current="page" href="index.php">Alumnos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link active" href="semestres.php">Gestion</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <body>
    <h2>Semestres</h2>
    <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Registrar semestre</button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Semestres</th>
            </tr>
        </thead>
        <tbody>
        <?php

            if($result_semestres){
                if($result_semestres -> num_rows > 0){
                    while($semestre = $result_semestres -> fetch_assoc()){

        ?>
            <tr>
                <td scope="row"><?php echo $semestre['nombre'];?></td>
                <td><a name="enviar" href="editarSemestre.php?id=<?php echo $semestre['id'];?>">Editar</a></td>
            </tr>
            <tr>
                <td scope="row">Parcial 1</td>
                <td><a name="enviar" href="editarSemestre.php?id=<?php echo $parcial['id'];?>">Editar</a></td>
            </tr>
        <?php
        
                    }
                }else{
                    $errors[] = "No hay ningun semestre";
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
        </tbody>
    </table>

    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Registrar semestre</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <span class="">Nombre del semestre</span>
            <input type="text" name="nombreSemestre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
            <button type="submit" name="enviar" class="">Guardar</button>
    </form>
        </div>
    </div>
</html>