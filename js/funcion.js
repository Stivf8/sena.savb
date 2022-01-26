window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-23581568-13');


function agregarNoticia(titulo,contenido, imagen) {
  if (titulo.length==0 || contenido.length==0) {
    return Swal.fire('Todos los campos no pueden estar vacios', '', 'warning');
  }
  
   var formData= new FormData();
   var foto = $("#seleciona")[0].files[0];
   formData.append('titulo',titulo);
   formData.append('contenido',contenido);
   formData.append('imagen',foto);

  $.ajax({
      type: 'POST',
      url: 'php/agregarNoticia.php',
      data: formData,
      contentType:false,
      processData: false,
      success:function(r) {
          
        if (r!=null) {
          Swal.fire('Registro exitoso!!','', 'success').then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });  
         
        }else{
          Swal.fire('No se registro', '', 'error');
        }
      
      } 
  });
}


//Aqui nos muestra los datos actualizar
function agregar(datos) {
  d=datos.split('||');
id =$('#idnoticia').val(d[0]) ;
titulo= $('#titulou').val(d[1]);
contenido=  $('#contenidou').val(d[2]);      
}

//Aqui actualizamos los datos de la noticia
function actualizarDatos() {
  var formData= new FormData();
  var fotou = $("#imagenu")[0].files[0];
  var id =$('#idnoticia').val() ;
  var titulo= $('#titulou').val();
  var contenido=  $('#contenidou').val();

  formData.append('id',id);
  formData.append('titulo',titulo);
  formData.append('contenido',contenido);
  formData.append('imagen',fotou);

$.ajax({
  type: "POST",
  url: "php/actualizarNoticia.php",
  data: formData,
  contentType:false,
  processData: false,
  success: function(r){

   if (r!=null){
      Swal.fire('Actualizacion exitosa!!','', 'success').then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });  
   }else{
     Swal.fire('No se actualizó', '', 'error');
    }
  }
});

}

function preguntarSiNo(id) {
  Swal.fire({
    title: '¿Esta seguro de eliminar esta noticia?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminarnoticia(id);
    }
  });
  /*alertify.confirm('<h4>Eliminar noticia</h4>', '<span>¿Esta seguro de eliminar esta noticia?</span>',
                   function(){ eliminarnoticia(id) }
                , function(){ alertify.error('Se cancelo')});*/

}

function eliminarnoticia(id) {
  cadena="id="+id;

  $.ajax({
    type: "POST",
    url: "php/eliminarNoticia.php",
    data: cadena,
    success: function(r){
      
     if (r!=null){  
      Swal.fire('Eliminación exitosa!!','', 'success').then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });  
       
      }else{
        Swal.fire('No se eliminó', '', 'error');
  
      }

    }
  });

}

function EnviarCorreo(titulo,contenido, imagen) {
  var formData= new FormData();
  var foto = $("#seleciona")[0].files[0];
  formData.append('titulo',titulo);
  formData.append('contenido',contenido);
  formData.append('imagen',foto);
  alert(nombre+" ingreso con el correo: "+ email+ " Y envio este mensaje: " + contenido)
  $.ajax({
    type:'POST',
    url:'../php/enviarCorreo.php',
    data: formData,
    contentType:false,
    processData: false,
    success: function(r){
      if (r!=null) {
        console.log("Enviado");
      }

     }
  });
}