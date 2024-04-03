<?php 
    //Incluimos la conexion
    include 'conexion.php';

    //Acciones para obtener los datos de Productos
    function obtenerProductos($conexion){
        $sql="SELECT * FROM productos";
        $resultado=$conexion->query($sql);
        $productos=[];
        if ($resultado->num_rows>0){
            while($fila=$resultado->fetch_assoc()){
                $productos[]=$fila;
            }
        }
        return $productos;
    }

$productos=obtenerProductos($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./public/estilos.css">
</head>
<body>
    <h1>Productos Disponibles</h1>
    <a href="./acciones/insercion.php">Insertar Nuevo Producto</a>
    <br>
    <br>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($productos as $producto):?>       
        <tr>
            <td><?php echo $producto['id']; ?> </td>
            <td><?php echo $producto['Nombre']; ?></td>
            <td><?php echo $producto['Precio']." Bs"; ?></td>
            <td><img src="<?php echo $producto['Imagen']; ?>" class="productoImagen"></td>
            <td>
                <form method="GET" acction="actualizacion.php">
                    <input type="hidden" value="<?php echo $producto['id'] ?> ">
                    <input type="submit" value="Actualizar">
                </form>    
                <br>
                <form method="GET" acction="eliminacion.php">
                    <input type="hidden" value="<?php echo $producto['id'] ?> ">
                    <input type="submit" value="Eliminar">
                </form>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>