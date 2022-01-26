<?php
require_once "conexion.php";


if(!empty($_POST)){

	if(!empty($_POST['NumeroFicha'])){

			$NumeroFicha=$_POST['NumeroFicha'];
            $etapaFormacion=$_POST['etapaFormacion'];
            $jornada=$_POST['jornada'];
            $nombrePrograma=$_POST['nombrePrograma'];
            $trimestre=$_POST['trimestre'];

     //valida si existe ficha ya creada

     $selectFichaExistente=$conexion->query("SELECT numero_fic FROM ficha WHERE numero_fic='$NumeroFicha'");

     $arrDatosExiste=$selectFichaExistente->fetchAll(PDO::FETCH_ASSOC);
     
     foreach ($arrDatosExiste as $dato) {
        $FichaExiste=$dato['numero_fic'];
     }
     if($FichaExiste==$NumeroFicha){
			//no Realiza nada
     }else{

     	$insertFicha=$conexion->query("INSERT INTO ficha (id_fic, numero_fic, etapaFormacion_fic, jornada_fic, nombrePrograma_fic, trimestre_fic) VALUES (NULL, '$NumeroFicha', '$etapaFormacion', '$jornada', '$nombrePrograma', '$trimestre')");

		$selectFicha=$conexion->query("SELECT MAX(id_fic) FROM ficha WHERE numero_fic='$NumeroFicha'");

		$arrDatos=$selectFicha->fetchAll();

		print_r($arrDatos);

     }

	}

}

?>