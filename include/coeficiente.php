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
            <optgroup label="Preguntas">
        <option value="P1" selected> Pregunta 01 </option>
        <option value="P2"> Pregunta 02 </option>
        <option value="P3"> Pregunta 03 </option><!-- Opción por defecto -->
    </select>
</div>
<div>
    <!-- Lista de selección -->
    Y:
    <select name="comboY">
        <!-- Opciones de la lista -->
        <optgroup label="Ejercicios">
            <option value="E1"selected> Ejercicio 01 </option>
            <option value="E2"> Ejercicio 02 </option>
            <option value="E3"> Ejercicio 03 </option>
            <option value="E4"> Ejercicio 04 </option>
            <option value="E5"> Ejercicio 05 </option>
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

    if(substr( $valorX, 0,1  ) == 'E'){
        $consultaX = "select puntuacion from resultado where ejercicio='$valorX';";
    }else{
        $consultaX = "select puntuacion from calificacion where pregunta='$valorX';";
    }
    if(substr( $valorY, 0,1  ) == 'E'){
        $consultaY = "select puntuacion from resultado where ejercicio='$valorY';";
    }else{
        $consultaY = "select puntuacion from calificacion where pregunta='$valorY';";
    }

    $variable= trader_correl($consultaX,$consultaY);

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
    <label><?php echo $variable;?></label>
</div>
</body>
</html>
