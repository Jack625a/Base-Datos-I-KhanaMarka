<?php
    $servidor="localhost";
    $usuario="root";
    $password="";
    $dbname="basedatosi";

    //Crear la conexion
    $conexion=new mysqli($servidor,$usuario,$password,$dbname);

    //Verificar la conexion
    if($conexion->connect_error){
        die("Conexion Fallida ".$conexion->connect_error);
    }


    //Verificar si se han enviado datos del formulario ,metodo de uso es POST
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Recibir los datos del formulario que el usario ingresara
        $nombre=$_POST["nombre"];
        $precio=$_POST["precio"];
        $imagen=$_POST["imagen"];


        //Armar la consulta SQL para la insercion de datos
        $sql="INSERT INTO productos (Nombre, Precio, Imagen) VALUES ('$nombre','$precio','$imagen')";


        if($conexion->query($sql)===TRUE){
            //echo "Producto agregado correctamente";
            header("Location:producto.php");
            exit;
        }else{
            echo "Error al agregra el producto";
        }
    }

    $conexion->close();
?>