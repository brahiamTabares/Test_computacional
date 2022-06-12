<?php

include 'db.php';

$conn=conectar();
if (isset($_POST['enviar_encuesta'])) {

    $calificacion1 = $_POST['comboPregunta1'];
    $calificacion2 = $_POST['comboPregunta2'];
    $calificacion3 = $_POST['comboPregunta3'];

    session_start();
    $id=session_id();
    $query="INSERT INTO calificacion(`pregunta`, `puntuacion`, `Usuario_id`) VALUES ('P1', '$calificacion1', '$id');";
    mysqli_query($conn,$query);

    $query2="INSERT INTO calificacion(`pregunta`, `puntuacion`, `Usuario_id`) VALUES ('P2', '$calificacion2', '$id');";
    mysqli_query($conn,$query2);

    $query3="INSERT INTO calificacion(`pregunta`, `puntuacion`, `Usuario_id`) VALUES ('P3', '$calificacion3', '$id');";
    mysqli_query($conn,$query3);

}
desconectar($conn);
header("Location: http://localhost/php_test_computacional/GUI/index.html");
exit();
?>