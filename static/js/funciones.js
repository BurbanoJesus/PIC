    /**
 * Ajuste decimal de un número.
 *
 * @param {String}  tipo  El tipo de ajuste.
 * @param {Number}  valor El numero.
 * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
 * @returns {Number} El valor ajustado.
 */
function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}
// Decimal round
if (!Math.round10) {
    Math.round10 = function(value, exp) {
        return decimalAdjust('round', value, exp);
    };
}
// Decimal floor
if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
        return decimalAdjust('floor', value, exp);
    };
}
// Decimal ceil
if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
        return decimalAdjust('ceil', value, exp);
    };
}

// 
// FUNCIONES PARA LA VISTA INICIO
// 
//almacenar slider en una variable



function type_multimedia(url){
    url = url.split('/');
    nombre = url.pop();
    nombre = nombre.split('.');
    extension = nombre.pop();
    extension = extension.trim();
    extension = extension.toLowerCase();
    // echo extension;
    if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
        type = 'imagen';
    } else {
        type = 'video';
    }
    return type;
}


// FECHAS
    var months = new Array('Enero','Febrero','Marzo','Abril','Mayo',
    'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var month_b = date.getMonth() + 1;
    var yy = date.getFullYear();
    var hour = date.getHours();
    var min = date.getMinutes();
    var seconds = date.getSeconds();
    var options = {hour: 'numeric', minute: 'numeric', hour12: true };
    var hous_mod = date.toLocaleString('es-CO', options);
    var month_mod = months[month];
    
    var hora_i = format_input_time(hour,min);
    var fecha_i = format_input_date(day,month_b,yy);
    // $("#fecha_a").val(fecha_i);
    $("input[name='fecha']").val(fecha_i+' '+hora_i);

    var fecha_ult_act = to_fecha_str(fecha_i);
    $("span.ult_act").html(fecha_ult_act);

    function format_input_date(day,month,yy){
        month = (month < 10 ? "0" : "") + month;
        day = (day < 10 ? "0" : "") + day;
        return yy+'-'+month+'-'+day;
    }

    function format_input_time(hour,min,seconds = '00'){
        hour = (hour < 10 ? "0" : "") + hour;
        min = (min < 10 ? "0" : "") + min;
        return hour+':'+min+':'+seconds;
    }

    function to_fecha_str(fecha){
        fecha = fecha.substring(0,10);
        fecha = fecha.split('-');
        yy = fecha[0];
        month = fecha[1];
        day = parseInt(fecha[2]);
        fecha = day+' de '+months[month-1]+' de '+yy;
        return fecha;
    }


// Funcion Informacion de menu de opciones de celda acciones de una tabla
$('a.acciones i').hover(function() {
        var width_window = $(window).innerWidth();
        var width_element = $(this).outerWidth();
        var width_info = $(this).parent().find('span.icon_info').outerWidth();
        var contenedor = $(this).parent();
        var left = contenedor.offset().left;
        var right = width_window - width_element - left;
        // console.log(right);
        // console.log(width_info);
        if (right <= 50) {
            contenedor.find('span.icon_info').css({
                // "margin-left": "-"+50+"px",
                "right":"0",
                "transform": "unset",
                "left": "unset",
            });
            contenedor.find('span.icon_info').show();
        } else {
            contenedor.find('span.icon_info').show();
        }
    }, function(e) {
        $(this).parent().find('span.icon_info').hide();
        setTimeout(function(){ $('form table div_acciones a.acciones').find('span.icon_info').finish();}, 400);
    });



//RESPONSIVE
$(document).on("click",".responsive_menu", function(e){
    $("div.menu").toggle();
});

$(document).on("click",".r_filtros", function(e){
   $("div.filtros").toggle();
});

//
//
//

$(window).on("load", function() {

    // $('i.icon-filled-lupa[type=submit],a[type=submit],button[type=submit]').attr('disabled',false);
    //


    

    


    // 

     // OCULTAR LOS OBJETOS AL HACER CLICK AFUERA DE ELLOS

    $(document).on('mousedown', function(e) 
    {
        var select = $(".select, .select .head_select,.select i,.select span");
        var menu_elemento = $(".menu_elemento");
        var select_op = $(".select .opciones");
        target = $(e.target);
        // console.log(select.is(target));
        // console.log(select.has(target).length);
        // console.log(target[0]);

        // if the target of the click isn't the container nor a descendant of the container
        if (!select.is(target) && select.has(target).length === 0){
            console.log(target);
            select_op.hide().removeClass('slider_down');
        }

        if (!menu_elemento.is(target.closest('.menu_elemento'))){
            console.log(target);
            menu_elemento.find('.me_opciones').removeClass('me_open').hide();
        }
      
    });
    // 


   

    //TEXTAREA
    function setTextareaHeight(textareas) {
        textareas.each(function () {
            var textarea = $(this);
            var extraHeight = 0;
            extraHeight = parseInt(textarea.css('padding-top')) + parseInt(textarea.css('padding-bottom')), // to set total height - padding size
                h = textarea[0].scrollHeight - extraHeight;
     
            if ( !textarea.hasClass('autoHeightDone') ) {
                textarea.addClass('autoHeightDone');
                // init height
                textarea.height('auto').height(h);

                textarea.bind('keyup', function() {
                    textarea.removeAttr('style'); // no funciona el height auto
                    h = textarea.get(0).scrollHeight - extraHeight;
                    textarea.height(h+'px'); // set new height
                });
            }else{
                console.log('po');
                textarea.height('auto').height(h);
                textarea.removeAttr('style'); // no funciona el height auto
                h = textarea.get(0).scrollHeight - extraHeight;
                textarea.height(h+'px');
            }
        })
    }
    setTextareaHeight($('textarea'));
    //



    // REGISTRAR MULTIMEDIA
    // INPUT FILE NO SE LE PUEDE HACER SET POR SEGURIDAD, PARA LEERLO Y MODIFICARLO ES NECESARIO GUARDARLO EN ARRAY INDEPENDIENTE,LUEGO ESTE ARRAY SE PUEDE ENVIAR A ARCHIVOS PHP.
    var filecollection = new Array();
    $(document).on('change','.input_preview', function(e){
        var elemento = $(this);
        var files = e.target.files;
        var agregar_mult = $('#loading_inf_1');
        $.each(files, function(i,file){
           
            filecollection.push(file);
           
            var reader = new FileReader();

            var type = file.type.split("/");
            type = type[0];
            var name = file.name;

            console.log(file);

            $('#loading_inf_1').css({'display':'inline-flex'});

            if (type == 'image') {
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var template ='<div class="div_img"><img id="img_1" class="img_pdf" src="'+e.target.result+'" alt="" /><i class="icon-filled-no-check quitar_img"></i></div>';
                    agregar_mult.before(template);
                    if (elemento.hasClass('input_jcrop')){
                        cargar_jcrop();
                    }
                }
            }else{
                var template ='<div class="div_img"><div class="video_preview"><div class="play_logo"></div><p class="video_name">Video: '+name+'</p></div><i class="icon-filled-no-check quitar_img"></i></div>';
                    agregar_mult.before(template);
                    console.log(agregar_mult);
            }
            
            $('#loading_inf_1').css({'display':'none'});

            // reader.onprogress = function(e) {
            //     // if(e.lengthComputable) {
            //     //     var percentLoaded = Math.round( (
            //     //     e.loaded * 100) / e.total );
            //     // }
            //     // // console.log("total: " + progressEvent.total + ", loaded: "
            //     // //   + progressEvent.loaded + "(" + percentLoaded + "%)");
            //     // console.log('1');
            // }
       });
    });

    $(document).on('click','.div_img .quitar_img', function(e){
        var index = $(".div_img .quitar_img").index($(this));
        var input = $(this).closest('.contenido_img').find('input');
        console.log(input);
        if (input.hasClass('input_file_one')){
            input.closest('.agregar_mult').show();
            input.val('');
        }
        $('.agregar_mult input.input_mult').eq(index).remove();
        $(this).closest('.div_img').remove();
    });

    // 
    var cont_input_mult = 2;
    $(document).on("change", ".input_mult", function(event){
        // console.log('this');
        var template = '<input class="input_mult input_preview" id="input_file_'+cont_input_mult+'" name="images[]" type="file" multiple /><label class="label_icon icon-filled-add-multimedia" for="input_file_'+cont_input_mult+'"></label><div class="div_button"><label class="button" for="input_file_'+cont_input_mult+'">Agregar</label></div>';
        $(this).parent().children().hide();
        $('.agregar_mult').append(template);
        cont_input_mult++;
    });


    $(document).on("change", ".input_file_one", function(event){
        $(this).parent().hide();
    });



    $(document).on("change","form input[name='fecha_nac']", function(e){
        var fecha_nac = $(this).val();
        // var fecha_nac = "2020-04-27 00:00:00";
        // var fecha_actual = "2020-12-20 04:32:00";
        var edad = dif_fecha(fecha_nac,fecha_i+' '+hora_i);
        $("input[name='edad']").val(edad['años']);
        console.log(edad);
    });
    // 
    function sleep(ms) {
        var start = Date.now(),
            now = start;
        while (now - start < ms) {
          now = Date.now();
        }
    }
    // 
    // $("form").keypress(function(e) {
    //     if (e.which == 13) {
    //         return false;
    //     }
    // });
    // 

     

    // VALIDAR
    // $(document).on("submit","form#registrar_producto", function(e){
    //     var flag_validar = true;
    //     flag_validar = validar_select();
    //     flag_validar = validar_texto(flag_validar);
    //     // 
    //     if (flag_validar == false) {
    //         console.log('this falso');
    //         return false;
    //     }
    //     // e.preventDefault();
    // });

    // $(document).on("submit","form#registrar_usuario", function(e){
    //     var flag_validar = true;
    //     flag_validar = validar_texto(flag_validar);
    //     flag_validar = validar_nombres(flag_validar);
    //     flag_validar = validar_correo(flag_validar);
    //     flag_validar = validar_usuario(flag_validar);
    //     flag_validar = validar_pass_iguales(flag_validar);
    //     // 
    //     if (flag_validar == false) {
    //         console.log('this falso');
    //         return false;
    //     }
    //     // e.preventDefault();
    // });
    // $(document).on("submit","form#registrar_juego_vf", function(e){
    //     var flag_validar = true;
    //     flag_validar = validar_select();
    //     flag_validar = validar_texto(flag_validar);
    //     // 
    //     if (flag_validar == false) {
    //         console.log('this falso');
    //         return false;
    //     }
    //     // e.preventDefault();
    // });
    // //
    // const reg_ip = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    // const reg_tag_html = /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/;
    // const reg_url = /^(http|https|ftp)+\:+\/\/+(www\.|)+[a-z0-9\-\.]+([a-z\.]|)+\.[a-z]{2,4}$/;
    // const reg_correo = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    // const reg_nombres = /^[a-zA-Z ]{5,80}$/;
    // const reg_user = /^[a-zA-Z0-9\_\-]{3,16}$/;
    // const reg_pass = /^[a-zA-Z0-9\-\.\_\@]{4,18}$/;
    // const reg_numeros = /^[0-9]{7,10}$/;
    // const reg_decimales = /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/;
    // // 

    // function validar_texto(flag_validar){
    //     var array_texto = [];
    //     $("input.input_text, textarea.input_text").each(function(index,value){
    //         var elemento = $(this);
    //         var input = elemento.closest('div.input');
    //         if (elemento.val().length <= 4) {
    //             elemento.css({'border-color':'#D93025'});
    //             array_texto.push(false);
    //             msj_error = input.find('span.input_msj_error');
    //             if (msj_error.length == 0){
    //                 input.append('<span class="input_msj_error">Minimo de caracteres: 4, Usa solo letras</span>');
    //             }
    //         }else{
    //             elemento.css({'border-color':'var(--gris)'});
    //             array_texto.push(true);
    //             input.find('span.input_msj_error').remove();
    //         }
    //     });
    //     array_texto.forEach(function(value,index){
    //         if (value == false) {
    //             flag_validar = false;
    //         }
    //     });
    //     return flag_validar;
    // }

    // function validar_nombres(flag_validar){
    //     var array_nombres = [];
    //     $("input.input_nombres").each(function(index,value){
    //         var elemento = $(this);
    //         var input = elemento.closest('div.input');
    //         var str_elemento = elemento.val();
    //         str_elemento = str_elemento.trim();
    //         if (!reg_nombres.test(str_elemento)){
    //             elemento.css({'border-color':'#D93025'});
    //             array_nombres.push(false);
    //             msj_error = input.find('span.input_msj_error');
    //             if (msj_error.length == 0){
    //                 input.append('<span class="input_msj_error">No se admiten numeros ni caracteres especiales, Minimo de caracteres: 5.</span>');
    //             }
    //         }else{
    //             elemento.css({'border-color':'var(--gris)'});
    //             array_nombres.push(true);
    //             input.find('span.input_msj_error').remove();
    //         }
    //     });
    //     array_nombres.forEach(function(value,index){
    //         if (value == false) {
    //             flag_validar = false;
    //         }
    //     });
    //     return flag_validar;
    // }

    // function validar_usuario(flag_validar){
    //     var array_usuario = [];
    //     $("input.input_usuario").each(function(index,value){
    //         var elemento = $(this);
    //         var input = elemento.closest('div.input');
    //         var str_elemento = elemento.val();
    //         str_elemento = str_elemento.trim();
    //         if (!reg_user.test(str_elemento)) {
    //             elemento.css({'border-color':'#D93025'});
    //             array_usuario.push(false);
    //             msj_error = input.find('span.input_msj_error');
    //             if (msj_error.length == 0){
    //                 input.append('<span class="input_msj_error">Minimo de caracteres: 5. Usa solo letra, numeros o los signos: _-.</span>');
    //             }
    //         }else{
    //             elemento.css({'border-color':'var(--gris)'});
    //             array_usuario.push(true);
    //             input.find('span.input_msj_error').remove();
    //         }
    //     });
    //     array_usuario.forEach(function(value,index){
    //         if (value == false) {
    //             flag_validar = false;
    //         }
    //     });
    //     return flag_validar;
    // }

    // function validar_correo(flag_validar){
    //     var array_correo = [];
    //     $("input.input_correo").each(function(index,value){
    //         var elemento = $(this);
    //         var input = elemento.closest('div.input');
    //         var str_elemento = elemento.val();
    //         str_elemento = str_elemento.trim();
    //         if (!reg_correo.test(str_elemento)) {
    //             elemento.css({'border-color':'#D93025'});
    //             array_correo.push(false);
    //             msj_error = input.find('span.input_msj_error');
    //             if (msj_error.length == 0){
    //                 input.append('<span class="input_msj_error">Correo no valido, Ejemplo de correo: example@mail.com</span>');
    //             }
    //         }else{
    //             elemento.css({'border-color':'var(--gris)'});
    //             array_correo.push(true);
    //             input.find('span.input_msj_error').remove();
    //         }
    //     });
    //     array_correo.forEach(function(value,index){
    //         if (value == false) {
    //             flag_validar = false;
    //         }
    //     });
    //     return flag_validar;
    // }

    // function validar_pass_iguales(flag_validarflag_validar){
    //     var elemento_1 = $("input.pass_equal").eq(0);
    //     var elemento_2 = $("input.pass_equal").eq(1);
    //     var str_elemento_1 = elemento_1.val();
    //     var str_elemento_2 = elemento_2.val();
    //     var input = elemento_1.closest('div.input');
    //     // console.log(str_elemento_1);
    //     // console.log(str_elemento_2);
    //     if (str_elemento_1.length < 5 || !reg_pass.test(str_elemento_1)) {
    //         flag_validar = false;
    //         elemento_1.css({'border-color':'#D93025'});
    //         elemento_2.css({'border-color':'#D93025'});
    //         msj_error = input.find('span.input_msj_error');
    //         if (msj_error.length == 0){
    //             input.append('<span class="input_msj_error">Minimo de caracteres: 6. Usa solo letras, numeros o signos de puntuacion comunes</span>');
    //         }
    //     }else if (str_elemento_1 != str_elemento_2) {
    //         flag_validar = false;
    //         elemento_1.css({'border-color':'#D93025'});
    //         elemento_2.css({'border-color':'#D93025'});
    //         msj_error = input.find('span.input_msj_error');
    //         if (msj_error.length == 0){
    //             input.append('<span class="input_msj_error">Las contraseñas no coinciden</span>');
    //         }else{
    //             msj_error.html('Las contraseñas no coinciden');
    //         }
    //     }else{
    //         elemento_1.css({'border-color':'var(--gris)'});
    //         elemento_2.css({'border-color':'var(--gris)'});
    //         flag_validar = true;
    //         input.find('span.input_msj_error').remove();
    //     }
    //     return flag_validar;
    // }

    // validar_pass_iguales();


    // 
// Fin window onload
});