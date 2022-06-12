<?php
include 'db.php';
$conn=conectar();
//Promedio global por cada ejercicio del test
$consulta1 = "SELECT ejercicio, AVG(resultado.puntuacion) FROM test_computacional.resultado 
            GROUP BY ejercicio ORDER BY 1;";

// Número de respuestas correctas e incorrectas por ejercicio de todos los usuarios
$consulta2 = "SELECT r1.ejercicio Ejercicio, COUNT(r2.puntuacion) Correcto, COUNT(r3.puntuacion) Incorrecto
FROM test_computacional.resultado r1 left join test_computacional.resultado r2 on r1.id =
r2.id and r2.puntuacion = '1' left join test_computacional.resultado r3 on r1.id = r3.id and r3.puntuacion = '0'
GROUP BY r1.ejercicio
ORDER BY 1;";

// Listado ordenado de los usuarios (mayor a menor) con base en la nota del test.
$consulta3 = "SELECT Usuario_id, SUM(puntuacion) Puntaje
FROM test_computacional.resultado  GROUP BY Usuario_id ORDER BY 2 DESC;";

//Promedio de cada una de las respuestas de la encuesta de los usuarios.
$consulta4 = "SELECT pregunta, AVG(calificacion.puntuacion) FROM test_computacional.calificacion
GROUP BY pregunta ORDER BY 1;";
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <center>
    <h1>Reportes Generales</h1>
    <!-- Formulario simple que enviará una petición POST -->
    <form action="../include/coeficiente.php" method="POST">
        <div>
            <br><h3>Promedio global por cada ejercicio del test</h3>
        <table style="border: solid">
            <thead>
            <tr>
                <th>Ejercicio</th>
                <th>Promedio</th>

            </tr>
            </thead>
            <tbody>
            <?php
            if ($resultado1 = mysqli_query($conn, $consulta1)) {

            /* obtener el array asociativo */
            while ($fila = mysqli_fetch_row($resultado1)) {?>
            <tr>
                <td><?php echo "Ejercicio ".substr( $fila[0], -1  )?></td>
             <td><center><?php echo $fila[1]?></center></td>
                </tr>
        <?php
    }
                /* liberar el conjunto de resultados */
                mysqli_free_result($resultado1);
            }
    ?>
            </tbody>
        </table>
                </div>

                <div>
                    <br><h3>Número de respuestas correctas e incorrectas por ejercicio de todos los usuarios</h3>
                <table style="border: solid">
                <thead>
                <tr>
                    <th>Ejercicio</th>
                    <th>Correctas</th>
                    <th>Incorrectas</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if ($resultado2 = mysqli_query($conn, $consulta2)) {

                    /* obtener el array asociativo */
                    while ($fila = mysqli_fetch_row($resultado2)) {?>
                        <tr>
                            <td><?php echo "Ejercicio ".substr( $fila[0], -1  )?></td>
                            <td><center><?php echo $fila[1]?></center></td>
                            <td><center><?php echo $fila[2]?></center></td>
                        </tr>
                        <?php
                    }
                    /* liberar el conjunto de resultados */
                    mysqli_free_result($resultado2);
                }
                    ?>
                    </tbody>
                    </table>
                    </div>

        <div>
            <br><h3>Listado ordenado de los usuarios (mayor a menor) con base en la nota del test</h3>
            <table style="border: solid">
                <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Puntaje</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if ($resultado3 = mysqli_query($conn, $consulta3)) {

                    /* obtener el array asociativo */
                    while ($fila = mysqli_fetch_row($resultado3)) {?>
                        <tr>
                            <td><center><?php echo $fila[0]?></center></td>
                            <td><center><?php echo $fila[1]?></center></td>

                        </tr>
                        <?php
                    }
                    /* liberar el conjunto de resultados */
                    mysqli_free_result($resultado3);
                }
                ?>
                </tbody>
            </table>
        </div>

        <div>
            <br><h3>Promedio de cada una de las respuestas de la encuesta de los usuarios</h3>
            <table style="border: solid">
                <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Calificación</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if ($resultado4 = mysqli_query($conn, $consulta4)) {

                    /* obtener el array asociativo */
                    while ($fila = mysqli_fetch_row($resultado4)) {?>
                        <tr>
                            <td><?php echo "Pregunta ".substr( $fila[0], -1  )?></td>
                            <td><center><?php echo $fila[1]?></center></td>

                        </tr>
                        <?php
                    }
                    /* liberar el conjunto de resultados */
                    mysqli_free_result($resultado4);
                }
                ?>
                </tbody>
            </table>
        </div>
        <input type="submit" value="Coeficiente de correlación" style="margin-top: 4px" name="realizar_coeficiente">
    </form>
</center>
    </body>
    </html>



<?php
/* cerrar la conexión */
desconectar($conn);
?>