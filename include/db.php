<?php
/**
 * @throws mysqli_sql_exception
 */

// we connect to localhost:80

function conectar (){
    $conn = mysqli_connect("localhost", "root", "root", "test_computacional");
    if (!isset($conn)) {

        throw  new mysqli_sql_exception("no se conecto a la base de datos");
    }

    return $conn;
}

try {
     conectar();

} catch (mysqli_sql_exception $e) {
    echo 'No se pudo conectar a la base de datos: ',  $e->getMessage(), "\n";
}

function desconectar($conn){
    mysqli_close($conn);
}
?>