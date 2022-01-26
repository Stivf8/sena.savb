function crearUsuario() {
    rol=$('#rol1').val();
    documento= $('#documento_ins1').val();
    tipoDoc= $('#tipoDoc_ins1').val();
    nombre= $('#nombre_ins1').val();
    apellido= $('#apellido_ins1').val();
    correo= $('#correoSena_ins1').val();
    celular= $('#celular_ins1').val();
    titulo= $('#titulo_ins1').val();
    ficha= $('#ficha1').val();
    contrasena= $('#contrasena1').val();
    sangre= $('#tipoSangre_ins1').val();
    eps= $('#eps_ins1').val();
    genero= $('#genero_ins1').val();

    //En una cadena se pone cada uno de estos valores y sus variables
  cadena= "rol="+ rol +
  "&documento_ins="+ documento +
  "&tipoDoc_ins="+ tipoDoc +
  "&nombre_ins="+ nombre +
  "&apellido_ins="+ apellido +
  "&correoSena_ins=" + correo +
  "&celular_ins=" + celular +
  "&titulo_ins=" + titulo +
  "&ficha=" + ficha +
  "&contrasena=" + contrasena +
  "&tipoSangre_ins=" + sangre +
  "&eps_ins=" + eps +
  "&genero_ins=" + genero;
//Se llama a la funcion ajax de jquery
$.ajax({
//Se establece el metodo POST
type: "POST",
//se conecta con el archivo actualizarUsuario en la carpeta php
url: "php/crearUsuario.php",
//y se asignan los valores de la cadena 
data: cadena,
//el parametro r sera la que reciba todos estos datos
success: function(r){
//si r no esta vacia entonces se guardan los datos en la BD
if (r!=null){
$('#usuario').load('consulta.php');
alertify.success("Creado con exito");
}else{
  //de lo contrario nos arroja que no fue actualizado
alertify.error('No fue creado');

}
//al hacer esto se recarga la pagina
location.reload();
}
});
}

function crearUsuariofun() {
    rol=$('#rol1').val();
    documento= $('#documento_fun1').val();
    tipoDoc= $('#tipoDoc_fun1').val();
    nombre= $('#nombre_fun1').val();
    apellido= $('#apellido_fun1').val();
    contrasena= $('#contrasena1').val();
    correo= $('#correoSena_fun1').val();
    celular= $('#celular_fun1').val();
    cargo= $('#cargo_fun1').val();
    sangre= $('#tipoSangre_fun1').val();
    eps= $('#eps_fun1').val();
    genero= $('#genero_fun1').val();

    //En una cadena se pone cada uno de estos valores y sus variables
  cadena= "rol="+ rol +
  "&documento_fun="+ documento +
  "&tipoDoc_fun="+ tipoDoc +
  "&nombre_fun="+ nombre +
  "&apellido_fun="+ apellido +
  "&contrasena=" + contrasena +
  "&correoSena_fun=" + correo +
  "&celular_fun=" + celular +
  "&cargo_fun=" + cargo +
  "&tipoSangre_fun=" + sangre +
  "&eps_fun=" + eps +
  "&genero_fun=" + genero;
//Se llama a la funcion ajax de jquery
$.ajax({
//Se establece el metodo POST
type: "POST",
//se conecta con el archivo actualizarUsuario en la carpeta php
url: "php/crearUsuariofun.php",
//y se asignan los valores de la cadena 
data: cadena,
//el parametro r sera la que reciba todos estos datos
success: function(r){
//si r no esta vacia entonces se guardan los datos en la BD
if (r!=null){
$('#usuario').load('funcionario.php');
alertify.success("Creado con exito");
}else{
  //de lo contrario nos arroja que no fue actualizado
alertify.error('No fue creado');

}
//al hacer esto se recarga la pagina
location.reload();
}
});
}