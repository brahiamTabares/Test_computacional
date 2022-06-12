<?php

include("db.php");




if (isset($_POST['save_pregunta'])){

    $id=$_POST['id'];

    $query = "INSERT INTO pregunta(id,nombre,test_id,encuesta_id)  VALUES ($id)";
}

if (isset($_POST['save_calificacion'])){

    $id=$_POST['id'];
    $puntuacion=$_POST['puntuacion'];

    $query = "INSERT INTO calificacion(id,puntacion)  VALUES ($id,$puntuacion)";

}






?>