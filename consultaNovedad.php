<?php 
session_start();
//validamos qu;e ya tenga sesion iniciada
if (isset($_SESSION['misession']) ) {
    require_once "php/conexion.php";
    require_once "php/nav.php";
    $rol=$_SESSION['misession']['tipoRol_usu'];
?>
<head>
    <title>SAVB</title>
    <link rel="stylesheet" href="estilo/estilos.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.map"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
 <aside class="container">      
          <!--Depende el tipo de usuario, el mensaje de bienvenida cambiara, se utiliza la variable mensjNov-->
               <h4 class="mb-1" align="center">Gestion de Novedades</h4><br>
               <p align="center"> Querido usuario, en esta pantalla podrá realizar el reporte y gestion de novedades registradas.</p>

               <?php
require_once "php/navNovedades.php";
               ?>
<!--Se empieza a estructurar la pagina con boostrap utilizando divs-->

        <div class="container">
                     <div class="row">
                     <div class="col-md-4" align="left"> 
                         <br>
                         <div class="form-group">
                         <form action="" method="POST">
                         <!--Filtro por ficha de novedad-->
                         <input type="text/" class="form-control" placeholder="Numero de ficha" name="buscadorFicha">

                         
                         <!--<label for="filtro">Filtro</label>-->
                             <!--Filtro de la novedad-->
                        <select name="filtroNovedad" class="form-control" id="filtroNovedad">
                            <option value="Todo">Todo</option> 
                            <option value="Pendiente">Pendiente</option> 
                            <option value="En Proceso">En Proceso</option>
                            <option value="Cerrado">Cerrado</option>
                         </select>

                         <br>

                         <input align="center"type="submit"  style=" background-color: #ff4500;" class="btn text-white mb-2" value="Consultar">
                         
                         </form>
                         <?php         
                         $buscadorFicha=$_POST['buscadorFicha'];
                                 //se valida que contenga algo en el buscador los campos de filtro
                   if(!empty($buscadorFicha)&&$rol==3){ 
                    $buscadorFicha=$_POST['buscadorFicha'];
                    $filtroNovedad=$_POST['filtroNovedad'];
                            
                                if($_POST['filtroNovedad']=='Todo'){
                                //select de TODO para ese usuario
                                    $doc_usu=$_SESSION['misession']['doc_usu'];
                                    $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, f.numero_fic,CONCAT(v.nombre_voc,' ',v.apellido_voc) as nombres, n.estado_nov, v.documento_voc FROM novedad n, vocero v, ficha f WHERE n.Vocero_id_voc = v.id_voc AND '$doc_usu'= v.documento_voc AND f.numero_fic='$buscadorFicha' AND f.id_fic = v.Ficha_id_fic ORDER BY n.id_nov");
                                    $arrNovedades1=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo "Filtro aplicado <b>Todo</b> con el numero de ficha <b>$buscadorFicha</b>";
                                }elseif(!empty($buscadorFicha)&&$rol==3){
                                //select de pendientes para ese usuario
                                    $doc_usu=$_SESSION['misession']['doc_usu'];
                                    $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, f.numero_fic,CONCAT(v.nombre_voc,' ',v.apellido_voc) as nombres, n.estado_nov, v.documento_voc FROM novedad n, vocero v, ficha f WHERE n.Vocero_id_voc = v.id_voc AND '$doc_usu'= v.documento_voc AND f.numero_fic='$buscadorFicha' AND n.estado_nov = '$filtroNovedad' AND f.id_fic = v.Ficha_id_fic ORDER BY n.id_nov");
                                    $arrNovedades1=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo "Filtro aplicado <b>$filtroNovedad</b> con el numero de ficha <b>$buscadorFicha</b>";
                                }
                            }elseif((!empty($buscadorFicha)&&($rol==2))||($rol==1)){
                                    
                                $buscadorFicha=$_POST['buscadorFicha'];
                                $filtroNovedad=$_POST['filtroNovedad'];

                                if($_POST['filtroNovedad']=='Todo'&&(!empty($buscadorFicha))){
                                    $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, f.numero_fic, n.estado_nov,CONCAT(v.nombre_voc,' ',v.apellido_voc) as nombres, v.documento_voc FROM novedad n, vocero v, ficha f WHERE n.Vocero_id_voc = v.id_voc AND v.Ficha_id_fic = f.id_fic AND f.numero_fic='$buscadorFicha' AND f.id_fic = v.Ficha_id_fic ORDER BY n.id_nov;");
                                    $arrNovedades1=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo "Filtro aplicado <b>$filtroNovedad</b> con el numero de ficha <b>$buscadorFicha</b>";
                                }elseif(!empty($buscadorFicha)){

                                    $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, f.numero_fic,CONCAT(v.nombre_voc,' ',v.apellido_voc) as nombres, n.estado_nov, v.documento_voc FROM novedad n, vocero v, ficha f WHERE n.Vocero_id_voc = v.id_voc AND f.numero_fic='$buscadorFicha' AND n.estado_nov = '$filtroNovedad' AND f.id_fic = v.Ficha_id_fic ORDER BY n.id_nov");
                                    $arrNovedades1=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                    echo "Filtro aplicado <b>$filtroNovedad</b> con el numero de ficha <b>$buscadorFicha</b>";
                                }else{
                                    $alerta='<div class="alert" role="alert">
                                Por favor ingresa el numero de ficha a consultar.
                                </div>';
                                }

                                
                                    
                        }elseif($buscadorFicha==""){
                            $alerta='<div class="alert" role="alert">
                                No estas autorizado para realizar consultas de novedades.
                                </div>';
                                
                                echo isset($alerta)? $alerta:''; 
                        
                    }else{echo 'Por favor ingresa el numero de ficha';}

                            
                                        
?>
                         </div>       
                        </div>
<!--aqui definimos las estructura de la tabla la cual mostrara las novedades-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
            <br>
            <?php 
            if(!empty($arrNovedades1)){

                ?>
                <table   class="table table-hover">
                    <tr>
                        <th class="bg-primary" scope="col">Numero Novedad</th>
                        <th class="bg-primary" scope="col">Titulo</th>
                        <th class="bg-primary" scope="col">Ficha</th>
                        <th class="bg-primary" scope="col">Reportado por</th>
                        <th class="bg-primary" scope="col">Numero de Identidad</th>
                        <th class="bg-primary" scope="col">Estado</th>
                    </tr> 
                    <?php
            }
            ?>
 <?php
            //aqui recorremos el arreglo con la consulta hecha previamente, esto con el fin de imprimir el dato en su columna correspondiente
            if(!empty($arrNovedades1)){
                foreach ($arrNovedades1 as $muestra) {
                    echo '<tr>';
                    echo '<td >' . $muestra['id_nov'] . '</td>';
                    echo '<td >' . $muestra['titulo_nov'] . '</td>';
                    echo '<td >' . $muestra['numero_fic'] . '</td>';
                    echo '<td >' . $muestra['nombres'] . '</td>';
                    echo '<td >' . $muestra['documento_voc'] . '</td>';
                    echo '<td >' . $muestra['estado_nov'] . '</td>';
                    echo ' </tr>';
                }
            }else{
                ?>
                                <?php 
                                
                                $alerta='<div class="alert alert-danger mt-2" role="alert">
                                No se han encontrado datos
                                </div>';
                                
                                echo isset($alerta)? $alerta:''; ?>
                                </div><?php
            }
            
?>
</table>
</div>
</div></div></div>
                     
        <?php
        
    //si no tiene sesion iniciada, el sistema redirige a salir.php que borra la sesion y redirige al login
  }else{
    header('location: php/salir.php');
  }
 ?>

<body>       
                <footer class="container">

<p align="center"><b>© SAVB 2021</b></p>

</footer>
          
</body>