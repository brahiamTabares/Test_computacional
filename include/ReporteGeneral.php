<?php
include 'db.php';
$conn=conectar();
echo "\nPromedio por pregunta\n";
$consulta = "SELECT ejercicio, AVG(resultado.puntuacion) FROM test_computacional.resultado 
            GROUP BY ejercicio ORDER BY 1;";
if ($resultado = mysqli_query($conn, $consulta)) {

/* obtener el array asociativo */
while ($fila = mysqli_fetch_row($resultado)) {
printf ("%s (%s)\n", $fila[0], $fila[1]);
}
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}
?>


<?php
// respuestas correctas e incorrectas por ejercicio
echo "\nCorrecto e incorrecto\n";
$consulta1 = "SELECT r1.ejercicio Ejercicio, COUNT(r2.puntuacion) Correcto, COUNT(r3.puntuacion) Incorrecto
FROM test_computacional.resultado r1 left join test_computacional.resultado r2 on r1.id = 
r2.id and r2.puntuacion = '1' left join test_computacional.resultado r3 on r1.id = r3.id and r3.puntuacion = '0'
GROUP BY r1.ejercicio
ORDER BY 1;";
if ($resultado1 = mysqli_query($conn, $consulta1)) {

    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_row($resultado1)) {
        printf ("%s (%s)\n", $fila[0], $fila[1], $fila[2]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado1);
}
?>

<?php
// Listado ordenado de los usuarios (mayor a menor) con base en la nota del test.
echo "\nListado ordenado de los usuarios (mayor a menor) con base en la nota del test.\n";
$consulta3 = "SELECT Usuario_id, SUM(puntuacion) Puntaje
FROM test_computacional.resultado GROUP BY Usuario_id ORDER BY 2 DESC;";
if ($resultado3 = mysqli_query($conn, $consulta3)) {

    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_row($resultado3)) {
        printf ("%s (%s)\n", $fila[0], $fila[1]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado3);
}
?>


<?php
echo "\nPromedio de las preguntas de la encuesta\n";
$consulta4 = "SELECT pregunta, AVG(calificacion.puntuacion) FROM test_computacional.calificacion
GROUP BY pregunta ORDER BY 1;";

if ($resultado4 = mysqli_query($conn, $consulta4)) {

    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_row($resultado4)) {
        printf ("%s (%s)\n", $fila[0], $fila[1]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado4);
}
/* cerrar la conexión */
desconectar($conn);
?>