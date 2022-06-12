<?php
include 'db.php';


/**
 * @throws Exception
 */
       $conn=conectar();
       if (isset($_POST['guardar_usuario'])) {

           $nombre = $_POST['nombre'];
           session_id($_POST['cedula']);
           session_start();
           $id = session_id();
           $bandera=false;


           $consulta = "select id from usuario;";

           if ($resultado = mysqli_query($conn, $consulta)) {

               /* obtener el array asociativo */
               while ($fila = mysqli_fetch_row($resultado)) {
                   if($id==$fila[0]){
                        $bandera=true;
                     break;
                   }
               }

           }
           if($bandera){

               header("Location: http://localhost/php_test_computacional/GUI/");
           }else{
               $query = "INSERT INTO usuario(`id`, `nombre`) VALUES ('$id', '$nombre');";
               mysqli_query($conn, $query);
               header("Location: http://localhost/php_test_computacional/GUI/ejercicios/ejercicio1.html");
           }
           desconectar($conn);



       }

exit();
?>