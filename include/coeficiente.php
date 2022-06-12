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
                <option value="P3" selected> Pregunta 03 </option><!-- Opción por defecto -->
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
    //$arregloX= array(2,4,5,6,4,7,8,5,6,7);
    //$arregloY= array(3,2,6,5,3,6,5,4,4,5);
    //$arregloX= array(3,6,9);
    //$arregloY= array(70,75,80);
    $arregloX=[];
    $arregloY=[];

    //Obtener las consultas
    $consultaX = "select puntuacion from resultado where ejercicio='$valorX';";
    $consultaY = "select puntuacion from calificacion where pregunta='$valorY';";

    //Traer los datos de la bases de datos y meterlos en un array
    if ($resultadoX = mysqli_query($conn, $consultaX)) {
        $i=0;
        while ($filaX = mysqli_fetch_row($resultadoX)) {
            $arregloX[$i]=$filaX[0];
            $i++;
        }
    }

    if ($resultadoY = mysqli_query($conn, $consultaY)) {
        $j=0;
        while ($filaY = mysqli_fetch_row($resultadoY)) {
            $arregloY[$j]=$filaY[0];
            $j++;
        }
    }

    $longitudX = obtenerLongitud($arregloX);
    $longitudY = obtenerLongitud($arregloY);

    $mediaX=obtenerMedia($arregloX,$longitudX);
    $mediaY=obtenerMedia($arregloY,$longitudY);

    $sumatoria=obtenerSumatoria($mediaX,$arregloX,$mediaY,$arregloY);

    $sumatoriaX=obtenerSumatoriaCuadrada($mediaX,$arregloX);
    $sumatoriaY=obtenerSumatoriaCuadrada($mediaY,$arregloY);

    $correlacion=$sumatoria/sqrt($sumatoriaX*$sumatoriaY);
    echo $correlacion;
}
function obtenerLongitud($arreglo){
 return count($arreglo);
}

function obtenerMedia($arreglo,$longitud){
    $valor=0;
    for ($i=0; $i < count($arreglo);$i++){
       $valor=$valor + $arreglo[$i];
    }
    return $valor/$longitud;
}
function obtenerSumatoria($mX,$arregloX,$mY,$arregloY){
    $suma=0.0;
    for ($i=0; $i < count($arregloX);$i++){
        $suma=$suma + (($arregloX[$i]-$mX)*($arregloY[$i]-$mY));
    }
    return $suma;
}

function obtenerSumatoriaCuadrada($media,$arreglo){
    $suma=0.0;


    for ($i=0; $i < count($arreglo);$i++){
        $aux=($arreglo[$i]-$media)*($arreglo[$i]-$media);
        $suma=$suma+$aux;
    }
    return $suma;
}

desconectar($conn);
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
