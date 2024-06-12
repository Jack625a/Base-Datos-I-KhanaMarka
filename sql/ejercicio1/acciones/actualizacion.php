<?php include '../conexion.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizacion</title>
</head>
<body>
    <?php include '../navegacion.php';?>
</body>
<div class="container">
<h1>Formulario de Actualizacion</h1>
    <form method="post"> 
        <label for="id_actualizar">Selecciona el producto a actualizar</label>
        <select name="id_actualizar" id="id_actualizar">
           <?php 
            //Consulta SQL para obtener todos los productos (id, nombre)
            $sql = "SELECT id, nombre FROM productos";
            $resultado=$conexion->query($sql);
            if($resultado->num_rows>0){
                while($fila=$resultado->fetch_assoc()){
                    echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                }
            }
           ?>
        </select> 
        <button type="submit" name="mostrar_datos">Mostrar Datos del Proucto</button>
    </form>
    <?php
        //Logica para mostras los datos del producto seleccionado en el formulario
        if(isset($_POST['mostrar_datos'])){
          $id_actualizar=$_POST['id_actualizar'];
          //echo $id_actualizar;
            //Consulta SQL PARA OBTENER LOS DATOS DEL PRODUCTO SELECCIONADO
           $sql_datos="SELECT * FROM productos WHERE id= $id_actualizar";
           $resultado_datos=$conexion->query($sql_datos);
           if($resultado_datos->num_rows>0){
            $fila_seleccion=$resultado_datos->fetch_assoc();
            //Logica para mostar los datos del producto seleccionado en el formulario de actualizacion
            //echo "Nombre: ".$fila_seleccion['Nombre']. "<br>";
            //echo "Precio: ".$fila_seleccion['Precio']."<br>";
            //echo "Imagen: <img src='".$fila_seleccion['Imagen']. "'><br>";
            //Insertar los datos obtenidos en un formularios
            echo "<h2>Actualizar Producto</h2>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='id_actualizar' value='".$fila_seleccion['id']."'><br>";
            echo "Nombre: <input type='text' name='nombre' value='".$fila_seleccion['Nombre']."'><br><br>";
            echo "Precio: <input type='number' name='precio' value='".$fila_seleccion['Precio']."'><br><br>";
            echo "Imagen: <img src='".$fila_seleccion['Imagen']. "' width='200px height='300px''><br>";
            echo "Actualizar Imagen: <input type='text' name='imagen' value='".$fila_seleccion['Imagen']."'><br><br>";
            echo "<button type='submit' name='actualizar'>Actualizar Producto</button>";
            echo "</form>";
           }else{
        echo "Error no se encontro el producto buscado...";
       }
    }
    
       //Logica para actualizar el producto
       if(isset($_POST['actualizar'])){
        $id_actualizar=$_POST['id_actualizar'];
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $imagen=$_POST['imagen'];

        //Consulta SQL para actualizar el producto
        $sql_actualizar="UPDATE productos SET Nombre='$nombre', Precio='$precio', Imagen='$imagen' WHERE id=$id_actualizar";
        
        if($conexion->query($sql_actualizar)===TRUE){
            echo "Producto Actualizado Correctamente";
        }else{
            echo "Error al actualizar ".$conexion->error;
        }
    
    }

    ?>
    




</div>

</html>