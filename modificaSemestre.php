<?php 
    require('functions/connection.php');

    $errors = array();

        if(isset($_POST['enviar'])){
            $mi_nombreSemestre = $mysqli -> real_escape_string($_POST['nombreSemestre']);
            $mi_id = $mysqli -> real_escape_string($_POST['miId']);

            if(!empty($mi_nombreSemestre)){

                $sql = "UPDATE semestre SET nombre = '$mi_nombreSemestre' WHERE id = '$mi_id'";
                $result = $mysqli -> query($sql);
            }else{
                $errors[] = "Rellena todos los campos";
            }
        }else{
            $errors[] = "No me estas enviando un id";
        }

        $sql_semestres = "SELECT * FROM semestre WHERE id = '$mi_id'";
        $result_semestre = $mysqli -> query($sql_semestres);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de alumnos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
    <div class="container">
        <div class="registro col-10 position-absolute top-50 start-50 translate-middle">
            <div class="tittle">
            <button class="btn btn-success position-absolute top-0 end-0 translate-middle-x" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Registrar alumno</button>
              <h1 class="">Estado de modificacion</h1>
            </div>
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <div class="container">
        <div class="comentarios">
            
            
                <?php
                    if(isset($result_semestre)){
                        // checamos si la variable esta definida
                        if($result_semestre){
                            // Despues checamos si la variable nos dio true
                            if($mysqli -> affected_rows > 0){
                                
                ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">Nombre</th>
                        </tr>
                      </thead>
                <?php
                
                if($result_semestre){
                    if($result_semestre -> num_rows > 0){
                        while($semestre = $result_semestre -> fetch_assoc()){


                      
                      
                ?>
                      <tbody>
                        <tr>
                          <th><?php echo $semestre['nombre']; ?></th>
                        </tr>
                      </tbody>
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
                    </table>
                </form>
                                <?php
                            }else{
                                $errors[] = "No se modifico ningun semestre";
                            }

                        }else{
                            $errors[] = "Error em la consulta";
                        }
                    }
                ?>
                <?php
                if(count($errors) > 0){
                    echo "<div class='error'>";
                    foreach($errors as $error){
                        echo "<i class='fas fa-exclamation-circle'></i>".$error."<br>";
                    }
                    echo "</div>";
                }
                $mysqli -> close();
                ?>
            </div>
    </div>
            </div>
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
  <div class="container" style="margin-top: 20rem">
        <div class="registro position-relative top-50 start-50 translate-middle">
            <div class="tittle text-center">
                <h1 class="text-primary">Alumno</h1>
            </div>
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <span class="">Nombre</span>
                    <input type="text" name="nombreSenestre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"><br>
                    <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>