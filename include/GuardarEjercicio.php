<?php

include 'db.php';

$conn=conectar();
if (isset($_POST['siguiente'])) {

    $numeroEjercicio = $_POST['ejercicio'];
    $puntuacion = $_POST['POST-puntuacion'];
    session_start();
    $id=session_id();
    $ejercicio="E".$numeroEjercicio;

    $query="INSERT INTO resultado(`ejercicio`, `puntuacion`, `Usuario_id`) VALUES ('$ejercicio', '$puntuacion', '$id');";
    mysqli_query($conn,$query);

    $numero=intval($numeroEjercicio)+1;
}
desconectar($conn);
if($numero <= 5){
    header("Location: http://localhost/php_test_computacional/GUI/ejercicios/ejercicio".$numero.".html");
}else{
    header("Location: http://localhost/php_test_computacional/include/ReporteUsuario.php");
}
exit();
?>