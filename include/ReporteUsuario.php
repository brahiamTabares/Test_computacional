<?php
include 'db.php';
$conn=conectar();
session_start();
$id=session_id();
$consulta = "select ejercicio, puntuacion from resultado where Usuario_id=$id;";
?>
html:5
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Refresh" content="http://localhost/php_test_computacional/include/ReporteUsuario.php">
    <title>Document</title>
</head>
<body>
<center>
<h1>Resultados</h1><br>
<!-- Formulario simple que enviará una petición POST -->
<form action="../GUI/encuesta/encuesta.html" method="POST">
        <table style="border: solid">
            <thead>
                <tr>
                    <th>Ejercicio</th>
                    <th>Resultado</th>
                    <th>Puntuación</th>
                </tr>
            </thead>
            <tbody>
<?php
if ($resultado = mysqli_query($conn, $consulta)) {
    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_row($resultado)) {?>

        <tr>
                    <td><?php echo "Ejercicio ".substr( $fila[0], -1  )?></td>
                    <td><center><?php
                            if($fila[1]==0){
                                echo "Incorrecto";
                            }else{
                                echo "Correcto";
                            }
                        ?></center></td>
                    <td><center><?php echo $fila[1]?></center></td>
                </tr>
        <?php
    }
    ?>
            </tbody>
        </table>


    <input type="submit" value="Realizar encuesta" style="margin-top: 4px" name="realizar_encuesta">
</form>
    </center>
</body>
</html>
<?php
/* liberar el conjunto de resultados */
mysqli_free_result($resultado);
}

/* cerrar la conexión */
desconectar($conn);
if(isset($_POST['realizar_encuesta'])){
    header("Location: http://localhost/php_test_computacional/GUI/encuesta/encuesta.html");
}

?>