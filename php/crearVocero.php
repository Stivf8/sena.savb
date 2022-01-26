<?php
require_once "conexion.php";

if(!empty($_POST)){

	if(!empty($_POST['Ficha'])){

		$Ficha=$_POST['Ficha'];
	$TipoDeDocumento=$_POST['TipoDeDocumento'];
	$NumeroDeDocumento=$_POST['NumeroDeDocumento'];
	$Nombres=$_POST['Nombres'];
	$Apellidos=$_POST['Apellidos'];
	$CorreoPersonal=$_POST['CorreoPersonal'];
	$CorreoSena=$_POST['CorreoSena'];
	$Telefono=$_POST['Telefono'];
	$Celular1=$_POST['Celular1'];
	$Celular2=$_POST['Celular2'];
	$TipoDeSangre=$_POST['TipoDeSangre'];
	$EPS=$_POST['EPS'];
	$Genero=$_POST['Genero'];

	//valida si existe vocero ya creado con ese numero de documento

	$selectVoceroExistente=$conexion->query("SELECT documento_voc FROM vocero WHERE documento_voc='$NumeroDeDocumento'");

	$arrDatosExiste=$selectVoceroExistente->fetchAll(PDO::FETCH_ASSOC);

	foreach ($arrDatosExiste as $dato) {
        $VoceroExiste=$dato['documento_voc'];
     }
     if($VoceroExiste==$NumeroDeDocumento){
			//no Realiza nada
     }else{

     			
     			//$contr_pass_n=substr('$Nombres',0,1);
     			//$contr_pass_a=substr('$Apellidos',0,1);
     			$contr_full_n=rand(2983, 9299);
     			$lvsavb=$NumeroDeDocumento+882376;
     			$contr_full_s='Sa';
     			$contr_full_s2='vB#';
     			$contr_full_v1=$contr_full_s.$contr_full_n.$contr_full_s2;

     			$insertUsuario=$conexion->query("INSERT INTO usuario (id_usu, Rol_id_rol, Usuario, contrasena_usu) VALUES(NULL,'3','$NumeroDeDocumento',aes_encrypt('$contr_full_v1','$lvsavb'))");

				$insertVocero=$conexion->query("INSERT INTO vocero (id_voc, Ficha_id_fic, Usuario_id_usu, documento_voc, tipoDoc_voc, nombre_voc, apellido_voc, correoPer_voc, correoSena_voc, telefono_voc, celular1_voc, celular2_voc, tipoSangre_voc, eps_voc, genero_voc) VALUES (NULL, '$Ficha', (SELECT id_usu FROM usuario WHERE Usuario='$NumeroDeDocumento'), '$NumeroDeDocumento', '$TipoDeDocumento', '$Nombres', '$Apellidos', '$CorreoSena', '$CorreoPersonal', '$Telefono', '$Celular1', '$Celular2', '$TipoDeSangre', '$EPS', '$Genero')");

				$selectVocero=$conexion->query("SELECT Usuario_id_usu FROM vocero WHERE documento_voc='$documento_voc'");

				$arrDatos=$selectVocero->fetchAll();

				print_r($arrDatos);
			}

	}

}

?>