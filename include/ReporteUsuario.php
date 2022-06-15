<?php
include 'db.php';
$conn=conectar();
session_start();
$id=session_id();
$consulta = "select ejercicio, puntuacion from resultado where Usuario_id=$id;";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Reporte del usuario</title>
    <link rel="stylesheet" href="../GUI/ejercicios/styles/styleReporteUsuario.css">
</head>
<body>
<div id="principal">
<h3>Resultados</h3><br>
<!-- Formulario simple que enviará una petición POST -->
<form class="form-reporte" action="../GUI/encuesta/encuesta.html" method="POST">
        <table >
            <thead>
                <tr >
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

        <tr class="body-tr">
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


    <input class="boton"type="submit" value="Realizar encuesta" style="margin-top: 4px" name="realizar_encuesta">
</form>
    </div>
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