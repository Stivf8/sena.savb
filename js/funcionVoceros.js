function crear_vocero(Ficha,TipoDeDocumento,NumeroDeDocumento,Nombres,Apellidos,CorreoPersonal,
    CorreoSena,Telefono,Celular1,Celular2,TipoDeSangre,EPS,Genero) {
    
    if ((NumeroDeDocumento.length==0)||(Ficha.length==0)) {
    return Swal.fire('Todos los campos deben de estar diligenciados*', 'Por favor verifica el numero de documento o ficha', 'warning');
    }
    var formData= new FormData();
    formData.append('Ficha',Ficha);
    formData.append('TipoDeDocumento',TipoDeDocumento);
    formData.append('NumeroDeDocumento',NumeroDeDocumento);
    formData.append('Nombres',Nombres);
    formData.append('Apellidos',Apellidos);
    formData.append('CorreoPersonal',CorreoPersonal);
    formData.append('CorreoSena',CorreoSena);
    formData.append('Telefono',Telefono);
    formData.append('Celular1',Celular1);
    formData.append('Celular2',Celular2);
    formData.append('TipoDeSangre',TipoDeSangre);
    formData.append('EPS',EPS);
    formData.append('Genero',Genero);
    

    $.ajax({

        type:'POST',
        url:"php/crearVocero.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

         if (e!="") {

            //CREA EL USUARIO DEL VOCER

            //CIERRA CREACION DEL USUARIO DEL VOCERO


                Swal.fire('Registro exitoso!!','', 'success').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });  
               
              }else if (e==null) {
                Swal.fire('No se registro', '', 'error');
              } else {
                Swal.fire('El vocero ya exite', 'Ingrese otro número de documento', 'warning');
              }

        }
    });

    
}
/*SH: Funcion consulta vocero, se le pasan todos los parametros de voceros,
en el archivo consultarVocero.php*/
function consulta_vocero(consultaVocero) {
    
    if (consultaVocero.length==0) {
    return Swal.fire('Ups! por favor ingresa el campo para realizar la consulta.', 'Por favor ingresa el numero de documento*', 'warning');
    }
    var formData= new FormData();
    formData.append('consultaVocero',consultaVocero);    

    $.ajax({

        type:'POST',
        url:"php/consultarVocero.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){


            d=e.split('||');
            resultado =d[0];
            if (resultado=='ok') {
                
                d=e.split('||');
                id_voc =$('#id_voc').val(d[1]);
                Ficha_id_fic =$('#Ficha_id_fic').val(d[2]) ;
                Usuario_id_usu =$('#Usuario_id_usu').val(d[3]);
                documento_voc =$('#documento_vocero').val(d[4]);
                tipoDoc_voc =$('#tipo_documento_vocero').val(d[5]);
                nombre_voc =$('#nombre_vocero').val(d[6]);
                apellido_voc =$('#apellidos_vocero').val(d[7]);
                correoPer_voc =$('#correo_personal_vocero').val(d[8]);
                correoSena_voc =$('#correo_sena_vocero').val(d[9]);
                telefono_voc =$('#telefono_vocero').val(d[10]);
                celular1_voc =$('#celular_1').val(d[11]);
                celular2_voc =$('#celular_2').val(d[12]);
                tipoDeSangre_voc =$('#tipo_sangre_vocero').val(d[13]);
                eps_voc =$('#eps_vocero').val(d[14]);
                genero_voc =$('#genero_vocero').val(d[15]);
                numero_fic_c =$('#numero_ficha').val(d[16]);
                status=$('#estado_v').val(d[17]);



              } else {
                Swal.fire('No existe ese vocero', 'Ingrese otro número de vocero por favor', 'warning');
                //igualmente enviamos los datos pero vacios para que el formulario este ok
                d=e.split('||');
                id_voc =$('#id_voc').val(d[1]);
                Ficha_id_fic =$('#Ficha_id_fic').val(d[2]) ;
                Usuario_id_usu =$('#Usuario_id_usu').val(d[3]);
                documento_voc =$('#documento_vocero').val(d[4]);
                tipoDoc_voc =$('#tipo_documento_vocero').val(d[5]);
                nombre_voc =$('#nombre_vocero').val(d[6]);
                apellido_voc =$('#apellidos_vocero').val(d[7]);
                correoPer_voc =$('#correo_personal_vocero').val(d[8]);
                correoSena_voc =$('#correo_sena_vocero').val(d[9]);
                telefono_voc =$('#telefono_vocero').val(d[10]);
                celular1_voc =$('#celular_1').val(d[11]);
                celular2_voc =$('#celular_2').val(d[12]);
                tipoDeSangre_voc =$('#tipo_sangre_vocero').val(d[13]);
                eps_voc =$('#eps_vocero').val(d[14]);
                genero_voc =$('#genero_vocero').val(d[15]);
                numero_fic_c =$('#numero_ficha').val(d[16]);
                status=$('#estado_v').val(d[17]);
              }
               

        }
    });

    
}
//funcion mostrar ficha
function mostrar_vocero_modal(NumeroDeDocumentoModal) {

    if (NumeroDeDocumentoModal.length==0) {
    return Swal.fire('Consulta una vocero', 'Por favor consulta primero el vocero a actualizar', 'warning').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }

                });  ;
    }
    var formData= new FormData();
    formData.append('consultaVocero',NumeroDeDocumentoModal);

    $.ajax({

        type:'POST',
        url:"php/consultarVocero.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

        d=e.split('||');
                id_voc =$('#id_voc_m').val(d[1]);
                Ficha_id_fic =$('#Ficha_id_fic_m').val(d[2]) ;
                Usuario_id_usu =$('#usuario_voc_m').val(d[3]);
                documento_voc =$('#numeroDocumento_m').val(d[4]);
                tipoDoc_voc =$('#tipo_documento_m').val(d[5]);
                nombre_voc =$('#nombres_m').val(d[6]);
                apellido_voc =$('#apellido_m').val(d[7]);
                correoPer_voc =$('#correo_personal_m').val(d[8]);
                correoSena_voc =$('#correo_sena_m').val(d[9]);
                telefono_voc =$('#telefono_m').val(d[10]);
                celular1_voc =$('#celular1_m').val(d[11]);
                celular2_voc =$('#celular2_m').val(d[12]);
                tipoDeSangre_voc =$('#tipoSangre_m').val(d[13]);
                eps_voc =$('#eps_m').val(d[14]);
                genero_voc =$('#genero_m').val(d[15]);
                numero_fic_c =$('#numero_ficha_m').val(d[16]);
                status=$('#estado_m').val(d[17]);
                


        }

});
}
//actualiza los datos de los voceros
function actualizar_vocero(id_voc,Ficha_id_fic,Usuario_id_usu,documento_voc,tipoDoc_voc,nombre_voc,apellido_voc,correoPer_voc,correoSena_voc,telefono_voc,celular1_voc,celular2_voc,tipoDeSangre_voc,eps_voc,genero_voc,numero_fic_c,estado_m) {


    var formData= new FormData();
    formData.append('id_voc',id_voc);
    formData.append('Ficha_id_fic',Ficha_id_fic);
    formData.append('Usuario_id_usu',Usuario_id_usu);
    formData.append('documento_voc',documento_voc);
    formData.append('tipoDoc_voc',tipoDoc_voc);
    formData.append('nombre_voc',nombre_voc);
    formData.append('apellido_voc',apellido_voc);
    formData.append('correoPer_voc',correoPer_voc);
    formData.append('correoSena_voc',correoSena_voc);
    formData.append('telefono_voc',telefono_voc);
    formData.append('celular1_voc',celular1_voc);
    formData.append('celular2_voc',celular2_voc);
    formData.append('tipoDeSangre_voc',tipoDeSangre_voc);
    formData.append('eps_voc',eps_voc);
    formData.append('genero_voc',genero_voc);
    formData.append('numero_fic_c',numero_fic_c);
    formData.append('estado_m',estado_m);

    $.ajax({

        type:'POST',
        url:"php/actualizarVocero.php",
        data:formData,
        contentType:false,
        processData:false,
        success: function(e){

        if (e!="") {
                Swal.fire('Actualización exitosa!!','', 'success').then((result) => {
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
function preguntarSiNo(Usuario_id_usu) {
  Swal.fire({
    title: '¿Esta seguro de eliminar este vocero?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_vocero(Usuario_id_usu);
    }
  });

}
function eliminar_vocero(Usuario_id_usu) {

    var formData= new FormData();
    formData.append('Usuario_id_usu',Usuario_id_usu);

    $.ajax({

        type:'POST',
        url:"php/eliminarVocero.php",
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