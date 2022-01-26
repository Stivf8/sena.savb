//Se crea la funcion agregar y esta trae los datos de la cadena $datos
function agregar(datos) {
    d=datos.split('||');
  $('#id_fun').val(d[0]) ;
   $('#documento_fun').val(d[1]);
   $('#tipoDoc_fun').val(d[2]);
    $('#nombre_fun').val(d[3]);
    $('#apellido_fun').val(d[4]);
    $('#correoSena_fun').val(d[5]);
    $('#celular_fun').val(d[6]);
    $('#cargo_fun').val(d[7]);
    $('#tipoSangre_fun').val(d[8]);
    $('#eps_fun').val(d[9]);
    $('#genero_fun').val(d[10]);       
  }
  //Se crea la funcion actualizarDatos y esta nombra los datos traidos en una variable cada uno
  function actualizarDatos() {
  id= $('#id_fun').val() ;
  documento= $('#documento_fun').val();
  tipoDoc= $('#tipoDoc_fun').val();
  nombre= $('#nombre_fun').val();
  apellido= $('#apellido_fun').val();
  correo= $('#correoSena_fun').val();
  celular= $('#celular_fun').val();
  titulo= $('#cargo_fun').val();
  sangre= $('#tipoSangre_fun').val();
  eps= $('#eps_fun').val();
  genero= $('#genero_fun').val();
  
  //En una cadena se pone cada uno de estos valores y sus variables
  cadena= "id_fun="+ id +
          "&documento_fun="+ documento +
          "&tipoDoc_fun="+ tipoDoc +
          "&nombre_fun="+ nombre +
          "&apellido_fun="+ apellido +
          "&correoSena_fun=" + correo +
          "&celular_fun=" + celular +
          "&cargo_fun=" + titulo +
          "&tipoSangre_fun=" + sangre +
          "&eps_fun=" + eps +
          "&genero_fun=" + genero;
//Se llama a la funcion ajax de jquery
  $.ajax({
      //Se establece el metodo POST
    type: "POST",
    //se conecta con el archivo actualizarUsuario en la carpeta php
    url: "php/actualizarUsuariofun.php",
    //y se asignan los valores de la cadena
    data: cadena,
    //el parametro r sera la que reciba todos estos datos
    success: function(r){
      //si r no esta vacia entonces se guardan los datos en la BD
     if (r!=null){
      $('#usuario').load('funcionario.php');
       alertify.success("Actualizado con exito");
      }else{
          //de lo contrario nos arroja que no fue actualizado
       alertify.error('No fue actualizado');
  
      }
      //al hacer esto se recarga la pagina
      location.reload();
    }
  });
  
  }
  
  function preguntarSiNo(id) {
    alertify.confirm('<h4>Eliminar usuario</h4>', '<span>¿Esta seguro de eliminar este usuario?</span>',
                     function(){ eliminarusuario(id) }
                  , function(){ alertify.error('Se cancelo')});
  
  }
  //Se crea la funcion eliminarusuarios la cual recibe el id del registro seleccionado
  function eliminarusuario(id) {
    cadena="id="+id;
  //se llama a la funcion ajax de Jquery
    $.ajax({
        //se nombra el metodo POST
      type: "POST",
      //Se referencia el archivo eliminarUsuarioFun
      url: "php/eliminarUsuarioFun.php",
      //Se traen todos los datos almacenados en cadena
      data: cadena,
      // el parametro r recibe los datos
      success: function(r){
        //si r no esta vacio entonces hace la actualizacion en la BD y recarga la pantalla
       if (r!=null){
        $('#usuario').load('funcionario.php');
        
         alertify.success("Eliminado con exito");
        }else{
            //de lo contrario no es arrojara que no pudo ser eliminado
         alertify.error('No fue eliminado');
    
        }
        //al hacer esto se recarga la pagina
        location.reload();
      }
    });
  
  }