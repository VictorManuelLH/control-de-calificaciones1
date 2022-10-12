<?php

$mysqli = new mysqli('localhost:3308', 'root', '', 'control');

//Evaluamos que se ejecuto correctamente
if($mysqli -> connect_errno){
    echo "Fallo al conectarse, numero de error: ".$mysqli -> connect_errno."<br>Descripcion del error: ".mysqli -> connect_errno;

    echo "Algo salio mal, intentalo nuevamente";
}