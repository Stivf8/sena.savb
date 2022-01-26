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
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.map"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<h4 align="center">Consulta de Voceros e Instructores</h4>
<p align="center">
    <!--Parrafo de bienvenida al usuario que se conecte-->
        Querido Usuario, para realizar la consulta de los datos de contacto de  voceros e instructores debe tener en cuenta que la consulta solo funcionara conociendo el numero de ficha que quiere consultar.</p><br>

<body>

<h6 align="center">
        <form method="POST" name="ConsultaVoceroConFicha" class="needs-validation">
            <div class="container">
                <div class="row">
                <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                    <!--Formulario de consulta de voceros-->

                        <input type="number" class="form-control" placeholder="Consultar vocero por ficha" type="search" name="Consultaccvoceros">
                        <input type="submit"  style=" background-color: #ff4500;" class="btn text-white mb-2" value="Consultar Voceros" require><br><br><br>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                    <!--Formulario de consulta de instructores-->

                        <input type="number" type="search" class="form-control" placeholder="Consultar instructores por ficha" name="ConsultaFichaInstructor">
                        <input type="submit" style=" background-color: #ff4500;" class="btn text-white mb-2" value="Consultar Instructor"><br><br><br>
                    </div>
                    <div class="col-md-1">
                    </div></div>
                </div>
            </div>
        </form>
        
        <!--Aqui vamos a realizar la consulta de los voceros consultados, se realiza en base a la ficha-->
        <?php 
        if(!empty($_POST)){ 
            $ficha=$_POST['Consultaccvoceros'];
            $instrctor=$_POST['ConsultaFichaInstructor'];
            if(!empty($ficha)){
                $busqueda3=$conexion->query("SELECT f.id_fic, f.numero_fic, CONCAT(v.nombre_voc,' ',v.apellido_voc) as nombres, v.correoSena_voc, v.correoPer_voc, v.celular1_voc, v.celular2_voc FROM vocero v, ficha f WHERE f.id_fic= v.Ficha_id_fic AND f.numero_fic='$ficha' AND v.status=1");
                $arrVocerosFicha=$busqueda3->fetchAll(PDO::FETCH_ASSOC);
                
                echo 'Ficha Voceros: ';echo $ficha;
                ?>
                <br></br>
                <?php 
                ?>

    <!--Aqui se pintaran los datos del vocero o voceros consultados-->
                <div class="container">
            <div class="row">
                <div class="col-md-12">

                        <div class="table-responsive">
                            <table    class="table table-hover">
                                    <tr>
                                        <th class="bg-primary" scope="col">Nombres</th>
                                        <th class="bg-primary" scope="col">Correo Sena</th>
                                        <th class="bg-primary" scope="col">Correo Personal</th>
                                        <th class="bg-primary" scope="col">Celular 1</th>
                                        <th class="bg-primary" scope="col">Celular 2</th>
                                    </tr>

                    
                    
                    
   
 <?php
/* var_dump($arrDatos);*/
//aqui recorremos el arreglo con la consulta hecha previamente, esto con el fin de imprimir el dato en su columna correspondiente
if(!empty($arrVocerosFicha)){
foreach ($arrVocerosFicha as $muestra) {
    $datos= $muestra->nombre_voc.'||'.$muestra->apellido_voc.'||'.$muestra->correoSena_voc.'||'.$muestra->correoPer_voc.'||'.$muestra->correoSena_fun.'||'.$muestra->celular1_voc.
    '||'.$muestra->celular2_voc;

    
echo '<tr>';
echo '<td >' . $muestra['nombres'] . '</td>';
echo '<td >' . $muestra['correoSena_voc'] . '</td>';
echo '<td >' . $muestra['correoPer_voc'] . '</td>';
echo '<td >' . $muestra['celular1_voc'] . '</td>';
echo '<td >' . $muestra['celular2_voc'] . '</td>';

?>
<?php
echo ' </tr>';
}
}else{
    $alerta='<div class="alert alert-danger mt-2" role="alert">
                                No se han encontrado datos
                                </div>';
                                
                                echo isset($alerta)? $alerta:''; ?>
                                </div><?php
}
?>
</table>
</div>
</div>
<?php

            }elseif(!empty($instrctor)){
                $busqueda3=$conexion->query("SELECT f.id_fic, f.numero_fic, CONCAT(i.nombre_ins,' ',i.apellido_ins) as nombres, i.correoSena_ins, i.celular_ins FROM instructor i, ficha f WHERE f.id_fic= i.Ficha_id_fic AND f.numero_fic='$instrctor' AND v.status=0");
                $arrinsFicha=$busqueda3->fetchAll(PDO::FETCH_ASSOC);

                echo 'Ficha instructores: ';echo $instrctor;
                ?>
                <br></br>
                <?php 
                ?>
                <!--Aqui se pintaran los datos del instructor o instructores consultados-->
                        <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table    class="table table-hover">
           <tr>
               <th class="bg-primary" scope="col">Nombres</th>
               <th class="bg-primary" scope="col">Correo Sena</th>
               <th class="bg-primary" scope="col">Celular</th>
           </tr>
         <?php
        //aqui recorremos el arreglo con la consulta hecha previamente, esto con el fin de imprimir el dato en su columna correspondiente
         if(!empty($arrinsFicha)){
        foreach ($arrinsFicha as $muestra) {
            $datos= $muestra->nombre_ins.'||'.$muestra->apellido_ins.'||'.$muestra->correoSena_ins.'||'.$muestra->celular_ins;
        
            
        echo '<tr>';
        echo '<td >' . $muestra['nombres'] . '</td>';
        echo '<td >' . $muestra['correoSena_ins'] . '</td>';
        echo '<td >' . $muestra['celular_ins'] . '</td>';
        
        ?>
        <?php
        echo ' </tr>';
        }
    }else{
        $alerta='<div class="alert alert-danger mt-2" role="alert">
                                No se han encontrado datos
                                </div>';
                                
                                echo isset($alerta)? $alerta:''; ?>
                                </div><?php
    }
        ?>
        </table>
        </div>
        </div>
        <?php
        }?>

    </h6>
    

     <?php
    //validamos tipo de rol funcionario
    if($_SESSION['misession']['tipoRol_usu']==1){
        //select de todas las novedades
        $rol='Funcionario';
        ?> 
    </h2><br><br><br>
    
         
    <?php}//validamos que sea instructor
    elseif($_SESSION['misession']['tipoRol_usu']==2){
        //select de todas las novedades con el id del instructor
        $rol='Instructor';
     ?>
    <?php}//validamos que sea un aprendiz/vocero
    elseif($_SESSION['misession']['tipoRol_usu']==3){
        $rol='Aprendiz';
        //select de todas las novedades con el id del vocero
        ?>
    <?php
    }
 //si no tiene sesion iniciada, el sistema redirige a salir.php que borra la sesion y redirige al login
  }else{
    header('location: php/salir.php');
  }}
 
  
 ?>
    <footer class="container">

        <p align="center"><b>© SAVB 2021</b></p>

    </footer>

</body>

</html>