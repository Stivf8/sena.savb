<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['id_voc'])){

			   $id_voc=$_POST['id_voc'];
            $Ficha_id_fic=$_POST['Ficha_id_fic'];
            $Usuario_id_usu=$_POST['Usuario_id_usu'];
            $documento_voc=$_POST['documento_voc'];
            $tipoDoc_voc=$_POST['tipoDoc_voc'];
            $nombre_voc=$_POST['nombre_voc'];
            $apellido_voc=$_POST['apellido_voc'];
            $correoPer_voc=$_POST['correoPer_voc'];
            $correoSena_voc=$_POST['correoSena_voc'];
            $telefono_voc=$_POST['telefono_voc'];
            $celular1_voc=$_POST['celular1_voc'];
            $celular2_voc=$_POST['celular2_voc'];
            $tipoDeSangre_voc=$_POST['tipoDeSangre_voc'];
            $eps_voc=$_POST['eps_voc'];
            $genero_voc=$_POST['genero_voc'];
            $numero_fic_c=$_POST['numero_fic_c'];
            $status=$_POST['estado_m'];


     	$updateVocero=$conexion->query("UPDATE vocero SET documento_voc='$documento_voc', tipoDoc_voc='$tipoDoc_voc', nombre_voc='$nombre_voc', apellido_voc='$apellido_voc',correoPer_voc='$correoPer_voc',correoSena_voc='$correoSena_voc',telefono_voc='$telefono_voc',celular1_voc='$celular1_voc',celular2_voc='$celular2_voc',tipoSangre_voc='$tipoDeSangre_voc',eps_voc='$eps_voc',genero_voc='$genero_voc',status='$status'  WHERE Usuario_id_usu='$Usuario_id_usu'");

     	$updateFicha=$conexion->query("UPDATE vocero SET Ficha_id_fic=(SELECT id_fic FROM ficha WHERE numero_fic='$numero_fic_c')");

		$selectVocero=$conexion->query("SELECT MAX(id_voc) FROM vocero WHERE documento_voc='$documento_voc'");

		$arrDatos=$selectVocero->fetchAll();
      echo $status;
		//print_r($arrDatos);


	}
//no hago nada
}

?>