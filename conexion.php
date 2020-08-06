<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'examen';

    $conection = @mysqli_connect($host, $user, $pass, $db);
    
    if (!$conection) {
        echo "Error en la conexion";
    }
    // else {
    //     echo "Conexion establecida";
    // }
?>