<?php
//Se verifica la sesion
session_start();
//Se referencia el archivo que conesta con la BD
require_once "conexion.php";
    error_reporting(0);
    if (isset($_POST['documento_fun'])&&
isset($_POST['nombre_fun'])&&
isset($_POST['apellido_fun'])&&
isset($_POST['contrasena'])&&
isset($_POST['cargo_fun'])&&
isset($_POST['correoSena_fun'])&&
isset($_POST['celular_fun'])&&
isset($_POST['tipoSangre_fun'])&&
isset($_POST['genero_fun'])&&
isset($_POST['eps_fun'])) {
    //Se asigna a cada valor traido del POST en una variable
    $rol=$_POST['rol'];
    $documento=$_POST['documento_fun'];
    $tipoDoc= $_POST['tipoDoc_fun'];
    $nombre= $_POST['nombre_fun'];
    $apellido= $_POST['apellido_fun'];
    $correo= $_POST['correoSena_fun'];
    $celular= $_POST['celular_fun'];
    $cargo= $_POST['cargo_fun'];
    $contrasena= $_POST['contrasena'];
    $sangre= $_POST['tipoSangre_fun'];
    $eps= $_POST['eps_fun'];
    $genero= $_POST['genero_ins'];
       //Se realiza un insert en la tabla usuario, para insertar el rol, el numero de documento y la contraseña, los cuales estan almacenados en cada variable
$resultado = $conexion->query("Insert into usuario(Rol_id_rol, Usuario, contrasena_usu) values ('$rol', '$documento', '$contrasena')");

//Se realiza un select, el cual nos traera el id autoincrementable del registro que acabamps de hacer en la tabla usuarios
$idUsu_con = $conexion->query("Select id_usu from usuario where Usuario = '$documento'");
$consultas=$idUsu_con->fetchAll(PDO::FETCH_OBJ);
foreach ($consultas as $consulta) {
$id_usu= $consulta->id_usu;
}
//Ahora se hace otro insert en la tabla instructor, se insertaran todos los datos que tenemos e incluso los dos id que acabamos de consultar
$resultado2 = $conexion->query("Insert into funcionario(Usuario_id_usu, documento_fun, tipoDoc_fun,
nombre_fun, apellido_fun, correoSena_fun, celular_fun, cargo_fun, tipoSangre_fun, eps_fun, genero_fun) 
values ('$id_usu','$documento', '$tipoDoc', '$nombre', '$apellido', '$correo', '$celular',
'$cargo', '$sangre', '$eps', '$genero')");

?>