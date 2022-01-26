<?php
//Aqui definimos una variable que nos trae  $_SESSION['misession'] que la trae desde index.php
session_start();
// aqui llamamos la conexion con DB que esta subida en Xampp
require_once "conexion.php";
// este metodo nos ayuda a que la variables que esten nula no nos muestre error undefined variable
    error_reporting(0);
//Aqui trae el post que nos envia una cadena desde el  funcion.js 
    $id= $_POST['id'];
    $titulo=$_POST['titulo'];
    $contenido= $_POST['contenido'];
    if (is_array($_FILES) && count($_FILES)>0) {
        if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../imagenes/".$_FILES["imagen"]["name"])){
            echo 1;
        }
    }
    $img='imagenes/'.$_FILES["imagen"]["name"];
//aqui validamos por medio de una condicion, si la variable $img esta vacia o no
    if (/*empty($img) &&*/ count($_FILES)==0) {
        $actualizar= $conexion->query("UPDATE noticia set titulo_not ='$titulo', contenido_not='$contenido' where id_not='$id'");
        $busqueda= $conexion->query("SELECT * FROM noticia WHERE id_not= '$id'");
        $arrDatos=$busqueda->fetchAll();
    //aqui mostramos el resultado del arreglo que se creo en la linea 17
        print_r($arrDatos);
    }else{
        $actualizar= $conexion->query("UPDATE noticia set titulo_not ='$titulo', contenido_not='$contenido', img_not='$img' where id_not='$id'");
        $busqueda= $conexion->query("SELECT * FROM noticia WHERE id_not= '$id'");
        $arrDatos=$busqueda->fetchAll();
        print_r($arrDatos);
    }

?>