<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['id_fic'])){

			   $id_fic=$_POST['id_fic'];

     	$deleteFicha=$conexion->query("DELETE FROM ficha WHERE id_fic='$id_fic'");


      echo $id_fic;

	}
//no hago nada
}

?>