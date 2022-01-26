<?php
// aqui llamamos la conexion con DB que esta subida en Xampp
require_once "conexion.php";
// este metodo nos ayuda a que la variables que esten nula no nos muestre error undefined variable
error_reporting(0);
//Aqui definimos una variable que nos trae  $_SESSION['misession'] que la trae desde index.php
$varsesion= $_SESSION['misession'];
if ($varsesion== null || $varsesion= '') {
    header("location: ../index.php");
    die();
}
//validamos tipo de rol funcionario
if($_SESSION['misession']['tipoRol_usu']==1){
    //select de todas las novedades
   
    $id_usu=$_SESSION['misession']['doc_usu'];
    $busquedaNombres=$conexion->query("SELECT nombre_fun nombre, apellido_fun apellido FROM funcionario WHERE documento_fun = '$id_usu'");
    $arrNombres=$busquedaNombres->fetchAll(PDO::FETCH_ASSOC);
    
}//validamos que sea instructor
elseif($_SESSION['misession']['tipoRol_usu']==2){
    //select de todas las novedades con el id del instructor
    $doc_usu=$_SESSION['misession']['doc_usu'];
    
    $id_usu=$_SESSION['misession']['doc_usu'];
    $busquedaNombres=$conexion->query("SELECT nombre_ins nombre, apellido_ins apellido FROM instructor WHERE documento_ins = '$id_usu'");
    $arrNombres=$busquedaNombres->fetchAll(PDO::FETCH_ASSOC);
    $mensjNov='EN RELACION A TI';
}//validamos que sea un aprendiz/vocero
    elseif($_SESSION['misession']['tipoRol_usu']==3){
        $doc_usu=$_SESSION['misession']['doc_usu'];
        
        $id_usu=$_SESSION['misession']['doc_usu'];
        $busquedaNombres=$conexion->query("SELECT nombre_voc nombre, apellido_voc apellido FROM vocero WHERE documento_voc = '$id_usu'");
        $arrNombres=$busquedaNombres->fetchAll(PDO::FETCH_ASSOC);
        
        //select de todas las novedades con el id del vocero
    
}
?>
<!-- Aqui estara el html de la navegacion del proyecto SAVB que nos permitira desplazarnos en el aplicativo -->
<!DOCTYPE html>
<html lang="es">
<!-- aquí va el encabezado y los links de los recursos que estamos utilizando para parte funcional y visual -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/estilos.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../iconos/fontawesome/css/all.css">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/localstorage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>SAVB</title>
</head>
    <body class="border m-3">
    <!-- Aqui esta el espacio donde se visuaizara el titulo del sistema y el logo del aplicativo -->
        <div class="container mt-2">
                <div class="row col-sm-12 ml-3">
                    <div class="col-1   ">
                    <img class="mr-5" src="imagenes/savb.png" alt="Imagen SAVB" title="Logo SAVB"  height="60px" />
                    </div>
                    <div class="col-10 ">
                    <h2 class="text-center mt-2" >Sistema de Administracion de Voceros de Bienestar</h2>
                    </div>
                    <div class="col-1  ">
                        <img class=" mt-1" src="imagenes/senalogo.png" alt="Imagen Sena" title="Logo Sena" width="70PX" height="50px" />
                    </div>
                
                </div>  
            </div>
            <!-- Aqui mostrara los botones y funcionalidades segun el rol -->

            <nav class="navbar navbar-expand w-75 mx-auto  mt-2 ">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="navbar-nav navbar-fluid ">

                            <li class="nav-item col-5 border  ml-2">
                                <a class="nav-link text-center text-dark" href="inicioNoticias.php" title="Inicio Noticias">Noticias</a>
                            </li>
                            <li class="nav-item col-5  border " >
                                <a class="nav-link text-center text-dark" href="inicioVoceros.php" title="Gestion de Consultas">Consultas</a>
                            </li>
                            <li class="nav-item col-5 border ">
                                <a class="nav-link text-center text-dark" href="inicioNovedades.php" title="Gestion de Novedades">Novedades</a>
                            </li>
                            <a href="inicioChat.html" class="btn-flotante">Chat</a>
                        <!--aqui esta el boton donde mostrara el nombre del usuario que inicio sesion en el aplicativo y tambien se mostrara las funcionalidades dependiendo del rol que ha iniciado sesion  -->
                            <div class="dropdown ml-4 col-1">
                            </div>
                                <div class="dropdown ml-4 col-4 ">
                                <a class="btn btn-primary dropdown-toggle rounded-pill border" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                                <i class="fas fa-user"></i> <?php foreach ($arrNombres as $nombres) {echo $nombres['nombre'] .' '. $nombres['apellido'];};?>
                                </a>
                            <!-- Aqui se van a desplegar las funcionalidades segun el rol -->
                                <ul class="dropdown-menu border-primary" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item border-primary " href="#">Perfil</a></li>
                                <!-- Aqui esta condicion donde nos permite validar que tipo de rol inicio sesion, si cumple con la condicion se mostrara las funcionalidades del sistema -->
                                    <?php //aqui validamos el tipo de rol
                                    if ($_SESSION['misession']['tipoRol_usu']==1) { ?>
                                        <li class="border"><a class="dropdown-item " href="funcionario.php">Administración Funcionario</a></li>
                                        <li><a class="dropdown-item " href="consulta.php">Administración Instructor</a></li>
                                        <li  class="border" ><a class="dropdown-item " href="adminNoticias.php">Administración Noticias</a></li>
                                        <li  class="border" ><a class="dropdown-item " href="adminVoceros.php">Administración Voceros</a></li>
                                        <li  class="border" ><a class="dropdown-item " href="inicioNovedadesAdmin.php">Administración Novedades</a></li>
                                        <li  class="border" ><a class="dropdown-item " href="adminFicha.php">Administración Ficha</a></li>
                                    <?php }//finaliza la condicion de la linea 100 ?>
                                    <li><a class="dropdown-item" href="php/salir.php">Salir</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div> 
            </nav> 
            <!-- aca mostramos los datos del usuario en el cual inicio sesion con el aplicativo-->
            <div class="row ">
                <div class="col-12">
                   <br>
                </div>    
            </div>
        </div>
    </body>
</html>



