<?php
//Se verifica la sesion
session_start();
//Se referencia el archivo que conesta con la BD
require_once "conexion.php";
    error_reporting(0);
    if (isset($_POST['documento_ins'])&&
isset($_POST['nombre_ins'])&&
isset($_POST['apellido_ins'])&&
isset($_POST['contrasena'])&&
isset($_POST['titulo_ins'])&&
isset($_POST['ficha'])&&
isset($_POST['correoSena_ins'])&&
isset($_POST['celular_ins'])&&
isset($_POST['tipoSangre_ins'])&&
isset($_POST['genero_ins'])&&
isset($_POST['eps_ins'])) {
    //Se asigna a cada valor traido del POST en una variable
    $rol=$_POST['rol'];
    $documento=$_POST['documento_ins'];
    $tipoDoc= $_POST['tipoDoc_ins'];
    $nombre= $_POST['nombre_ins'];
    $apellido= $_POST['apellido_ins'];
    $correo= $_POST['correoSena_ins'];
    $celular= $_POST['celular_ins'];
    $titulo= $_POST['titulo_ins'];
    $ficha= $_POST['ficha'];
    $contrasena= $_POST['contrasena'];
    $sangre= $_POST['tipoSangre_ins'];
    $eps= $_POST['eps_ins'];
    $genero= $_POST['genero_ins'];
        //Se realiza un insert en la tabla usuario, para insertar el rol, el numero de documento y la contraseña, los cuales estan almacenados en cada variable
$resultado = $conexion->query("Insert into usuario(Rol_id_rol, Usuario, contrasena_usu) values ('$rol', '$documento', '$contrasena')");


//Se realiza un select, el cual nos traera el id autoincrementable del registro que acabamps de hacer en la tabla usuarios
$idUsu_con = $conexion->query("Select id_usu from usuario where Usuario = '$documento'");
$consultas=$idUsu_con->fetchAll(PDO::FETCH_OBJ);
foreach ($consultas as $consulta) {
$id_usu= $consulta->id_usu;
}

//Se realiza otro select para conocer el id de la ficha que se selecciono
$idFicha_con = $conexion->query("Select id_fic from ficha where numero_fic = '$ficha'");
$consultas1=$idFicha_con->fetchAll(PDO::FETCH_OBJ);
foreach ($consultas1 as $consulta1) {
$id_ficha= $consulta1->id_fic;
}
//Ahora se hace otro insert en la tabla instructor, se insertaran todos los datos que tenemos e incluso los dos id que acabamos de consultar
$resultado2 = $conexion->query("Insert into instructor(Ficha_id_fic, Usuario_id_usu, documento_ins, tipoDoc_ins,
nombre_ins, apellido_ins, correoSena_ins, celular_ins, titulo_ins, tipoSangre_ins, eps_ins, genero_ins) 
values ('$id_ficha', '$id_usu', '$documento', '$tipoDoc', '$nombre', '$apellido', '$correo', '$celular',
'$titulo', '$sangre', '$eps', '$genero')");
}else{
    echo'No entre al if';
}
        

?>