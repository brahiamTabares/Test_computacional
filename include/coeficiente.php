<?php

/**
 * Test computacional
   Brahiam David Tabares Vallejo
   Sandra Milena Quintero Leal
   Juan Alvaro Diaz Trujillo
   pagina que permite calcular el coeficiente de relacion 
*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coeficiente de correlación</title>
    <link rel="stylesheet" href="../GUI/ejercicios/styles/styleCoeficiente.css">

</head>
<body>
<form class="form-coeficiente" action="../include/coeficiente.php" method="POST">
<h3>Coeficiente de correlación</h3><br>
<h5>Responda las siguientes preguntas seleccionando un valor de [0-5].</h5><br>
        
<div id="valor">
    <!-- Lista de selecci車n -->
    <h2> Valor de X:</h2>
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
<div id="valor">
    <!-- Lista de selecci車n -->
    <h2> Valor de Y:</h2>
    <select name="comboY">
        <!-- Opciones de la lista -->
        <optgroup label="Preguntas">
               <option value="P1"> Pregunta 01 </option>
                <option value="P2"> Pregunta 02 </option>
                <option value="P3"> Pregunta 03 </option><!-- Opci車n por defecto -->
    </select>

</div>
    <input class="boton" type="submit" value="calcular coeficiente" style="margin-top: 4px" name="calcular_coeficiente">
    <p type="hidden" id="respuesta"></p>
</form>



<?php

include 'db.php';

$conn=conectar();
/**
*Por medio del boton "calcular_coeficiente"  se capturan  el ejercicio que tendra el valor de x y la pregunta que tendra el valor y,se realiza la respectiva consulta del ejercicio y la pregunta en la bases de datos para traer los valores, se traen todos los valores en un array para hacer la respectiva comparacion.   
*/
if (isset($_POST['calcular_coeficiente'])) {

    $valorX = $_POST['comboX'];
    $valorY = $_POST['comboY'];
    //$arregloX= array(2,4,5,6,4,7,8,5,6,7);
    //$arregloY= array(3,2,6,5,3,6,5,4,4,5);
    //$arregloX= array(3,6,9);
    //$arregloY= array(70,75,80);
    
   // $arregloX=[];
    //$arregloY=[];

    //Obtener las consultas
    $consultaX = "select puntuacion from resultado where ejercicio='$valorX';";
    $consultaY = "select puntuacion from calificacion where pregunta='$valorY';";

    //Traer los datos de la bases de datos y meterlos en un array
    if ($resultadoX = mysqli_query($conn, $consultaX)) {
        $i=0;
        while ($filaX = mysqli_fetch_row($resultadoX)) {
            $arregloX[$i]=intval($filaX[0]);
            $i++;
        }
    }

    if ($resultadoY = mysqli_query($conn, $consultaY)) {
        $j=0;
        while ($filaY = mysqli_fetch_row($resultadoY)) {
            $arregloY[$j]=intval($filaY[0]);
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
    
    $multiplicacion = $sumatoriaX*$sumatoriaY;
    
    if($multiplicacion==0){?>
        <script>document.getElementById('respuesta').innerHTML = '<?php echo "Invalido";?>';</script>
    <?php
    echo "invalido";
    }else{
        $correlacion=$sumatoria/sqrt($multiplicacion);
    ?>    
     <script>document.getElementById('respuesta').innerHTML = '<?php echo $correlacion;?>';</script>
<?php  
echo $correlacion;
    }
    }
    // funcion para calcular la longitud del arreglo 
function obtenerLongitud($arreglo){
 return count($arreglo);
}
// funcion para obtemer media de un fragmento de  formula del coeficiente de relacion.
function obtenerMedia($arreglo,$longitud){
    $valor=0;
    for ($i=0; $i < count($arreglo);$i++){
       $valor=$valor + $arreglo[$i];
    }
    return $valor/$longitud;
}
//Funcion para obtener la sumatoria de un fragmento de  formula del coeficiente de relacion
function obtenerSumatoria($mX,$arregloX,$mY,$arregloY){
    $suma=0.0;
    for ($i=0; $i < count($arregloX);$i++){
        $suma=$suma + (($arregloX[$i]-$mX)*($arregloY[$i]-$mY));
    }
    return $suma;
}
//Funcion para obtener la sumario cuaadrada de un fragmento de la formula de coeficente de relación.
function obtenerSumatoriaCuadrada($media,$arreglo){
    $suma=0.0;


    for ($i=0; $i < count($arreglo);$i++){
        $aux=($arreglo[$i]-$media)*($arreglo[$i]-$media);
        $suma=$suma+$aux;
    }
    return $suma;
}
//se debe desconectar la xonecion a la base de datos cuando se termina la parte de procesamiento de la pagina.
desconectar($conn);
?>


</body>
</html>
