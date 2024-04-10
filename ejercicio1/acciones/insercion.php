<?php include '../conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insersion</title>
</head>
<body>
    <?php include '../navegacion.php'?>
    <div class="container">
    <br>
    <h1>Agregar nuevo Producto</h1>
    <form method="post">
        
        <label for="nombre">Nombre del Producto: </label>
        <input type="text" name="nombre" id="nombre" require>
        <br>
        <label for="precio">Precio Producto: </label>
        <input type="number" name="precio" id="precio" require>
        <br>
        <label for="imagen">Imagen Producto</label>
        <input type="text" name="imagen" id="imagen" require>
        <br>
        <button type="submit" name="insertar">Insertar Producto</button>
    </form>

    <?php 
        //Logica sql para insertar un nuevo producto
    if(isset($_POST['insertar'])){
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $imagen=$_POST['imagen'];
        //Crear la consulra sql para insertar nuevo resgistos
        //Armar la consulta SQL
        $sql_insertar="INSERT INTO productos(Nombre,Precio,Imagen) VALUES ('$nombre','$precio', '$imagen')";

        if($conexion->query($sql_insertar)===TRUE){
            echo "Nuevo producto agregado correctamente...";
        }else{
            echo "Error al inserta el producto: ". $conexion->error;
        }
    }
    ?>
    </div>
   
    
</body>
</html>
