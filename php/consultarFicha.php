<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['consultaFicha'])){


		$consultaFicha=$_POST['consultaFicha'];

		$selectFichaExistente=$conexion->query("SELECT * FROM ficha WHERE numero_fic='$consultaFicha'");

		$arrDatos=$selectFichaExistente->fetchAll();

		foreach ($arrDatos as $data) {
			$id_fic=$data['id_fic'];
			$ficha=$data['numero_fic'];
			$etapaFormacion=$data['etapaFormacion_fic'];
			$jornada=$data['jornada_fic'];
			$nombrePrograma=$data['nombrePrograma_fic'];
			$trimestre=$data['trimestre_fic'];

		}

		if($id_fic!=""){
			$resultado='ok';
		}else{
			$resultado='fail';
		}
		$datos=$id_fic.'||'.$ficha.'||'.$etapaFormacion.'||'.$jornada.'||'.$nombrePrograma.'||'.$trimestre.'||'.$resultado;
		echo $datos;
		//echo $id_fic;
		//json_encode($arrDatos);
		//print_r($arrDatos);

	}
}
?>