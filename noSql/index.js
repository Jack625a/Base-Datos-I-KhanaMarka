//Creacion del Servidor para la base de datos
//Paso 1. Importar los modulos de express, airtable
const express=require('express');
const Airtable=require('airtable');
const bodyParser=require('body-parser');
const itemsRutas=require('./routes/items/itemsRutas');

//Paso Extra seguridad de datos sensibles de la base de datos
require('dotenv').config();

//Paso 2. Crear el servidor
const servidor=express();

//Paso 3. Configuracion de Airtable
const base=new Airtable({
    apiKey:process.env.AIRTABLE_API_KEY
}).base(process.env.AIRTABLE_BASE_ID);

//Paso 4. Configuracion del desfragmentado del JSON
servidor.use(bodyParser.urlencoded({extended:true}));
servidor.use(bodyParser.json());

//Paso5. Configurar los archivos estaticos
servidor.use(express.static('public'));

//Paso 6. Configurar Rutas 

servidor.use('/items',itemsRutas);

//Configuracion de rutas no encontradas
servidor.use((req,res)=>{
    res.status(404).send('Pagina no encontrada');
});

//Paso 7. Configurar host y el puerto del servidor
const puerto=3000;
const host='localhost';

//Paso 8. Inicializar el servidor
servidor.listen(puerto,host,()=>{
    console.log(`Servidor Activo: http://${host}:${puerto}`);
});



