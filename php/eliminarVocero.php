<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['Usuario_id_usu'])){

			   $Usuario_id_usu=$_POST['Usuario_id_usu'];

     	$deleteVocero=$conexion->query("DELETE FROM vocero WHERE Usuario_id_usu='$Usuario_id_usu'");

     	$deleteUsuario=$conexion->query("DELETE FROM usuario WHERE id_usu='$Usuario_id_usu'");


      echo $Usuario_id_usu;

	}
//no hago nada
}

?>