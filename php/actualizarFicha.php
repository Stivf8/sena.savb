<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['NumeroFicha_m'])){

			   $NumeroFicha=$_POST['NumeroFicha_m'];
            $etapaFormacion=$_POST['etapaFormacion_m'];
            $jornada=$_POST['jornada_m'];
            $nombrePrograma=$_POST['nombrePrograma_m'];
            $trimestre=$_POST['trimestre_m'];


     	$updateFicha=$conexion->query("UPDATE ficha SET etapaFormacion_fic='$etapaFormacion', jornada_fic='$jornada', nombrePrograma_fic='$nombrePrograma', trimestre_fic='$trimestre' WHERE numero_fic='$NumeroFicha'");

		$selectFicha=$conexion->query("SELECT MAX(id_fic) FROM ficha WHERE numero_fic='$NumeroFicha'");

		$arrDatos=$selectFicha->fetchAll();
      echo $trimestre;
		//print_r($arrDatos);


	}
//no hago nada
}

?>