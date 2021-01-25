//Iniciar sesion
$(document).on('submit','#form_login',function(event){
  event.preventDefault();
  console.log('this');
  var form = $(this);
  var url = form.prop('action');

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'json',
    data: form.serialize(),
    beforeSend:function(){
      // $('.botonlg').val('Validando1');
    },
    success:function(respuesta){
        console.log(respuesta);
        if(respuesta.error === false){
            tipo_usuario = respuesta.tipo_usuario;
            switch(tipo_usuario){
                case 'administrador':
                    url = '/plataforma/panel';
                    window.location.href = url;
                    break;

                case 'supervisor':
                    url = '/plataforma/panel';
                    window.location.href = url;
                    break;

                case 'generador':
                    url = '/plataforma/estructura_principal';
                    window.location.href = url;
                    break;

                case 'general':
                    url = '/plataforma/inicio';
                    window.location.href = url;
                    break;
            }
        }
        else {
            $('.error_login').html('Hay un error en usuario o contraseña').fadeIn('normal');
        }
    },
    error:function(xhr, status, error){
      if (xhr.responseText.indexOf('<html>') != -1) {
        var str_inicio = xhr.responseText.indexOf('<p>');
        var str_final = xhr.responseText.indexOf('</p>');
        var str_error = xhr.responseText.substring(str_inicio+3,str_final);
        console.log(str_error);
      }else{
        console.log(xhr.responseText);
      }
    }
  });
});

