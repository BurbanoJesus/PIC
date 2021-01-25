// MENU ELEMENTO

$(document).on("click",".menu_elemento", function(e){
    e.stopPropagation();
    var menu = $(this);
    var me_opciones = menu.find('.me_opciones');
    var flag_open = true;
    // SABER SI TIENE LA CLASE OPEN
    if (me_opciones.hasClass('me_open')){
        flag_open = true;
    }else{
        flag_open = false;
    }
    //OCULTAR LOS DEMAS MENUS 
    $('.me_opciones').hide();
    $('.me_opciones').removeClass('me_open');
    
    //AGREGAR LA CLASE OPEN DEL ELEMENTO ACTUAL SI ES NECESARIO 
    if (flag_open){
        me_opciones.addClass('me_open');
    }
    //COMPROBAR
    if (me_opciones.hasClass('me_open')){
        me_opciones.hide();
        me_opciones.removeClass('me_open');
    }else{
        me_opciones.show();
        me_opciones.addClass('me_open');
    }
});
//
$(document).on("click",".me_opciones", function(e){
    e.stopPropagation();
});

// 

$(document).on("click",".me_eliminar", function(e){
    e.stopPropagation();
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    var url_data = $(this).closest('.parent_me_elemento').attr('url_data');
    var elemento = $(this).closest('.parent_me_elemento').prop('id');
    var modelo = $(this).closest('.parent_me_elemento').attr('model');
    var slider = $(this).closest('.parent_me_elemento').attr('slider');
    modelo = (modelo === undefined) ? '' : modelo;
    slider = (slider === undefined) ? '' : slider;
    console.log('str_inicio');
    console.log(slider);
    console.log(id);
    console.log(modelo);
    var template_modal = '<div id="modal_eliminar" class="modal modal_eliminar">'+
            '<div class="modal_main" style="width: 500px; height: 200px;">'+
                '<div class="close"><i class="icon-cancelar-b"></i></div>'+
                '<div class="modal_content modal_confirmar">'+
                    '<div>'+
                        '<span class="sp_confirmar"> ¿Esta seguro de eliminar el registro? </span>'+
                    '</div>'+
                    '<div class="content_button">'+
                        '<button class="button acept me_confirmar_eliminar" type="button"'+ 
                        'id_data="'+id+'" el_data="'+elemento+'" url_data="'+url_data+'" model="'+modelo+'" slider="'+slider+'">Si</button>'+
                        '<button class="button acept bg_cancel" type="button">Cancelar</button>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';
    $("#div_mod_eliminar").html(template_modal);
    call_modal('modal_eliminar');
});

$(document).on("click",".me_confirmar_eliminar", function(e){
    e.stopPropagation();
    console.log(slider);
    var id = $(this).attr('id_data');
    var id_elemento = $(this).attr('el_data');
    var url_data = $(this).attr('url_data');
    var modelo = $(this).attr('model');
    var elemento = $('#'+id_elemento);
    var slider = $(this).attr('slider');
    console.log(elemento);
    $.ajax({
        url: '/plataforma/core/controllers/'+url_data+'.php',
        method: 'POST',
        data: {id : id},
        // dataType:  "json",
        beforeSend: function() {
            // $("#divres").html("<img src='images/ajax-loader.gif'>");
        },
        success: function(datos){
            console.log(datos);
            datos = JSON.parse(datos);
            if (datos.error === false){
                elemento.remove();
                if (slider == 'slider') {
                    console.log('sucpp+++');
                    sliderLength();
                }
            }else{
                var template = '<div class=""><div class="validate_msj ajax">Ha ocurrido un error</div></div>';
                $('.contenido').append(template);
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

$(document).on("click","form#form_lista_articulos .parent_me_elemento", function(e){
    var id = $(this).attr('id_data');
    window.location = '/plataforma/detalles_producto?id='+id;    
});
//
$(document).on("click","form#form_lista_articulos .me_editar", function(e){
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/editar_producto?id='+id;
});

$(document).on("click","div.header .me_ver_perfil", function(e){
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/perfil';
});

$(document).on("click","div.header .me_cerrar_sesion", function(e){
    console.log('perfil');
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/logout';
});
// 
$(document).on("click","div#cursos .me_editar", function(e){
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/editar_curso?id='+id;
});

// 
$(document).on("click","div#modulos .me_editar", function(e){
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/editar_modulo?id='+id;
});
// 
$(document).on("click","div#detalles_perfil .me_editar", function(e){
    var id = $(this).closest('.parent_me_elemento').attr('id_data');
    window.location = '/plataforma/editar_usuario?id='+id;
});