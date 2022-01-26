<?php //MODULO NOTICIA
// Esta linea nos trae la session que se creo en el archivo index.php
session_start();
// Aqui llamamos este archivo donde nos trae el mapa de  navegacion del sistema de informacion SAVB
require_once "php/nav.php";
?>
<!-- inicia codigo HTML y mostrará El listado de noticias  -->
<!DOCTYPE html>
<!-- aquí definimos el idioma que vamos a trabajar -->
    <html lang="es">
<!-- aquí va el encabezado y los links de los recursos que estamos utilizando para parte funcional y visual -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilo/estilos.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="iconos/fontawesome/css/all.css">
        <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
        <script type="text/javascript" src="js/localstorage.js"></script>
        <title>SAVB</title>
    </head>
    <!-- Inicia el cuerpo de la pagina donde se mostrara las noticias creadas en el sistema SAVB -->
    <body class="border m-3"> 
        <!--PARRAFO EXPLICATIVO POR PANTALLA-->
        <div class="container-fluid border mt-2 ">
            <div class="row">
            <!-- Aqui inicia la barra de busqueda que nos ayudar a buscar las noticias publicadas en sistema SAVb -->
                <form class="form col-3 mt-3 " method="POST" action="inicioNoticias.php">
                    <div class="input-group ml-5 mt-1">
                        <div class="form-outline">
                            <input id="search-input" type="search" id="form1" class="form-control" name="buscar" placeholder= "Buscar" />
                        </div>
                        <div ><input type="submit" name="bucador" style=" background-color: #ff4500;" class="btn text-white mb-2" value="Buscar"></div>
                    </div>
                </form>
                <!--listado de las noticias creadas en el sistema -->
                <div class="col-9 mt-2">
                    <!-- inicia codigo php -->
                    <div class="container">
                        <?php
                        //Aqui estamos consultando la DB para que cuente cuantos registros hay en la tabla noticia con estado =
                            $contarDatos= $conexion->query("select count(*) as total_registro from noticia  order by fecha_not desc, hora_not desc;");
                        //Aqui estamos convirtiendo un arreglo con la consulta de la linea anterior  y lo recoremos con un FOREACH
                            $result_registro= $contarDatos->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result_registro as $dato) {
                                $total_registro= $dato['total_registro'];
                            }
                        // Aqui definimos una variable para definir la cantidad de registros que se mostraran en pantalla 
                            $porPagina=10;
                       //Aqui definimos una condicional que nos permite validar si la variable $_GET['pagina'] esta nula o no 
                            if (empty($_GET['pagina'])) {
                                //si esta nula la variable $_GET['pagina'] nos define $pagina sea 1
                                $pagina= 1;
                            }else {
                                //sino se cumple definimos la variable $pagina sea = $_GET['pagina']
                                $pagina= $_GET['pagina'];
                            }
                            // Aqui definimos una variable para definir la cantidad espracios para la paginación
                            $desde =($pagina-1)* $porPagina;
                            $totalPagina= ceil($total_registro / $porPagina);
                            // aqui consultamos a la DB para que traiga las noticias creadas con el status=1 y tambien definimos una varible donde me almacenar el contenido que el usuario esta buscando
                            $buscar= $_POST['buscar'];
                            $busqueda= $conexion->query("SELECT * from noticia where (titulo_not like '%$buscar%'
                                                        or contenido_not like '%$buscar%') AND status=1
                                                        order by fecha_not desc, hora_not desc
                                                        limit $desde,$porPagina");
                                $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                            // aqui traemos un FOREACH para recoger el arreglo de la linea anterior
                            foreach ($arrDatos as $dato) {
                                # code...
                            $titulo= $dato['titulo_not'];
                            $contenido= $dato['contenido_not'];
                            $img= $dato['img_not'];
                            $estado=$dato['status'];
                            setlocale(LC_TIME, "spanish");
                            $fecha= iconv('ISO-8859-1','UTF-8',strftime("%A, %d de %B de %Y", strtotime($dato['fecha_not'])));
                        ?>
                         <!-- Finaliza codigo php
                             Aqui en este espacio mostrara las variables que definimos en el foreach que nos trae los datos desde la BD -->
                        <div class="row col-12 m-2 p-2 border bg-light">
                            <h2 class="col-12"><?php echo $titulo;?></h2>
                            <p class="col-12 text-muted m-1"><?php  echo $fecha; ?></p>
                            <p class="col-12"><?php echo $contenido;?></p>
                            <img  class="img-thumbnail h-75 w-75 mx-auto  " src="<?php echo $img; ?>" alt="img1" >

                        </div>
                        <?php }// aqui cerramos la sentencia foreach 
                        ?>
                        <!-- Aqui esta el codigo HTML donde mostrara la paginación donde se reparten los registros  segun la cantidad de paginas segun en la linea 62 -->
                        <nav  aria-label="paginacion">
                        <ul class="pagination justify-content-center ">
                        <!-- inicia codigo php -->
                            <?php
                            // aqui colocamos una condicion para validar los botones, segun  la cantidad de paginas que se mostrara en la paginacion
                                if ($pagina !=1) {
                                    if ($pagina <=2) {
                            ?>

                            <!-- finaliza condigo php -->
                            <!-- aqui esta los botones que nos permitirar recorrer en numero de espacios en la paginacion -->
                            <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina-1;?>">< Anterior</a></li>
                            <?php  }else{?>
                            <li class="page-item"><a class="page-link" href="?pagina=<?php echo 1;?>"><<</a></li>
                            <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina-1;?>"> < Anterior</a></li>
                            <!-- inicia codigo php -->
                            <?php
                                    }
                                }//finaliza la condicional de la linea 93
                                //inicia un ciclo repetitivo For que nos ayudara a definir cuantos espacios vamos a necesitar en el navegadorx
                                for ($i=1; $i < $totalPagina; $i++) { 
                                    if ($i == $pagina) {
                                        echo '<li class="page-item active "><a class="page-link" href="?pagina='.$i.'">' .$i.'</a></li>';
                                    }else {
                                        echo '<li class="page-item "><a class="page-link" href="?pagina='.$i.'">' .$i.'</a></li>';
                                    }
                                    
                                }
                            //finaliza secuancia For de la linea 103
                            //inicia una condicion donde nos ayuda a validar los botonos que se mostrara si cumplen la condicion
                                if ($pagina != $totalPagina) {
                                     if($pagina < $totalPagina){
                            ?>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1;?>">Siguiente ></a></li>
                                   <?php }else{?> 
                                    <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1;?>">Siguiente ></a></li>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?php echo $totalPagina;?>">>></a></li>
                            <?php
                                   }
                                }//finaliza la condicion de la linea 112
                            ?> 
                            
                        </ul>
                </nav>
                    </div>
                </div> 


    </body>
</html>
