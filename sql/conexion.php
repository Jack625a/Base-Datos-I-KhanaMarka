<?php
    //PASO 1. variables para conectar al servidor
    $servidor='localhost';
    $usuario='root';
    $password='';
    $dbname='basedatosi';


    //PASO 2. Crear la conexion
    $conexion=new mysqli($servidor,$usuario,$password,$dbname);

    //PASO 3. Verificar la conexion
    if($conexion->connect_error){
        die("Error al conectar con la base de datos!!");
    }

    //PASO 4. Realizar las consultas SQL 
    //Mostrar todos los datos de la tabla estudiante
    $sql="SELECT * FROM estudiantes";
    $resultado=$conexion->query($sql);

    if($resultado->num_rows>0){
        //PASO 5. IMPRIMIR EN PANTALLA LOS REGISTROS
        while($fila=$resultado->fetch_assoc()){
            echo "Id: ",$fila["id"];
            echo "<br>";
            echo "Nombre: ",$fila["nombre"], " - Edad: ",$fila["edad"];
            echo "<br>";
            echo "Correo: ",$fila["correo"];
            echo "<br> <br>";
        }
    }else{
        echo "No se encontraron registros de los estudiantes...";
    }

//PASO 6. Cerra la conexion

$conexion->close();
?>