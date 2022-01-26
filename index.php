<?php 
require_once "php/conexion.php";
$alerta='';
SESSION_START();

    if (!empty($_POST)){
        if(empty($_POST['documentoUser'])|| empty($_POST['passUser'])){
            $alerta ='<div class="alert alert-danger mt-2" role="alert">
            Ingrese su Usuario y/o Contraseña
            </div>';
        }else{ 
            $usuario=$_POST['documentoUser'];
            $pass=$_POST['passUser'];
            $tipoRol=$_POST['tipo_rol'];
            $lvsavb=$usuario+882376;
            $consulta=$conexion->query("SELECT * FROM usuario where Usuario='$usuario' and '$pass'=(select cast(aes_decrypt(contrasena_usu, '$lvsavb') as char) from Usuario where Usuario='$usuario') and Rol_id_rol='$tipoRol'");
            if($consulta->rowCount()==1){
                $miSession = array('doc_usu'=>$usuario, 'tipoRol_usu'=>$tipoRol);		
                $_SESSION['misession'] = $miSession;   
                header('location: inicioNoticias.php'); 
            }else{
                $alerta='<div class="alert alert-danger mt-2" role="alert">
                Algo ha salido mal, por favor valida los datos e intenta nuevamente.
                </div>';
                SESSION_DESTROY();
            }                       
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
           <link rel="stylesheet" href="css/bootstrap.min.css">
           <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
           <link rel="stylesheet" href="css/estilos.css">
           <!-- <script type="text/javascript" src="js/login.js"></script> -->
           <!-- <script type="text/javascript" src="js/localstorage.js"></script> -->
           <img src="imagenes/savb.png" width="90" height="90" align="right">
           <img src="imagenes/senalogo.png" width="90" height="90" align="left">
           
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVB</title>
</head>
<!------ INICIO DE SESION SAVB ---------->
    
<body id="fondo">
    <div>
    </div>
<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-imagen">
                </div>
                <div class="col-md-6 login-form-1">
                    <h3>SAVB</h3>
                    <form method="POST" id="formularioInicioSesion">
                        <div class="form-group">
                            <input type="number" required class="form-control" name="documentoUser" placeholder="Numero de Documento *" value="" id="documentoUser"/>
                        </div>
                        <div class="form-group">
                            <input type="password" required class="form-control" name="passUser" placeholder="Tu Clave *" value="" id="passUser"/>
                        </div>
                        <div class="form-group">
                        <select name="tipo_rol" id="tipoRol">
                            <option value="1">Funcionario</option>
                            <option value="2">Instructor</option>
                            <option value="3">Aprendiz</option>                             
                         </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Iniciar Sesion" id="submit"> <br>
                            <?php echo isset($alerta)? $alerta:''; ?>
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Olvidaste la clave?</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <footer class="container">

<p>© SAVB 2021</p>

</footer>
    </body>
</html>