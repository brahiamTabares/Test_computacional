<?php
// we connect to localhost:80
function conectar (){
    $conn = mysqli_connect("localhost", "root", "root", "test_computacional");
    if (!isset($conn)) {
/// error
        echo "no se conecto";
    }

    return $conn;
}

function desconectar($conn){
    mysqli_close($conn);
}
?>