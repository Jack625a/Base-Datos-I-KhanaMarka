<?php
    //Configurar los parametros del servidor
    $servidor="localhost";
    $usuario="root";
    $password="";
    $dbname="basedatosi";

    //Configurar la conexion
    //Crear la conexion
    $conexion=new mysqli($servidor,$usuario,$password,$dbname);

    //Verificar la conexion
    if ($conexion->connect_error){
        die("Conexion Fallida");
    }
?>