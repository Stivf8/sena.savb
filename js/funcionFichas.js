/*SH: Funcion crear ficha, se le pasan todos los parametros del archivo crearFicha.php se valida si existe ficha */
function crear_ficha(NumeroFicha,etapaFormacion,jornada,nombrePrograma,trimestre) {
    
    if (NumeroFicha.length==0) {
    return Swal.fire('Todos los campos deben de estar diligenciados*', 'Por favor ingresa el numero de ficha', 'warning');
    }
    var formData= new FormData();
    formData.append('NumeroFicha',NumeroFicha);
    formData.append('etapaFormacion',etapaFormacion);
    formData.append('jornada',jornada);
    formData.append('nombrePrograma',nombrePrograma);
    formData.append('trimestre',trimestre);
    

    $.ajax({

        type:'POST',
        url:"php/crearFicha.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

            if (e!="") {
                Swal.fire('Registro exitoso!!','', 'success').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });  
               
              }else if (e==null) {
                Swal.fire('No se registro', '', 'error');
              } else {
                Swal.fire('La ficha ya exite', 'Ingrese otro número de ficha', 'warning');
              }
               

        }
    });

    
}
/*SH: Funcion consulta ficha, se le pasan todos los parametros de numero de ficha,
en el archivo consultarFicha.php*/
function consulta_ficha(consultaFicha) {
    
    if (consultaFicha.length==0) {
    return Swal.fire('Ingresa la Ficha', 'Por favor ingresa numero de ficha*', 'warning');
    }
    var formData= new FormData();
    formData.append('consultaFicha',consultaFicha);    

    $.ajax({

        type:'POST',
        url:"php/consultarFicha.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){


            d=e.split('||');
            resultado =d[6];
            if (resultado=='ok') {
                
                d=e.split('||');
                id_fic =$('#id_fic').val(d[0]);
                num_fic =$('#numero_ficha').val(d[1]) ;
                etapaFormacion =$('#etapa_formacion').val(d[2]);
                jornada =$('#jornada_fic').val(d[3]);
                nombrePrograma =$('#nombre_programa').val(d[4]);
                trimestre =$('#trimestre_fic').val(d[5]);
                

              } else {
                Swal.fire('No existe esa ficha', 'Ingrese otro número de ficha por favor', 'warning');
                //igualmente enviamos los datos pero vacios para que el formulario este ok
                d=e.split('||');
                id_fic =$('#id_fic').val(d[0]);
                num_fic =$('#numero_ficha').val(d[1]) ;
                etapaFormacion =$('#etapa_formacion').val(d[2]);
                jornada =$('#jornada_fic').val(d[3]);
                nombrePrograma =$('#nombre_programa').val(d[4]);
                trimestre =$('#trimestre_fic').val(d[5]);
              }
               

        }
    });

    
}
//funcion actualizar ficha
function mostrar_ficha_modal(NumeroFicha_m) {

    if (NumeroFicha_m.length==0) {
    return Swal.fire('Consulta una ficha', 'Por favor consulta primero la ficha a actualizar', 'warning').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }

                });  ;
    }
    var formData= new FormData();
    formData.append('consultaFicha',NumeroFicha_m);

    $.ajax({

        type:'POST',
        url:"php/consultarFicha.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

        d=e.split('||');
                id_fic =$('#id_fic_m').val(d[0]);
                num_fic =$('#numero_ficha_m').val(d[1]) ;
                etapaFormacion =$('#etapa_formacion_m').val(d[2]);
                jornada =$('#jornada_fic_m').val(d[3]);
                nombrePrograma =$('#nombre_programa_m').val(d[4]);
                trimestre =$('#trimestre_fic_m').val(d[5]);

        }

});
}
function actualizar_ficha(NumeroFicha_m,etapaFormacion_m,jornada_m,nombrePrograma_m,trimestre_m) {


    var formData= new FormData();
    formData.append('NumeroFicha_m',NumeroFicha_m);
    formData.append('etapaFormacion_m',etapaFormacion_m);
    formData.append('jornada_m',jornada_m);
    formData.append('nombrePrograma_m',nombrePrograma_m);
    formData.append('trimestre_m',trimestre_m);

    $.ajax({

        type:'POST',
        url:"php/actualizarFicha.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

        if (e!="") {
                Swal.fire('Actualización exitoso!!','', 'success').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }

                });  
               
        }else if(e=="") {
                Swal.fire('Ups! Algo ha ocurrido, intentalo de nuevo', 'valida la información', 'error');

                                }
                        }   
});
}

function preguntarSiNo(id_fic) {
  Swal.fire({
    title: '¿Esta seguro de eliminar esta ficha?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_ficha(id_fic);
    }
  });
  /*alertify.confirm('<h4>Eliminar noticia</h4>', '<span>¿Esta seguro de eliminar esta noticia?</span>',
                   function(){ eliminarnoticia(id) }
                , function(){ alertify.error('Se cancelo')});*/

}

function eliminar_ficha(id_fic) {

    var formData= new FormData();
    formData.append('id_fic',id_fic);

    $.ajax({

        type:'POST',
        url:"php/eliminarFicha.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

        if (e!=""){  
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