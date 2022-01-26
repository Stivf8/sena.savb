<?php 
session_start();
//validamos que ya tenga sesion iniciada
if (isset($_SESSION['misession']) ) {
    require_once "php/conexion.php";
    require_once "php/nav.php";
     ?>
     <!DOCTYPE html>
<html lang="es">

<head>
    <title>SAVB</title>
    <link rel="stylesheet" href="estilo/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="iconos/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script type="text/javascript" src="js/localstorage.js"></script>
    <script src="js/evitar_reenvio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<h3 align="center">Gestion De Fichas</h3>
<p align="center">
    <!--Parrafo de bienvenida al usuario que se conecte-->
        Querido Usuario, En esta pantalla se podra realizar la gestion de las Fichas.
    </p>
<!--MUESTRA FORMULARIO DE CREACION DE FICHAS-->

    <?php
    //validamos tipo de rol funcionario
    if($_SESSION['misession']['tipoRol_usu']==1){
        //select de todas las novedades
        $rol='Funcionario';
        ?> 
      
        <div class="container">
            <div class="row">
                <form action="" method="POST" class="col-6 border" onsubmit="return false">
                    <br>
                <div class="col-md-12"><h5 align="center">Formulario Registro de Ficha</h5></div>
                
                <br>
                    <!--Numero de Ficha-->
    
                    <input type="text/" name="NumeroFicha" class="form-control  m-2 w-75"placeholder="Numero de Ficha*" id="NumeroFicha"><br>

                    <!--Nombre del programa-->
              
                    <input type="text/" name="nombrePrograma" class="form-control m-2 w-75"placeholder="Nombre del Programa*" id="nombrePrograma"><br>
                    
                    <!--Etapa de Formacion-->
                    
                    <input type="text/" name="etapaFormacion" class="form-control  m-2 w-75"placeholder="Etapa de Formacion*" id="etapaFormacion"><br>
                    
                    <!--Jornada-->
                    
                    <input type="text/" name="jornada" class="form-control m-2 w-75"placeholder="Jornada*" id="jornada"><br>
                
                    <!--Trimestre-->
               
                    <input type="number" name="trimestre" class="form-control m-2 w-75"placeholder="Trimestre*" id="trimestre"><br>

                    <!--Botones de Gestion-->

                    <div class="col-4">
                <input type="submit" class="m-2 ml-1 align-center text-white text-capitalize form-control" style=" background-color: #ff4500;" value="Registrar Ficha" id="btnRegistrarFicha"><br>
                </div>
                </form>


                <script src="js/funcionFichas.js"></script>
                <script type="text/javascript" >
                $(document).ready(function(){
                    $('#btnRegistrarFicha').click(function(){
                        NumeroFicha = $('#NumeroFicha').val();
                        etapaFormacion = $('#etapaFormacion').val();
                        jornada = $('#jornada').val();
                        nombrePrograma = $('#nombrePrograma').val();
                        trimestre = $('#trimestre').val();

                        crear_ficha(NumeroFicha,etapaFormacion,jornada,nombrePrograma,trimestre); 
                        }); 

                    });

            </script>
                    <!--FIN FORMULARIO CREACION FICHA-->


                


                    <!--FORMULARIO DE ACTUALIZACION DE DATOS-->
                
                
                <div class="col-md-6 border">
                    <br>
                    <div class="col-md-12"><h5 align="center">Formulario Actualizacion de Ficha</h5></div>
                <br>
                    <!--Ficha Consulta-->
                    <form action="" method="POST" onsubmit="return false">
                    <input type="text/" name="FichaActualizar" class="form-control m-2 w-75"placeholder="Ficha*" id="consultaFicha">
                
                <br>
                    
                    <!--Botones de Gestion-->
                <div class="col-4">
                <input type="submit" class="m-1 ml-1 text-white text-capitalize form-control" style=" background-color: #ff4500;" value="Consultar Ficha" id="consultarFichaActualizar"><br>
                </div>
                </form>

                <div class="col-12 border">
                    <br>
                    <input type="hidden" name="" id="id_fic">
                    <div class="col-12"><label class="col-6">Numero de Ficha</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="numero_ficha">

                    <button class="btn border dropdown-toggle m-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-edit"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editar" id="mostrar_modal" >Editar</a></li>
                            <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#eliminar" id="eliminar_ficha">Eliminar</a></li>
                        </ul>

                    </div>
                    <div class="col-12"><label class="col-6 ">Nombre de Programa</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="nombre_programa"></div>
                    <div class="col-12"><label class="col-6 ">Trimestre</label><input readonly onmousedown="return false;" class="col-4" type="number" name="" id="trimestre_fic"></div>
                    <div class="col-12"><label class="col-6 ">Jornada</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="jornada_fic"></div>
                    <div class="col-12"><label class="col-6 ">Etapa de Formación</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="etapa_formacion"></div>
                    <br>
                </div>
                    <br>
                    <input type="submit" class="m-2 ml-1 align-center text-white text-capitalize form-control" form-control data-bs-toggle="modal" data-bs-target="#md_asigFicha" id="asignarFichasModal" style=" background-color: #ff4500;" value="Asignar Fichas"><br>
                </div>
                </div>
                </div>

                <!-- Ventana modal para actualizar la ficha a selecionar -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Ficha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" class="row w-100 h-100 border  bg-light ml-1" onsubmit="return false" >
                        <input type="hidden" id="id_ficha_m">
                        <label class="font-weight-bold ml-1 mt-2 ">Numero de Ficha</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="numero_ficha_m" readonly onmousedown="return false;">
                        <label class="font-weight-bold ml-1 mt-2 " >Nombre del programa</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="nombre_programa_m">
                        <label class="font-weight-bold ml-1 mt-2 ">Etapa de Formación</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="etapa_formacion_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Jornada</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="jornada_fic_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Trimestre</label>
                        <input class="form-control w-100  ml-1 mr-1" type="number" id="trimestre_fic_m">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <button type="button" class="btn btn-success" id="actualizar" data-bs-dismiss="modal" >Modificar</button>

                </div>
            </div>
        </div>


        <!-- Ventana modal para asignar los instructores a fichas-->

    <div class="modal fade" id="md_asigFicha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar Fichas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" class="row w-100 h-100 border  bg-light ml-1" onsubmit="return false" >
                        <input type="hidden" id="id_ficha_m_a">
                        <label class="font-weight-bold ml-1 mt-2 ">Numero de Fichas</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="numero_ficha_m_a" readonly onmousedown="return false;">
                        <label class="font-weight-bold ml-1 mt-2 " >Instructores</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="nombre_programa_m_a">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="asignar_fichas_a_instructores" data-bs-dismiss="modal" >Guardar</button>
                </div>
            </div>
        </div>  







                <script src="js/funcionFichas.js"></script>
                <script type="text/javascript" >
                $(document).ready(function(){
                    $('#consultarFichaActualizar').click(function(){
                        consultaFicha = $('#consultaFicha').val();
                        consulta_ficha(consultaFicha); 
                        }); 

                    });

            </script>

                <script type="text/javascript" >
                $(document).ready(function(){
                    $('#mostrar_modal').click(function(){
                        NumeroFicha_m = $('#numero_ficha').val();

                        mostrar_ficha_modal(NumeroFicha_m); 
                        }); 

                    });

            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#actualizar').click(function(){
                        NumeroFicha_m = $('#numero_ficha_m').val();
                        etapaFormacion_m = $('#etapa_formacion_m').val();
                        jornada_m = $('#jornada_fic_m').val();
                        nombrePrograma_m = $('#nombre_programa_m').val();
                        trimestre_m = $('#trimestre_fic_m').val();
                        actualizar_ficha(NumeroFicha_m,etapaFormacion_m,jornada_m,nombrePrograma_m,trimestre_m); 
                        }); 

                    });

            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#eliminar_ficha').click(function(){
                        id_fic = $('#id_fic').val();

                        preguntarSiNo(id_fic); 
                        }); 

                    });

            </script>


    
    <br><br><br><br>
  
<?php      
       //si no tiene sesion iniciada, el sistema redirige a salir.php que borra la sesion y redirige al login 
                }
}else{
    header('location: php/salir.php');
  } 
 ?>    

</div>
                </div>
    <footer class="container">

        <p>© SAVB 2021</p>

    </footer>

</body>

</html>