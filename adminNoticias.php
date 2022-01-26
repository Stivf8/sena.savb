<?php //MODULO NOTICIA
//aqui llamamos este metodo session_start  para que nos traiga  las variables que definimos en index.php con el metodo session start
session_start();
// aqui llamamos la conexion con DB que esta subida en Xampp
require_once "php/conexion.php";
// Aqui llamamos este archivo donde nos trae el mapa de  navegacion del sistema de informacion SAVB
require_once "php/nav.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="iconos/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">

    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script type="text/javascript" src="js/localstorage.js"></script>
    <script src="js/evitar_reenvio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>SAVB</title>
</head>
<body>
<!-- aca va el formulario de la creacion de noticias -->
    <div class="container-fluid">
        <div class="mb-4 mt-2">
            <h1 class="text-center ">Gestión Noticias</h1>
        </div>
        <div class="row border ">
            <form method="POST" action="#" enctype="multipart/form-data" class="row col-6 h-25 border  bg-light ml-2 mt-2" onsubmit="return false" >

                <h2 class="text mx-auto">Formulario Noticia</h2>
                <div class="form-group col-12 mt-2">
                    <label class="font-weight-bold ml-1 mt-2 ">Titulo de la noticia:</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="titulo" placeholder="Ingresa el titulo de la noticia">
                </div>
                <div class="form-group col-12 mt-2">
                    <label class="font-weight-bold ml-1 mt-2 ">Contenido de la noticia:</label>
                    <textarea class="form-control h-100 w-100 ml-1 mr-1 text-start" id="contenido" placeholder="Ingresa el contenido de la noticia."></textarea> 
                </div>
                <div class="form-group col-12 mt-4">
                    <label class="font-weight-bold ml-1 mt-2 ">Imagen: </label>
                    <input type="file" class="form-control m-1" accept="image/*" id="seleciona" >
                </div>
                <div class="form-group ">
                    <button class="m-2 ml-4 text-white text-capitalize form-control" style=" background-color: #ff4500;" id="agregarNoticia" name="btn" type="submit"  >Añadir noticia</button>
                <!-- Aqui mostrara un mensaje que mostrara si el registro fue exitoso o no desde el archivo php/agregarNotcia.php -->
                    <?php echo isset($alerta)? $alerta:''; ?>
                </div>
            </form>
    <!-- Aqui va la barra de busqueda de las noticias creadas  -->
            <div id="no"class="col-6 ">
                <div class="container">
                    <div class="row">
                        <div class="col-12 ">
                            <form class="form-inline  mt-3" method="POST" action="#">
                                <div class="form-group mb-2 ">
                                        <input id="search-input" type="search" id="form1" class="form-control w-100 col-12" name="buscar" placeholder= "Buscar" />
                                </div>  
                                <div class="btn-group ml-2 " role="group" aria-label="Basic example">
                                    <button type="search" class="btn text-white  mb-2" style=" background-color: #ff4500;">Buscar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>



                <!-- aca esta la parte de las notcias que se han creado -->
                <?php
                    //Aqui estamos consultando la DB para que cuente cuantos registros hay en la tabla noticia con estado =1
                    $contarDatos= $conexion->query("select count(*) as total_registro from noticia where status=1  order by fecha_not desc, hora_not desc;");
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
                    $busqueda= $conexion->query("SELECT * from noticia where status=1 and  (titulo_not like '%$buscar%'
                                                or contenido_not like '%$buscar%')
                                                order by id_not desc,fecha_not desc, hora_not desc 
                                                limit $desde,$porPagina");
                        $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                    // aqui traemos un FOREACH para recoger el arreglo de la linea anterior(107)
                    foreach ($arrDatos as $dato) {
                    $id=$dato['id_not'];
                    $titulo= $dato['titulo_not'];
                    $contenido= $dato['contenido_not'];
                    $img= $dato['img_not'];
                    $estado=$dato['current_version'];
                        //aqui definimos esta variable donde va guardar los datos que nos trae las variables que nos trae el foreach
                    $datos= $id.'||'.$titulo.'||'.$contenido;
                ?>
                    <!-- Finaliza codigo php
                     Aqui en este espacio mostrara las variables que definimos en el foreach que nos trae los datos desde la BD -->
                <div class="row mt-2 ml-1 p-1 border bg-light">
                <input type="hidden" value="<?php echo $id; ?>">
                    <h2 class="p-2 col-9 mr-5"><?php echo $titulo; ?></h2>
                    <div class="dropdown col-1 ml-4">
                        <button class="btn border dropdown-toggle m-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-edit"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editar" onclick="agregar('<?php echo $datos?>')">Editar</a></li>
                            <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#eliminar" onclick="preguntarSiNo('<?php echo $id;?>');">Eliminar</a></li>
                        </ul>
                    </div>
                    <p class="p-2 col-12 ">
                    <?php echo $contenido; ?>
                    </p>
                    <!-- aqui definimos una condicional donde va validar si la variable $img esta nula o no -->
                    <?php if (!empty($img) ) { ?>
                        <img class="img-thumbnail mx-auto"  src="<?php echo $img; ?>">

                    <?php } //finaliza la condicion de la linea 136 ?>

                </div>  
                <?php }//finaliza la secuencia del foreach ?>
            <!-- Aqui esta el codigo HTML donde mostrara la paginación donde se reparten los registros  segun la cantidad de paginas segun en la linea 62 -->
                <nav  aria-label="paginacion">
                        <ul class="pagination justify-content-center ">
                        <!-- inicia codigo php -->
                            <?php
                            // aqui colocamos una condicion para validar los botones, segun  la cantidad de paginas que se mostrara en la paginacion
                                if ($pagina !=1) {
                            ?>

                            <!-- finaliza condigo php -->
                            <!-- aqui esta los botones que nos permitirar recorrer en numero de espacios en la paginacion -->

                            <li class="page-item"><a class="page-link" href="?pagina=<?php echo 1;?>"><<</a></li>
                            <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina-1;?>"> < Anterior</a></li>
                            <!-- inicia codigo php -->
                            <?php
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
                            ?>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1;?>">Siguiente ></a></li>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?php echo $totalPagina;?>">>></a></li>
                            <?php
                                   
                                }//finaliza la condicion de la linea 112
                            ?> 
                            
                        </ul>
                </nav>
            </div>
            
        </div>
    </div>
    <!-- Ventana modal para actualizar la noticia a selecionar -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Noticia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" class="row w-100 h-100 border  bg-light ml-1" onsubmit="return false" >
                        <input type="hidden" id="idnoticia">
                        <label class="font-weight-bold ml-1 mt-2 ">Titulo de la noticia:</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="titulou">
                        <label class="font-weight-bold ml-1 mt-2 ">Contenido de la noticia:</label>
                        <textarea class="form-control h-100 w-100 ml-1 mr-1 text-start" id="contenidou"></textarea>
                        <label class="font-weight-bold ml-1 mt-2 " >Imagen:</label>
                        <input class="form-control-file m-1" type="file" name="imgu"accept="image/*" id="imagenu">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <button type="button" class="btn btn-success" id="actualizar" data-bs-dismiss="modal" >Modificar</button>

                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="js/funcion.js"></script>
<script type="text/javascript" >
    $(document).ready(function() {
        $('#agregarNoticia').click( function() {
            titulo= $('#titulo').val();
            contenido= $('#contenido').val();
            imagen= $('#seleciona').val();
            agregarNoticia(titulo,contenido,imagen);
        });
    })

    $(document).ready(function(){
       $('#actualizar').click(function(){
        actualizarDatos(); 
       }); 
    });

    $(document).ready(function() {
        $('#agregarNoticia').click(function(){
            titulo= $('#titulo').val();
            contenido= $('#contenido').val();
            imagen= $('#seleciona').val();
            EnviarCorreo(titulo,contenido, imagen);
        });
    });

</script>
