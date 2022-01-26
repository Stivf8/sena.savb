'use strict'

//local Storage se utiliza para guardar datos como la session en la web


//Comprobar disponibilidad del local Storage
if(typeof(Storage)!=='undefined'){
    console.log("Locale Storage Disponible");
}else{
    console.log("Locale Storage NO Disponible");
}

//Guardar datos en el LS

localStorage.setItem("titulo","prueba de almacenamiento")

//recuperar el elemento

var piepagina=(localStorage.getItem("titulo"));
console.log(piepagina);

//borrar datos del localstorage

localStorage.removeItem("item"); //se puede hacer el removeItem.Clear

//fecha inicio de sesion

var fecha = new Date();
/*
var año=fecha.getFullYear();
var mes=fecha.getMonth();
var dia=fecha.getDate();
var hora=fecha.getHours();
*/
