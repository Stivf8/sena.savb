<?php
//Aqui definimos una variable que nos trae  $_SESSION['misession'] que la trae desde index.php
session_start();
// aqui llamamos la conexion con DB que esta subida en Xampp
require_once "conexion.php";
// este metodo nos ayuda a que la variables que esten nula no nos muestre error undefined variable
    error_reporting(0);
//Aqui definimos esta variable nula que la utilizaremos en las repuestas si se agrego la noticia o no
    $alerta= "";
//Aqui definimos una condicion que no permite validar si lel metodo POST esta nulo o no, que  nos trae desde el formulario adminNoticas.php
   if (!empty($_POST)) {
       //Aqui definimos una condicion de los campos que  nos trae desde el formulario adminNoticas.php por medio del name de las etiquetas
       if (!empty($_POST['titulo']) && !empty($_POST['contenido'])) {

           $titulo=htmlspecialchars($_POST['titulo'],ENT_QUOTES,'UTF-8');
           $contenido=htmlspecialchars( $_POST['contenido'],ENT_QUOTES,'UTF-8');
           $img= "";
           $tipo= $_SESSION['misession']['tipoRol_usu'];
        //Aqui llamamos un metodo para que traiga la fecha y hora de la ciudad
           date_default_timezone_set("America/Bogota");
           $fecha= date("Y-m-d");
           $hora= date("h:i:sa");
           $estado= 1;
           if (is_array($_FILES) && count($_FILES)>0) {
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../imagenes/".$_FILES["imagen"]["name"])){
                    echo 1;
                }
            }
            $img='imagenes/'.$_FILES["imagen"]["name"];
        //Aqui hacemos un query de insertar datos a la tabla de noticias 
           $crear= $conexion->query("insert into noticia(Funcionario_id_fun, titulo_not, contenido_not, fecha_not, hora_not, img_not,status)
                                       values ('$tipo', '$titulo', '$contenido', '$fecha', '$hora','$img', '$estado');");
           //Aqui consultamos a la DB donde nos traera los registros 
            $busqueda=$conexion->query("Select max(id_not) from noticia where fecha_not= '$fecha'");
           //Aqui creamos un arreglo de la consulta de la linea 26
           $arrDatos=$busqueda->fetchAll();
            print_r($arrDatos);
           //unset($_POST['titulo'],$_POST['contenido'],$_POST['imagen']);
           //Aqui definimos una condicion que nos ayuda a validar si es arreglo esta nula de la linea 27
            //if (!empty($arrDatos)) {
                    //aqui mostrara un mensaje si se resgistro exitoso
                   /*$alerta='<br><div class="alert  alert-success text-center w-100 col-11 ml-2 mt-1" role="alert">
                              Registro exitoso!!
                           </div>'; 
               }//finaliza la condicion de la linea 29
       }else{
           //aqui mostrara un mensaje no se resgistro 
           $alerta='<br><div class="alert alert-danger col-11 ml-2 mt-1" role="alert">
                           Por favor diligenciar todos los campos del formulario.
                       </div>';*/
       }//finaliza la negacion de la condicion
   }

?>