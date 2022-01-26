<?php
//se referencia el archivo que conesta con la BD
    require_once "conexion.php";
    //Se nombra una variable id que traera el id del POST en el archivo en JS
    $id=$_POST['id'];
    //Se crea la variable estado y se le asigna el valor 1
    $estado= 1;
    //Realmente el dato no se3 elimina, solo se edita, se le cambia el estado a 1 para que este ya no aparezca en las consultas
    $eliminar= $conexion->query("UPDATE funcionario set status='$estado' where id_fun= '$id'");
    
?>