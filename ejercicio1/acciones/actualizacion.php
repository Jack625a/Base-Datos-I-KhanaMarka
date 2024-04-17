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
          echo $id_actualizar;
            //Consulta SQL PARA OBTENER LOS DATOS DEL PRODUCTO SELECCIONADO
           $sql_datos="SELECT * FROM productos WHERE id= $id_actualizar";
           $resultado_datos=$conexion->query($sql_datos);
           if($resultado_datos->num_rows>0){
            $fila_seleccion=$resultado_datos->fetch_assoc();
            //Logica para mostar los datos del producto seleccionado en el formulario de actualizacion
            echo "Nombre: ".$fila_seleccion['Nombre']. "<br>";
            echo "Precio: ".$fila_seleccion['Precio']."<br>";
            echo "Imagen: <img src='".$fila_seleccion['Imagen']. "'><br>";
           }
        //
    }else{
        echo "Error";
       }
    ?>




</div>

</html>