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
<form action="../include/coeficiente.php" method="POST">
<div>
    <!-- Lista de selección -->
    X:
    <select name="comboX">
        <!-- Opciones de la lista -->
        <optgroup label="Ejercicios">
        <option value="E1"> Ejercicio 01 </option>
        <option value="E2"> Ejercicio 02 </option>
        <option value="E3"> Ejercicio 03 </option>
        <option value="E4"> Ejercicio 04 </option>
        <option value="E5"> Ejercicio 05 </option>
    </select>
</div>
<div>
    <!-- Lista de selección -->
    Y:
    <select name="comboY">
        <!-- Opciones de la lista -->

            <optgroup label="Preguntas">
                <option value="P1"> Pregunta 01 </option>
                <option value="P2"> Pregunta 02 </option>
                <option value="P3"> Pregunta 03 </option><!-- Opción por defecto -->
    </select>

</div>
    <input type="submit" value="calcular" style="margin-top: 4px" name="calcular_coeficiente">
</form>

</body>
</html>

<?php
include 'db.php';

$conn=conectar();
if (isset($_POST['calcular_coeficiente'])) {

    $valorX = $_POST['comboX'];
    $valorY = $_POST['comboY'];
    //Obtener las consultas
    $consultaX = "select puntuacion from resultado where ejercicio='$valorX';";
    $consultaY = "select puntuacion from calificacion where pregunta='$valorY';";

    //Obtener la media
    if ($resultadoX = mysqli_query($conn, $consultaX)) {
        $mediaX= obtenerMedia($resultadoX);
    }
    if ($resultadoY = mysqli_query($conn, $consultaY)) {
        $mediaY= obtenerMedia($resultadoY);
    }

    echo $mediaX."\n".$mediaY;
}
desconectar($conn);
function obtenerMedia($arreglo){
    $valor=0;
    $longitud=0;
    while ($fila = mysqli_fetch_row($arreglo)) {
        $valor=$valor +$fila[0];
        $longitud++;
    }
    return $valor/$longitud;
}
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
<div>

</div>
</body>
</html>
