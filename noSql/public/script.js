//Configurar la funcion para mostrar los productos de la base de datos en cardview
function mostrarProductos(elementos){
    const itemList=document.getElementById("item-list");
    itemList.innerHTML=""; //Limpiar el contenido anterior

    elementos.forEach(elemento=>{
        const card=document.createElement('div');
        card.classList('card');

        const imagen=document.createElement('img');
        imagen.src=elemento.imagen;
        card.appendChild(imagen);

        const nombre=document.createElement('h3');
        nombre.textContent=elemento.nombre;
        card.appendChild(nombre);

        const precio=document.createElement('p');
        precio.textContent='Precio: '+elemento.precio+'Bs';
        card.appendChild(precio);

        itemList.appendChild(card);

    });
}
//Obtener los producto del servidor y mostrar en los cardviews
async function obtenerElementos(){
    try{
        const respuesta=await fetch('/items');
        const data=await respuesta.json();
        mostrarProductos(data)
    }catch(error){
        console.error('Error al obtener los productos', error);
    }
}
//llamar a la funcion para obtener y mostrar los productos
window.addEventListener('DOMContentLoaded',obtenerElementos);