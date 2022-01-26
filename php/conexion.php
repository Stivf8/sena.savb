<?php
 try{
$conexion = new PDO('mysql:host=localhost;dbname=savb','root','');
}catch(PDOexception $e){
  echo 'Error en la conexion al Servidor de Base de Datos ' .$e->getmessage();
  die();
}
?>