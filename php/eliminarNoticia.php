<?php
    require_once "conexion.php";

    $id=$_POST['id'];
    $estado= 0;
    $eliminar= $conexion->query("UPDATE noticia set status='$estado' where id_not= '$id'");
    
?>