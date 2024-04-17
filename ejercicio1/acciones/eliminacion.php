<?php include '../conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminacion</title>
</head>
<body>
    <?php include '../navegacion.php'; ?>
    <br>
    <div class="container">
        <h2>Eliminacion</h2>
        <form method="post">
            <label for="id_eliminar">Seleccione el Producto a Eliminar: </label>
            <select name="id_eliminar" id="id_eliminar">
                <?php
                    //Consulta sql para obtener los id y nombres de los productos
                    $sql="SELECT id, Nombre FROM productos";
                    $resultado=$conexion->query($sql);
                    if($resultado->num_rows>0){
                        while ($fila=$resultado->fetch_assoc()){
                            echo "<option value='".$fila['id']."'>".$fila['Nombre']. "</option>";
                        }
                    }
                ?>
            </select>
            <button type="submit" name="eliminar">Eliminar Producto</button>
        </form>

    <?php
    //Logica para eliminar un producto por el id de la seleccion
    if(isset($_POST['eliminar'])){
        $id_eliminar=$_POST['id_eliminar'];
        echo $id_eliminar;

        //Consulta SQL PARA ELIMINAR UN PRODUCTO EN BASE LA SELECCION
        $sql_eliminar="DELETE FROM productos WHERE id=$id_eliminar";

        if($conexion->query($sql_eliminar)===TRUE){
            echo "Producto Eliminado correctamente";
        }else{
            echo "Error al eliminar el producto: ". $conexion->error;
        }
    }
    ?>



    </div>
    
</body>
</html>