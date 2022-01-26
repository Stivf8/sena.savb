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

    
</head>
        <h3 align="center">Gestion De Vocero</h3>
            <p align="center">
                    <!--Parrafo de bienvenida al usuario que se conecte-->
                         Querido Usuario, En esta pantalla se podra realizar la gestion o consulta de datos de los Voceros.
            </p>
<br>

<?php //select de fichas existentes
                $busquedaFichasExistentes=$conexion->query("SELECT id_fic, numero_fic from ficha");

                $arrFichas=$busquedaFichasExistentes->fetchAll(PDO::FETCH_ASSOC); ?>

<div class="container">
<div class="row" >
    <div class="col-md-5" align="left">
        <div class="form-group">
            <h6 align="center">Registrar Vocero</h6>
        <form id="frm_registrar_vocero" method="POST" action=""onsubmit="return false">
            <label for="Ficha">Ficha*</label>
            <div class="input-field">
                <select type="text/" class="form-control" name="Ficha*" value="" id="Ficha" placeholder="">
                <?php
 
                foreach ($arrFichas as $muestra) {
                        $datos= $muestra->id_fic.'||'.$muestra->numero_fic;

                ?>
                    <option value="<?php echo $muestra['id_fic'];?>"><?php echo $muestra['numero_fic']; ?></option>

                <?php 
                };
                ?>
                </select>
            </div>

            <div class="input-field">
                <label for="TipoDeDocumento">Tipo de Documento*</label>
                <select type="text/" class="form-control" name="Tipo de Documento*" id="TipoDeDocumento">
                    <option value="CC">Cedula</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="EX">Extranjero</option>
                </select>
            </div>

            <div class="input-field">
                <label for="Numero de Documento">Numero de Documento*</label>
                <input type="number" class="form-control" name="Numero de Documento*" value="" id="NumeroDeDocumento" placeholder="">
            </div>

            <div class="input-field">
                <label for="Nombres">Nombres*</label>
                <input type="text/" class="form-control" name="Nombres*" value="" id="Nombres" placeholder="">               
            </div>

            <div class="input-field">
                <label for="Apellidos">Apellidos*</label>
                <input type="text/" class="form-control" name="Apellidos*" value="" id="Apellidos" placeholder="">               
            </div>

            <div class="input-field">
                <label for="Correo Personal">Correo Personal*</label>
                <input type="email" class="form-control" name="Correo Personal*" value="" id="CorreoPersonal" placeholder="">                
            </div>

            <div class="input-field">
                <label for="Correo Sena">Correo Sena*</label>
                <input type="email" class="form-control" name="Correo Sena" value="" id="CorreoSena" placeholder="">
            </div>

            <div class="input-field">
                <label for="Telefono">Telefono</label>
                <input type="number" class="form-control" name="Telefono" value="" id="Telefono" placeholder="">
            </div>

            <div class="input-field">
                <label for="Celular 1">Celular 1*</label>
                <input type="number" class="form-control" name="Celular 1" value="" id="Celular1" placeholder="">
            </div>

            <div class="input-field">
                <label for="Celular 2">Celular 2</label>
                <input type="number" class="form-control" name="Celular 2" value="" id="Celular2" placeholder="">
            </div>

            <div class="input-field">
                <label for="Tipo de Sangre">Tipo de Sangre*</label>
                <select type="text/" class="form-control" name="Sangre*" id="TipoDeSangre">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>

            <div class="input-field">
                <label for="EPS">EPS</label>
                <input type="text/" class="form-control" name="EPS" value="" id="EPS" placeholder="">
            </div>

            <div class="input-field">
                <label for="Genero">Genero*</label>
                <select type="text/" class="form-control" name="Genero*" id="Genero">
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                </select>
            </div>
            <br>
            <div class="input-field">
            <button class="m-2 ml-1 text-white text-capitalize form-control" style=" background-color: #ff4500;" id="btnVoc" name="btn" type="submit"  >Guardar</button>
            </div>
        </form>



        </div>
    </div>


    <div class="col-md-1" align="center">
        </div>

<!--Formulario para consultar y actualizar datos de los voceros-->

    <div class="col-md-6" align="left" border>
        <h6 align="center">Consulta Vocero</h6>
        <form id="consultaVoceroForm" method="POST" action=""onsubmit="return false">

            <div class="input-field">
                <label for="Numero de Documento">Numero de documento*</label>
                <input type="number" class="form-control" name="Numero de documento" value="" id="consultaVocero" placeholder="">
                <button class="m-2 ml-1 text-white text-capitalize form-control" style=" background-color: #ff4500;" id="btn_consultar_vocero" name="btn_consultar_vocero" type="submit"  >Consultar</button>
            </div>
            <div class="col-12 border">
                    <br>
                    <input type="hidden" name="" id="id_voc">
                    <input type="hidden" name="" id="Usuario_id_usu">
                    <input type="hidden" name="" id="Ficha_id_fic">
                    <div class="col-12"><label class="col-6">Numero de Ficha</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="numero_ficha">

                    <button class="btn border dropdown-toggle m-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-edit"></i>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editar" id="mostrar_modal_vocero" >Editar</a></li>
                            <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#eliminar" id="eliminar_vocero">Eliminar</a></li>
                        </ul>
                    </div>

                    <div class="col-12"><label class="col-6 ">Tipo de Documento</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="tipo_documento_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Numero de Documento</label><input readonly onmousedown="return false;" class="col-4" type="number" name="" id="documento_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Nombres</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="nombre_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Apellidos</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="apellidos_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Correo Personal</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="correo_personal_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Correo Sena</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="correo_sena_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Telefono</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="telefono_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Celular 1</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="celular_1"></div>

                    <div class="col-12"><label class="col-6 ">Celular 2</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="celular_2"></div>

                    <div class="col-12"><label class="col-6 ">Tipo de Sangre</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="tipo_sangre_vocero"></div>

                    <div class="col-12"><label class="col-6 ">EPS</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="eps_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Genero</label><input readonly onmousedown="return false;" class="col-4" type="text" name="" id="genero_vocero"></div>

                    <div class="col-12"><label class="col-6 ">Estado</label><input readonly onmousedown="return false;" class="col-4" type="number" name="" id="estado_v"></div>
                    
                </div>
        </form>
        <br>

            

 </div>
</div>
            <!-- Ventana modal para actualizar el vocero a selecionar -->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Vocero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" class="row w-100 h-100 border  bg-light ml-1" onsubmit="return false" >
                        <input type="hidden" id="id_voc_m">
                        <input type="hidden" id="Ficha_id_fic_m">
                        <input type="hidden" id="usuario_voc_m">
                        <label class="font-weight-bold ml-1 mt-2 ">Numero de Ficha</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="numero_ficha_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Numero de Documento</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="numeroDocumento_m" readonly onmousedown="return false;">
                        <label class="font-weight-bold ml-1 mt-2 " >Tipo de Documento</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="tipo_documento_m">
                        <label class="font-weight-bold ml-1 mt-2 ">Nombres</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="nombres_m">
                        <label class="font-weight-bold ml-1 mt-2 ">Apellidos</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="apellido_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Correo Personal</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="correo_personal_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Correo Sena</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="correo_sena_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Telefono</label>
                        <input class="form-control w-100  ml-1 mr-1" type="number" id="telefono_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Celuar 1</label>
                        <input class="form-control w-100  ml-1 mr-1" type="number" id="celular1_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Celuar 2</label>
                        <input class="form-control w-100  ml-1 mr-1" type="number" id="celular2_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Tipo de Sangre</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="tipoSangre_m">
                        <label class="font-weight-bold ml-1 mt-2 " >EPS</label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="eps_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Genero <i>M:Masculino, F:Femenino</i><br></label>
                        <input class="form-control w-100  ml-1 mr-1" type="text" id="genero_m">
                        <label class="font-weight-bold ml-1 mt-2 " >Estado <i>1:Activo, 0:Inactivo</i><br></label>
                        <input class="form-control w-100  ml-1 mr-1" type="number" id="estado_m">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <button type="button" class="btn btn-success" id="actualizar" data-bs-dismiss="modal" >Modificar</button>

                </div>
            </div>
        </div>
            

            <script src="js/funcionVoceros.js"></script>
            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#btnVoc').click(function(){
                        Ficha = $('#Ficha').val();
                        TipoDeDocumento = $('#TipoDeDocumento').val();
                        NumeroDeDocumento = $('#NumeroDeDocumento').val();
                        Nombres = $('#Nombres').val();
                        Apellidos = $('#Apellidos').val();
                        CorreoPersonal = $('#CorreoPersonal').val();
                        CorreoSena = $('#CorreoSena').val();
                        Telefono = $('#Telefono').val();
                        Celular1 = $('#Celular1').val();
                        Celular2 = $('#Celular2').val();
                        TipoDeSangre = $('#TipoDeSangre').val();
                        EPS = $('#EPS').val();
                        Genero = $('#Genero').val();

                        crear_vocero(Ficha,TipoDeDocumento,NumeroDeDocumento,Nombres,Apellidos,CorreoPersonal,CorreoSena,Telefono,Celular1,Celular2,TipoDeSangre,EPS,Genero); 
                        }); 
                    });
            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#btn_consultar_vocero').click(function(){
                        consultaVocero = $('#consultaVocero').val();
                        consulta_vocero(consultaVocero); 
                        }); 

                    });

            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#mostrar_modal_vocero').click(function(){
                        NumeroDeDocumentoModal = $('#documento_vocero').val();

                        mostrar_vocero_modal(NumeroDeDocumentoModal); 
                        }); 

                    });

            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#actualizar').click(function(){

                        id_voc =$('#id_voc_m').val();
                Ficha_id_fic =$('#Ficha_id_fic_m').val();
                Usuario_id_usu =$('#usuario_voc_m').val();
                documento_voc =$('#numeroDocumento_m').val();
                tipoDoc_voc =$('#tipo_documento_m').val();
                nombre_voc =$('#nombres_m').val();
                apellido_voc =$('#apellido_m').val();
                correoPer_voc =$('#correo_personal_m').val();
                correoSena_voc =$('#correo_sena_m').val();
                telefono_voc =$('#telefono_m').val();
                celular1_voc =$('#celular1_m').val();
                celular2_voc =$('#celular2_m').val();
                tipoDeSangre_voc =$('#tipoSangre_m').val();
                eps_voc =$('#eps_m').val();
                genero_voc =$('#genero_m').val();
                numero_fic_c =$('#numero_ficha_m').val();
                estado_m =$('#estado_m').val();

                        actualizar_vocero(id_voc,Ficha_id_fic,Usuario_id_usu,documento_voc,tipoDoc_voc,nombre_voc,apellido_voc,correoPer_voc,correoSena_voc,telefono_voc,celular1_voc,celular2_voc,tipoDeSangre_voc,eps_voc,genero_voc,numero_fic_c,estado_m); 
                        }); 

                    });

            </script>

            <script type="text/javascript" >
                $(document).ready(function(){
                    $('#eliminar_vocero').click(function(){
                        Usuario_id_usu = $('#Usuario_id_usu').val();

                        preguntarSiNo(Usuario_id_usu); 
                        }); 

                    });

            </script>






    <?php

    
        
       //si no tiene sesion iniciada, el sistema redirige a salir.php que borra la sesion y redirige al login 
    }else{
    header('location: php/salir.php');
  }
 
  
    ?>    


    <footer class="container">

        <p>© SAVB 2021</p>

    </footer>

</html>