<?php
include 'db.php';

      $conn=conectar();

             if (isset($_POST['guardar_usuario'])) {

                 $nombre = $_POST['nombre'];
                 session_id($_POST['cedula']);
                 session_start();
                 $id = session_id();

                 $query = "INSERT INTO usuario(`id`, `nombre`) VALUES ('$id', '$nombre');";
                 mysqli_query($conn, $query);
             }


      desconectar($conn);
header("Location: http://localhost/php_test_computacional/GUI/ejercicios/ejercicio1.html");
exit();
?>