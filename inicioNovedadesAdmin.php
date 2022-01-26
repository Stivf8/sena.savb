<?php 
session_start();
//validamos qu;e ya tenga sesion iniciada
if (isset($_SESSION['misession']) ) {
    require_once "php/conexion.php";
    require_once "php/nav.php";;
?>
 <aside class="container">      
          <!--Depende el tipo de usuario, el mensaje de bienvenida cambiara, se utiliza la variable mensjNov-->
               <h2 class="mb-1" align="center">NOVEDADES <?php echo $mensjNov;?></h2> 
</h5><!--Se empieza a estructurar la pagina con boostrap utilizando divs-->
                     <div class="container">
                     <div class="row">
                     <div class="col-md-12" align="center"> 
                         <br><br><br>
                         <div class="form-group">
                         <form action="" method="POST">
                             <label for="filtro">Filtro</label>
                             <!--Filtro de la novedad-->
                        <select name="filtroNovedad" id="filtroNovedad">
                            <option value="T">Todo</option> 
                            <option value="P">Pendiente</option> 
                            <option value="EP">En Proceso</option>
                            <option value="C">Cerrado</option>
                         </select>
                         <!--Filtro por ficha de novedad-->
                         <input type="search" placeholder="Ficha  (Opcional)" name="buscadorFicha">
                         <input align="center"type="submit" value="Consultar">
                         </form>
                         <?php                  //se valida que contenga datos los campos de filtro
                   if(!empty($_POST)){ 
                    $buscadorFicha=$_POST['buscadorFicha'];
                    $filtroNovedad=$_POST['filtroNovedad'];
                            if(empty($buscadorFicha)){
                                    //si ingresaron algo en el campo ficha el buscara con ficha
                                if($_POST['filtroNovedad']=='T'){
                                        //select a todo para ese usuario
                                        $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, v.Ficha_id_fic, n.estado_nov, v.documento_voc, n.contenido_nov FROM novedad n, vocero v WHERE n.Vocero_id_voc = v.documento_voc ORDER BY n.id_nov");
                                        $arrNovedades=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                        echo 'FILTRO: TODO';
                                }elseif($_POST['filtroNovedad']=='P'){
                                //select de pendientes para ese usuario
                                $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, n.contenido_nov, v.Ficha_id_fic, n.estado_nov, v.documento_voc FROM novedad n, vocero v WHERE n.Vocero_id_voc = v.documento_voc AND n.estado_nov ='Pendiente' ORDER BY n.id_nov");
                                $arrNovedades=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo 'FILTRO: ESTADO EN PENDIENTE';
                                }elseif($_POST['filtroNovedad']=='EP'){
                                //select de en proceso para ese usuario
                                $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, n.contenido_nov, v.Ficha_id_fic, n.estado_nov, v.documento_voc FROM novedad n, vocero v WHERE n.Vocero_id_voc = v.documento_voc AND n.estado_nov ='En Proceso' ORDER BY n.id_nov");
                                $arrNovedades=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo 'FILTRO: ESTADO EN PROCESO';
                                }elseif($_POST['filtroNovedad']=='C'){
                                //select de cerradas para ese usuario
                                $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, n.contenido_nov, v.Ficha_id_fic, n.estado_nov, v.documento_voc FROM novedad n, vocero v WHERE n.Vocero_id_voc = v.documento_voc AND n.estado_nov ='Cerrado' ORDER BY n.id_nov");
                                $arrNovedades=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                                echo 'FILTRO: ESTADO CERRADO';
                                }}
                            }
                            
                                        
?>
                         </div>       
</div>
<!--aqui definimos las estructura de la tabla la cual mostrara las novedades-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
<br>
<table   class="table table-bordered">
   <tr>
       <th class="bg-primary" scope="col">Numero Novedad</th>
       <th class="bg-primary" scope="col">Titulo</th>
       <th class="bg-primary" scope="col">Contenido</th>
       <th class="bg-primary" scope="col">Ficha</th>
       <th class="bg-primary" scope="col">Documento</th>
       <th class="bg-primary" scope="col">Estado</th>
   </tr>
 <?php
/* var_dump($arrDatos);*/
//aqui recorremos el arreglo con la consulta hecha previamente, esto con el fin de imprimir el dato en su columna correspondiente
foreach ($arrNovedades as $muestra) {
    
echo '<tr>';
echo '<td >' . $muestra['id_nov'] . '</td>';
echo '<td >' . $muestra['titulo_nov'] . '</td>';
echo '<td >' . $muestra['contenido_nov'] . '</td>';
echo '<td >' . $muestra['Ficha_id_fic'] . '</td>';
echo '<td >' . $muestra['documento_voc'] . '</td>';
echo '<td >' . $muestra['estado_nov'] . '</td>';

$id_nov=$muestra['id_nov'];
$titulo=$muestra['titulo_nov'];
$ficha=$muestra['Ficha_id_fic'];
$contenido_nov=$muestra['contenido_nov'];
$estado_nov=$muestra['estado_nov'];

$datos=$id_nov.'||'.$titulo.'||'.$ficha.'||'.$contenido_nov.'||'.$estado_nov;

?>
       <!-- Se crean el boton editar que dispara la funcion agregar y envia los datos que estan en la cadena $datos -->
       <td><li><a class="dropdown-item btn btn-warning ajax-request" data-bs-toggle="modal" data-bs-target="#editar" onclick="gestion('<?php echo $datos?>')">Gestionar</a></li></td>
<?php
echo ' </tr>';
}

?>
</table>
</div><?php
    //validamos tipo de rol funcionario
    if($_SESSION['misession']['tipoRol_usu']==1){
        //select de todas las novedades
        $busqueda=$conexion->query("SELECT n.id_nov, n.titulo_nov, v.Ficha_id_fic, n.estado_nov, v.documento_voc, n.contenido_nov FROM novedad n, vocero v WHERE n.Vocero_id_voc = v.documento_voc ORDER BY n.id_nov");
        $arrNovedades=$busqueda->fetchAll(PDO::FETCH_ASSOC);
        $id_usu=$_SESSION['misession']['doc_usu'];
        $busquedaNombres=$conexion->query("SELECT nombre_fun nombre, apellido_fun apellido FROM funcionario WHERE documento_fun = '$id_usu'");
        $arrNombres=$busquedaNombres->fetchAll(PDO::FETCH_ASSOC);
        $mensjNov='REPORTADAS';
        ?>

        <!--Formularios para la respuesta y reporte de novedades-->
        <div class="container">
            <div class="row">
<div class="col-md-12">
<h6 align="left">

                            <?php                  //se valida que contenga datos los campos de filtro
                   
                   }?>

                    <form action="" name="respondeNovedad" method="POST">
                    <textarea name="respondeNovedad" id="respondeNovedad" cols="70" rows="3" placeholder="Responder"></textarea><br>
                    <label for="EstadoNovedad">Actualizar estado a:  </label>
                <select name="Actualizar Estado de Novedad">
                    <option value="Pendiente">Pendiente</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Solucionada">Solucionada</option>
                </select>                
                <input align="right"type="submit" value="Enviar">                
                </form>
                </h6>         
</div></div></div>
        <?php
    ?>
        <div class="container">
            <div class="row">
<div class="col-md-12">
<h6 align="left">
                    <form method="POST" name="reportaNovedad">
                    <textarea name="reportaNovedadTitulo" id="reportaNovedadTitulo" cols="30" rows="1" placeholder="Titulo de Novedad"></textarea><br>
                            <textarea name="reportaNovedadContenido" id="reportaNovedadContenido" cols="70" rows="3" placeholder="Describe la novedad sucedida en tu ficha"></textarea><br>
                            <input align="right"type="submit" value="Reportar Novedad">
                            </form>
        <?php
        //select de todas las novedades con el id del vocero
    
    //si no tiene sesion iniciada, el sistema redirige a salir.php que borra la sesion y redirige al login
  }else{
    header('location: php/salir.php');
  }
 ?>
<!DOCTYPE html>
    <html lang="es">
        <head>
            <title>SAVB</title>
            <link rel="stylesheet" href="estilo/estilos.css">  
           <link rel="stylesheet" href="css/bootstrap.min.css">
           <script type="text/javascript" src="js/bootstrap.min.js"></script>
           <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
       </head>
<body>       
                <footer class="container">

<p>© SAVB 2021</p>

</footer>
          
<!-- Pantalla Modal
Para editar -->
<!-- Se crea el espacio donde ira la pantalla modal -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <!-- Se pone un titulo a esta pantalla -->
                <h5 class="modal-title" id="exampleModalLabel">Gestion de Novedad</h5>
                    <!-- SE crea un boton para cerrar dicha pantalla -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Aqui va el cuerpo de la pantalla -->
                <div class="modal-body">
                    <!-- Se llama al id del registro pero se oculta, ya que este no puede ser cambiado por el usuario -->
                    <input type="hidden" id="id_nov"> 
                    <!-- Se pone el nombre del campo y en un input se mostrara el dato guardado en el campo, para asi poder editarlo  -->
                    <label class="font-weight-bold ml-1 mt-2 col-12">Titulo Novedad</label>
                    <input class="form-control" type="text" id="titulo_nov" readonly onmousedown="return false;" />
                    <label class="font-weight-bold ml-1 mt-2 col-12">Ficha</label>
                    <input class="form-control" type="text" id="Ficha_id_fic" readonly onmousedown="return false;" />
                    <label class="font-weight-bold ml-1 mt-2 col-12">Contenido</label>
                    <textarea class="form-control w-100  ml-1 mr-1" id="contenido_nov" cols="30" rows="6" readonly onmousedown="return false;"></textarea>
                    <label class="font-weight-bold ml-1 mt-2 col-12">Estado</label>
                    <select name="EstadoNovedad" id="EstadoNovedad">
                            <option value="Pendiente">Pendiente</option> 
                            <option value="En Proceso">En Proceso</option> 
                            <option value="Cerrado">Cerrado</option>
                         </select>
                    <label class="font-weight-bold ml-1 mt-2 col-12">Comentario</label>
                    <input class="form-control w-100  ml-1 mr-1" type="text" id="comentario">
                    
                </div>
                <!-- Aqui va el pie de la pagina modal, donde iran los botones de esta -->
                <div class="modal-footer">
                <!-- Se crea el boton cancelar, el cual sale de la pantalla modal sin guardar ningun cambio en la BD -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Se crea el boton modificar el cual enviara los datos del formulario -->
                    <button type="button" class="btn btn-success" id="actualizar" data-bs-dismiss="modal"   >Responder</button>

                </div>
            </div>
    </div>
</div>
</body>
</html>
<!-- Se hace referencia añ archivo actualizarUsuarioFun.js el cual nos actualizara los datos en la bd -->
<script src="js/gestionNovedad.js"></script>
<script type="text/javascript" >
    //Aqui se llama al boton modificar mediante su id y llama la funcion actualizardatos la cual enviara
     //estos al archivo en que se procesaran los datos
    $(document).ready(function(){
       $('#gestion').click(function(){
        actualizarDatos(); 
       }); 
    });
</script>
