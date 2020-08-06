<?php
class Connection {

    function getConection(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'examen';
        $conex = mysqli_connect($host, $user, $pass, $db);
        if (!$conex) {
            echo "Error en la conexion";
        }
        // else {
        //     echo "Conexion establecida";
        // }
        return $conex;
    }

}
?>