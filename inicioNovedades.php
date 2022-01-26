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
<!--Se empieza a estructurar la pagina con boostrap utilizando divs-->
                <?php
        require_once "php/navNovedades.php";
                ?>

                <div class="container">
            <div class="row">
                <form action="" method="POST" class="col-12 border" onsubmit="return false">
                    <br>
                <div class="col-md-12"><h5 align="center">Reportar Novedad</h5></div>
                
                <br>
                    <!--Titulo de la Novedad-->
    
                    <input required type="text/" name="TituloNovedad" class="form-control  m-2 w-100"placeholder="Titulo de la Novedad*" id="TituloNovedad"><br>

                    <!--Nombre del programa-->
              
                    <textarea required rows="5" type="text/" name="contenidoNovedad" class="form-control m-2 w-100"placeholder="Cuentanos que ha sucedido*" id="contenidoNovedad"></textarea><br>
                    
                    
                    <!--Botones de Gestion-->

                    <div class="col-4">
                <input type="submit" class="m-2 ml-1 align-center text-white text-capitalize form-control" style=" background-color: #ff4500;" value="Reportar Novedad" id="btnReportarNovedad"><br>
                </div>
                </form>
                     
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