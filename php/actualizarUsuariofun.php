<?php
//Se verifica la sesion
session_start();
//Se referencia el archivo que conesta con la BD
require_once "conexion.php";
    error_reporting(0);
    //Se asigna a cada valor traido del POST en una variable
    $id= $_POST['id_fun'];
    $documento=$_POST['documento_fun'];
    $tipoDoc= $_POST['tipoDoc_fun'];
    $nombre= $_POST['nombre_fun'];
    $apellido= $_POST['apellido_fun'];
    $correo= $_POST['correoSena_fun'];
    $celular= $_POST['celular_fun'];
    $cargo= $_POST['cargo_fun'];
    $sangre= $_POST['tipoSangre_fun'];
    $eps= $_POST['eps_fun'];
    $genero= $_POST['genero_fun'];
        //Se hace el update de la tabla instructor, en cada campo el valor que se asigna es el contenido en cada variable
        $actualizar= $conexion->query("UPDATE funcionario set documento_fun ='$documento', tipoDoc_fun='$tipoDoc', nombre_fun='$nombre',
        apellido_fun='$apellido', correoSena_fun='$correo', celular_fun='$celular', cargo_fun='$cargo', tipoSangre_fun='$sangre', eps_fun='$eps',
        genero_fun='$genero' where id_fun='$id'");
        //consulta todos los datos del registro que se acaba de hacer y los vuarda en un array
        $busqueda= $conexion->query("SELECT * FROM funcionario WHERE id_fun= '$id'");
        $arrDatos=$busqueda->fetchAll();
        print_r($arrDatos);
   

?>