<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<style>
    .cardView{
        border: 1px solid #ccc;
        border-radius: 15px;
        padding: 15px;
        margin: 15px;
        width: 250px;
        height: 300px;
        display: inline-block;
        text-align: center;
    }
    .cardView img{
        width: 100%;
        height: 200px;
    }
    .cardView:hover{
        height: 350px;
    }
</style>
<body>
    

    <?php
    //Conexion con la base de datos
    $servername="localhost";
    $user="root";
    $password="";
    $dbname="basedatosi";

    $conexion=new mysqli($servername,$user,$password,$dbname);

    //Comprobar la conexion a la base de datos
    if ($conexion->connect_error){
        die("Error conexion fallida: ".$conexion->connect_error);
    }
    //Realizar la consulta SQL para obtener todos los procutos
    $sql="SELECT * from productos";
    $resultado=$conexion->query($sql);

    if($resultado->num_rows>0){
        //Armar los productos en tarjetas o CARDVIEWS
        while($fila=$resultado->fetch_assoc()){
            echo "<div class='cardView'>";
            echo "<img src='".$fila["Imagen"]."'alt=''>";
            echo "<h3>". $fila["Nombre"]."</h3>";
            echo "<p>".$fila["Precio"]."Bs</p>";
            echo "</div>";
        }
    }else{
        echo "No se tiene ningun producto registrado";
    }

    //Cerramos la conexion
    $conexion->close();

    ?>

<h2>Agregar nuevo Producto</h2>
<form action="insercion.php" method="POST">
    <label for="nombre">Nombre Producto: </label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="precio">Precio Producto: </label>
    <input type="number" id="precio" name="precio"><br><br>
    <label for="imagen">Url imagen Producto: </label>
    <input type="text" id="imagen" name="imagen">
    <br><br>
    <input type="submit" value="Agregar nuevo Producto">


</form>


</body>

</html>