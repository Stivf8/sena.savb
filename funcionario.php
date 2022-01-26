<?php
//se inicia la funcion que valida la sesion
session_start();
//se conecta con los archivo nav que trae la barra de navegacion y conexion para conectar la BD
require_once "php/nav.php";
require_once "php/conexion.php";

?>

<!-- se inicia la estructura en html -->
<!DOCTYPE html>
    <html lang="es">

    <head>
            <!-- esta etiqueta nos ayuda a que el diseño de la pagina sea responsivo -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <!-- aqui estamos referenciando bootstrap para el diseño de la pagina -->
           <link rel="stylesheet" href="css/bootstrap.min.css">
           <link rel="stylesheet" href="iconos/fontawesome/css/all.css">
           <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
           <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
           <!-- aca estamos referenciando una hoja de estilos en css para el diseño de nuestra pagina -->
           <link rel="stylesheet" href="css/estilos.css"> 
           <link rel="stylesheet" href="estilo/estilos.css">
           <!-- Se referencia la libreria alertify que nos ayudara a mostrar las alertas en pantalla  -->
           <script src="alertifyjs/alertify.js"></script>
           <!-- Se referencia el login y el archivo que nos ayudara a que se verifique la sesion del usuario -->
        <script type="text/javascript" src="js/login.js"></script>
        <script type="text/javascript" src="js/localstorage.js"></script>
        <!-- Llamamos este archivo que nos ayudara a que no se vuelvan a registrar los datos en multiples ocasiones -->
        <script src="js/evitar_reenvio.js"></script>
        <!-- Se establece que codificacion tendra la pagina en este caso UTF-8 -->
        <meta charset="UTF-8">
        <!-- Se indica la compatibilidad con el navegador -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Se le pone un titulo a la pagina, este no aparece en pantalla -->
        <title>SAVB</title>
    </head>
<body>
                     <!-- Se poden un titulo que si aparecera en pantalla -->
                    <h2 align="center">
                        GESTION DE USUARIOS
                    </h2><br>
                    <!-- Se establece el titulo que aparecera en pantalla "FUNCIONARIO" -->
                    <h2 align="center">
                      FUNCIONARIO
                    </h2>
                    <!-- Se crea un formulario que servira como una barra buscadora -->
                    <form method="POST" class="form_search">
                        <!-- <textarea name="buscador" id="buscador" placeholder="buscador"></textarea> -->
                        <input type="search" placeholder="Buscar" name="buscador">
                        <input type="submit" class="form-control btn_search" value="Buscar"><br>
                    </form>
<?php
//En un condicional simple se pregunta si lo que traemos del buscador contiene algun valor
//si es asi, entonces este valor se asignara a la variable "$buscar"
if (isset($_POST['buscador'])) {
    //Se nombra variable buscar y se le asigna el dato que recoge el forulario
    $buscar=$_POST['buscador'];
}
//Se abre un condicional, si la variable buscar esta vacia se hara una consulta general de la tabla instructor
//de lo contrario, ejecutara una consulta especifica por cada campo de la tabla
if (empty($buscar)) {
    $busqueda=$conexion->query("Select * from funcionario where status=0");
    //Almacenamos el resultado de fetchAll en una variable/
}else {
    $busqueda= $conexion->query("select * from funcionario where nombre_fun = '$buscar' or apellido_fun = '$buscar' or documento_fun = '$buscar' 
    or cargo_fun = '$buscar' or tipoSangre_fun= '$buscar' or eps_fun= '$buscar' or genero_fun= '$buscar' or correoSena_fun= '$buscar'
    or tipoDoc_fun= '$buscar' and status=0");
}
?>
<lu><a class="btn papaya ajax-request" data-bs-toggle="modal" data-bs-target="#crearUsuario">Crear Usuario</a></lu>
<?php
//Se crea un arreglo que recibira todos los datos de dicha consulta
$arrDatos=$busqueda->fetchAll(PDO::FETCH_OBJ);
?>
<!-- Se crea una tabla y se nombran todos los campos que tendra -->
<table   class="table table-bordered">
   <tr>
       <th class="bg-primary" scope="col">Documento</th>
       <th class="bg-primary" scope="col">Tipo Documento</th>
       <th class="bg-primary" scope="col">Nombre</th>
       <th class="bg-primary" scope="col">Apellido</th>
       <th class="bg-primary" scope="col">Correo</th>
       <th class="bg-primary" scope="col">celular</th>
       <th class="bg-primary" scope="col">Cargo</th>
       <th class="bg-primary" scope="col">Tipo de sangre</th>
       <th class="bg-primary" scope="col">EPS</th>
       <th class="bg-primary" scope="col">Genero</th>
   </tr>
    <?php

   /*var_dump($arrDatos);*/
   //Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch.../
   foreach ($arrDatos as $muestra) {
       //se nombra una cadena $datos con todos los datos de la tabla funcionario, los cuales enviara a la pantalla modal
    $datos= $muestra->id_fun.'||'.$muestra->documento_fun.'||'.$muestra->tipoDoc_fun.'||'.$muestra->nombre_fun.'||'.$muestra->apellido_fun.'||'.$muestra->correoSena_fun.'||'.$muestra->celular_fun.
    '||'.$muestra->cargo_fun.'||'.$muestra->tipoSangre_fun.'||'.$muestra->eps_fun.'||'.$muestra->genero_fun;
       ?>
       <!-- El echo mostrara cada dato en la tabla, en la variable "muestra" esta cada dato de la tabla -->
        <tr>
        <td ><?php echo $muestra->documento_fun?></td>
        <td ><?php echo $muestra->tipoDoc_fun?></td>
        <td ><?php echo $muestra->nombre_fun?></td>
        <td ><?php echo $muestra->apellido_fun?></td>
        <td ><?php echo $muestra->correoSena_fun?></td>
        <td ><?php echo $muestra->celular_fun?></td>
        <td ><?php echo $muestra->cargo_fun?></td>
        <td ><?php echo $muestra->tipoSangre_fun?></td>
        <td ><?php echo $muestra->eps_fun?></td>
        <td ><?php echo $muestra->genero_fun?></td>
        <!-- Se crean el boton editar que dispara la funcion agregar y envia los datos que estan en la cadena $datos -->
        <td><lu><a class="btn btn-warning ajax-request" data-bs-toggle="modal" data-bs-target="#editar" onclick="agregar('<?php echo $datos?>')">Editar</a></lu></td>
		<!-- Se crea el boton eliminar la funcion preguntasino, la cual muestra en pantalla una alerta sobre si se quiere eliminar el registro y guarda el id de este -->
        <td><lu><a class="btn btn-danger ajax-request"  data-bs-toggle="modal" data-bs-target="#eliminar" onclick="preguntarSiNo('<?php echo $muestra->id_fun;?>');">Eliminar</a></lu></td>
        </tr>
<?php
    }

    ?>
    </table>
 <!-- Pantalla Modal
Para editar -->
<!-- Se crea el espacio donde ira la pantalla modal -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <!-- Se pone un titulo a esta pantalla -->
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                    <!-- SE crea un boton para cerrar dicha pantalla -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Aqui va el cuerpo de la pantalla -->
                <div class="modal-body">
                    <!-- Se llama al id del registro pero se oculta, ya que este no puede ser cambiado por el usuario -->
                    <input type="hidden" id="id_fun"> 
                    <!-- Se pone el nombre del campo y en un input se mostrara el dato guardado en el campo, para asi poder editarlo  -->
                    <label class="font-weight-bold ml-1 mt-2 ">Documento</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="documento_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Tipo de Documento</label>
                    <select class="form-control h-100 w-100 ml-1 mr-1 text-start" id="tipoDoc_fun">
                    <option value="CC">c.c</option>
                    <option value="TI">t.i</option>
                    <option value="CE">c.e</option>
                    </select>
                    <label class="font-weight-bold ml-1 mt-2 ">Nombre</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="nombre_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Apellido</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="apellido_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Correo</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="correoSena_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Celular</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="celular_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Cargo</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="cargo_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Tipo de Sangre</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="tipoSangre_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">EPS</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="eps_fun">
                    <label class="font-weight-bold ml-1 mt-2 ">Genero</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="genero_fun">
                    
                </div>
                <!-- Aqui va el pie de la pagina modal, donde iran los botones de esta -->
                <div class="modal-footer">
                <!-- Se crea el boton cancelar, el cual sale de la pantalla modal sin guardar ningun cambio en la BD -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Se crea el boton modificar el cual enviara los datos del formulario -->
                    <button type="button" class="btn btn-success" id="actualizar" data-bs-dismiss="modal"   >Modificar</button>

                </div>
            </div>
    </div>
</div>

 <!-- Pantalla Modal
Para Crear usuarios -->
<!-- Se crea el espacio donde ira la pantalla modal -->
<div class="modal fade" id="crearUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <!-- Se pone un titulo a esta pantalla -->
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                    <!-- SE crea un boton para cerrar dicha pantalla -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Aqui va el cuerpo de la pantalla -->
                <div class="modal-body">
                <label class="font-weight-bold ml-1 mt-2 ">Rol</label>
                                <select class="form-control h-100 w-100 ml-1 mr-1 text-start" id="rol1">
                                    <option value="1">Funcionario</option> 
                                </select>
                    <!-- Se pone el nombre del campo y en un input se mostrara el dato guardado en el campo, para asi poder editarlo  -->
                    <label class="font-weight-bold ml-1 mt-2 ">Documento</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="documento_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Tipo de Documento</label>
                    <select class="form-control h-100 w-100 ml-1 mr-1 text-start" id="tipoDoc_fun1">
                    <option value="CC">c.c</option>
                    <option value="TI">t.i</option>
                    <option value="CE">c.e</option>
                    </select>
                    <label class="font-weight-bold ml-1 mt-2 ">Nombre</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="nombre_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Apellido</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="apellido_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Contraseña</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="contrasena1">
                    <label class="font-weight-bold ml-1 mt-2 ">Correo</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="correoSena_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Celular</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="celular_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Cargo</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="cargo_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Tipo de Sangre</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="tipoSangre_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">EPS</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="eps_fun1">
                    <label class="font-weight-bold ml-1 mt-2 ">Genero</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="genero_fun1">
                    
                </div>
                <!-- Aqui va el pie de la pagina modal, donde iran los botones de esta -->
                <div class="modal-footer">
                <!-- Se crea el boton cancelar, el cual sale de la pantalla modal sin guardar ningun cambio en la BD -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Se crea el boton modificar el cual enviara los datos del formulario -->
                    <button type="button" class="btn btn-success" id="crear" data-bs-dismiss="modal">Crear</button>

                </div>
            </div>
    </div>
</div>
</body>
</html>
<!-- Se hace referencia añ archivo actualizarUsuarioFun.js el cual nos actualizara los datos en la bd -->
<script src="js/actualizarUsuarioFun.js"></script>
<script src="js/crearUsuario.js"></script>
<script type="text/javascript" >
    //Aqui se llama al boton modificar mediante su id y llama la funcion actualizardatos la cual enviara
     //estos al archivo en que se procesaran los datos
    $(document).ready(function(){
       $('#actualizar').click(function(){
        actualizarDatos(); 
       }); 
    });
    $(document).ready(function(){
       $('#crear').click(function(){
        crearUsuariofun(); 
       }); 
    });
</script>
