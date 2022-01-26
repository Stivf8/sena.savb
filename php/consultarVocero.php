<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['consultaVocero'])){


		$consultaVocero=$_POST['consultaVocero'];

		$selectVoceroExistente=$conexion->query("SELECT *, f.numero_fic FROM vocero v, ficha f WHERE documento_voc='$consultaVocero' AND f.id_fic=v.Ficha_id_fic");

		$arrDatos=$selectVoceroExistente->fetchAll();

		foreach ($arrDatos as $data) {
			$id_voc=$data['id_voc'];
			$Ficha_id_fic=$data['Ficha_id_fic'];
			$Usuario_id_usu=$data['Usuario_id_usu'];
			$documento_voc=$data['documento_voc'];
			$tipoDoc_voc=$data['tipoDoc_voc'];
			$nombre_voc=$data['nombre_voc'];
			$apellido_voc=$data['apellido_voc'];
			$correoPer_voc=$data['correoPer_voc'];
			$correoSena_voc=$data['correoSena_voc'];
			$telefono_voc=$data['telefono_voc'];
			$celular1_voc=$data['celular1_voc'];
			$celular2_voc=$data['celular2_voc'];
			$tipoDeSangre_voc=$data['tipoSangre_voc'];
			$eps_voc=$data['eps_voc'];
			$genero_voc=$data['genero_voc'];
			$numero_fic_c=$data['numero_fic'];
			$status=$data['status'];
			

		}

		if($id_voc!=""){
			$resultado='ok';
		}else{
			$resultado='fail';
		}
		$datos=$resultado.'||'.$id_voc.'||'.$Ficha_id_fic.'||'.$Usuario_id_usu.'||'.$documento_voc.'||'.$tipoDoc_voc.'||'.$nombre_voc.'||'.$apellido_voc.'||'.$correoPer_voc.'||'.$correoSena_voc.'||'.$telefono_voc.'||'.$celular1_voc.'||'.$celular2_voc.'||'.$tipoDeSangre_voc.'||'.$eps_voc.'||'.$genero_voc.'||'.$numero_fic_c.'||'.$status;
		echo $datos;

	}
}
?>