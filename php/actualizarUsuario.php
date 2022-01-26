<?php
//Se verifica la sesion
session_start();
//Se referencia el archivo que conesta con la BD
require_once "conexion.php";
    error_reporting(0);
    //Se asigna a cada valor traido del POST en una variable
    $id= $_POST['id_ins'];
    $documento=$_POST['documento_ins'];
    $tipoDoc= $_POST['tipoDoc_ins'];
    $nombre= $_POST['nombre_ins'];
    $apellido= $_POST['apellido_ins'];
    $correo= $_POST['correoSena_ins'];
    $celular= $_POST['celular_ins'];
    $titulo= $_POST['titulo_ins'];
    $sangre= $_POST['tipoSangre_ins'];
    $eps= $_POST['eps_ins'];
    $genero= $_POST['genero_ins'];
        //Se hace el update de la tabla instructor, en cada campo el valor que se asigna es el contenido en cada variable
        $actualizar= $conexion->query("UPDATE instructor set documento_ins ='$documento', tipoDoc_ins='$tipoDoc', nombre_ins='$nombre',
        apellido_ins='$apellido', correoSena_ins='$correo', celular_ins='$celular', titulo_ins='$titulo', tipoSangre_ins='$sangre', eps_ins='$eps',
        genero_ins='$genero' where id_ins='$id'");
        //consulta todos los datos del registro que se acaba de hacer y los vuarda en un array
        $busqueda= $conexion->query("SELECT * FROM instructor WHERE id_ins= '$id'");
        $arrDatos=$busqueda->fetchAll();
        print_r($arrDatos);
   

?>