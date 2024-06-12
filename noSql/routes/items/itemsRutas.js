//Importar los modulos a utilizar
const express=require('express');
const Airtable=require('airtable');
const rutas=express.Router();

//Configuracion de la base de datos
//Paso 3. Configuracion de Airtable
const base=new Airtable({
    apiKey:'patkAFH28nwoCbAPB.273dd25460a96ff17cdda14e39d69a5099ccf847d086680a7e8fa566ec91a011'
}).base('apprHlbsmZxhsRzEt');

//Armar las rutas
//RUTA PARA OBTENER LOS REGISTROS
rutas.get('/',(req,res)=>{
    const items=[];
    base('Productos').select({
        view:'Grid view'
    }).eachPage((records, fetchNextPage)=>{
        records.forEach(record=>{
            items.push(record.fields);
        });
        fetchNextPage();
    }, error=>{
        if(error){
            res.status(500).json({error:'Error al obtener los registros de Airtable'});
        }else{
            res.json(items);
        }
    });
});
//Ruta para crear un nuevo producto

//Ruta para Actualizar un producto

//Ruta para Eliminar un Producto


//Exportar las ruta para todo el proyecto
module.exports=rutas;