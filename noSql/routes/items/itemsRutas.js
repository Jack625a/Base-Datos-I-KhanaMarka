//Importar los modulos a utilizar
const express=require('express');
const Airtable=require('airtable');
const rutas=express.Router();
const path=require('path')


//Paso Extra seguridad de datos sensibles de la base de datos
require('dotenv').config();
//Configuracion de la base de datos
//Paso 3. Configuracion de Airtable
const base=new Airtable({
    apiKey:process.env.AIRTABLE_API_KEY
}).base(process.env.AIRTABLE_BASE_ID);

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
rutas.post('/',(req,res)=>{
    const nuevoProducto={
        Nombre:req.body.nombre,
        Precio:req.body.precio,
        Imagen:req.body.imagen
    };
    base('Productos').create(nuevoProducto, (error, registros)=>{
        if(error){
            res.status(500).send('<script>alert("Error al conectar el servidor con airtable"); window.history.back();</script>');
        } else{
            res.status(201).send(`
                <script>
                    alert('Producto agregado: ${nuevoProducto.Nombre}');
                    window.location.href="/";
                    
                </script>
                
                `);
        }
    });
});

//Ruta para Actualizar un producto
rutas.put('/:id',(req,res)=>{
    const {id}=req.params;
    const {nombre,precio,imagenUrl}=req.body;
    base('Productos').update(id,{nombre,precio,imagenUrl},(error,registros)=>{
        if(error){
            res.status(500).json({error:'Error al actualizar el Producto'});
        }else{
            res.json(registros.fields);
        }
    });

});

//Ruta para Eliminar un Producto
rutas.delete('/:id', (req,res)=>{
    const {id}=req.params;
    base('Productos').destroy(id,(error)=>{
        if(error){
            res.status(500).json({error: 'Error al eliminar el producto'});
        } else{
            res.json({mensaje:'Producto eliminado correctamente'});
        }
    });
});


//Exportar las ruta para todo el proyecto
module.exports=rutas;