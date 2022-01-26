'use strict'

window.addEventListener('load', function(){
    // Valida DOM console.log("Dom CARGADO!");

    var formularioInicioSesion = document.querySelector("#formularioInicioSesion")

    formularioInicioSesion.addEventListener('submit',function(){
        console.log("evento submit capturado");

        var usuario = document.querySelector("#documentoUser").value;   
        var pass = document.querySelector("#passUser").value;
        var tipoRol =document.querySelector("#tipoRol").value;

        if(usuario.trim()==null || usuario.trim().length==0)
        {
            alert("Por favor ingresa el usuario");
            return false;
        }
        if(pass.trim()==null || pass.trim().length==0)
        {
            alert("Por favor ingresa la Contraseña");
            return false;
        }
       // console.log(usuario,pass,tipoRol);
    });
});