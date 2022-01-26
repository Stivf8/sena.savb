//Se crea la funcion agregar y esta trae los datos de la cadena $datos
function agregar(datos) {
    d=datos.split('||');
  $('#id_ins').val(d[0]) ;
   $('#documento_ins').val(d[1]);
   $('#tipoDoc_ins').val(d[2]);
    $('#nombre_ins').val(d[3]);
    $('#apellido_ins').val(d[4]);
    $('#correoSena_ins').val(d[5]);
    $('#celular_ins').val(d[6]);
    $('#titulo_ins').val(d[7]);
    $('#tipoSangre_ins').val(d[8]);
    $('#eps_ins').val(d[9]);
    $('#genero_ins').val(d[10]);       
  }
  //Se crea la funcion actualizarDatos y esta nombra los datos traidos en una variable cada uno
  function actualizarDatos() {
  id= $('#id_ins').val() ;
  documento= $('#documento_ins').val();
  tipoDoc= $('#tipoDoc_ins').val();
  nombre= $('#nombre_ins').val();
  apellido= $('#apellido_ins').val();
  correo= $('#correoSena_ins').val();
  celular= $('#celular_ins').val();
  titulo= $('#titulo_ins').val();
  sangre= $('#tipoSangre_ins').val();
  eps= $('#eps_ins').val();
  genero= $('#genero_ins').val();
  
  //En una cadena se pone cada uno de estos valores y sus variables
  cadena= "id_ins="+ id +
          "&documento_ins="+ documento +
          "&tipoDoc_ins="+ tipoDoc +
          "&nombre_ins="+ nombre +
          "&apellido_ins="+ apellido +
          "&correoSena_ins=" + correo +
          "&celular_ins=" + celular +
          "&titulo_ins=" + titulo +
          "&tipoSangre_ins=" + sangre +
          "&eps_ins=" + eps +
          "&genero_ins=" + genero;
//Se llama a la funcion ajax de jquery
  $.ajax({
    //Se establece el metodo POST
    type: "POST",
    //se conecta con el archivo actualizarUsuario en la carpeta php
    url: "php/actualizarUsuario.php",
    //y se asignan los valores de la cadena 
    data: cadena,
    //el parametro r sera la que reciba todos estos datos
    success: function(r){
      //si r no esta vacia entonces se guardan los datos en la BD
     if (r!=null){
      $('#usuario').load('consulta.php');
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
      //Se referencia el archivo eliminarUsuario 
      url: "php/eliminarUsuario.php",
      //Se traen todos los datos almacenados en cadena
      data: cadena,
      // el parametro r recibe los datos
      success: function(r){
        //si r no esta vacio entonces hace la actualizacion en la BD y recarga la pantalla
       if (r!=null){
        $('#usuario').load('consulta.php');
        
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