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
function name_url(url){
    url = url.split('/');
    nombre = url.pop();
    nombre = nombre.split('.');
    return nombre;
}

// 
function tipo_ext_url(url){
    url = url.split('/');
    nombre = url.pop();
    nombre = nombre.split('.');
    extension = nombre.pop();
    extension = extension.trim();
    extension = extension.toLowerCase();
    console.log(extension);
    switch (true){
        case (extension == 'jpg' || extension == 'png' || extension == 'gif'):
            str_type = 'image';
            break;

        case (extension == 'mp4'):
            str_type = 'image';
            break;

        case (extension == 'doc' || extension == 'docx'):
            str_type = 'word';
            break;
        case (extension == 'xls' || extension == 'xlsx'):
            str_type = 'excel';
            break;

        case (extension == 'ppt' || extension == 'pptx'):
            str_type = 'power';
            break;

        case extension == 'pdf':
            str_type = 'pdf';
            break;

        case (extension == 'rar' || extension == 'zip'):
            str_type = 'rar';
            break;

        case (extension == 'txt' || extension == 'html'):
            str_type = 'txt';
            break;

        case extension == 'text':
            str_type = 'text';
            break;

        default:
            str_type = 'otro';
            break;
    }

    return str_type;
}

// 
function tipo_icon_mult(extension){
    str_icon = '';
    switch (true) {
        case (extension == 'word' || extension == 'doc'):
            str_icon = '/plataforma/static/img/files/word.png';
            break;

        case extension == 'excel':
            str_icon = '/plataforma/static/img/files/excel.png';
            break;

        case extension == 'pdf':
            str_icon = '/plataforma/static/img/files/pdf.png';
            break;

        case extension == 'power':
            str_icon = '/plataforma/static/img/files/power_point.png';
            break;

        case extension == 'txt':
            str_icon = '/plataforma/static/img/files/txt.png';
            break;

        case extension == 'rar':
            str_icon = '/plataforma/static/img/files/rar.png';
            break;

        case extension == 'otro':
            str_icon = '/plataforma/static/img/files/file.png';
            break;
        
    }
    return str_icon;
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
//
function disableScrolling(){
    var x=window.scrollX;
    var y=window.scrollY;
    window.onscroll=function(){window.scrollTo(x, y);};
}

function enableScrolling(){
    window.onscroll=function(){};
}
// 
function sleep(ms) {
    var start = Date.now(),
        now = start;
    while (now - start < ms) {
      now = Date.now();
    }
}
// console.log('this');
//
// FUNCION NOTIFICACIONES
if ($(".contenido_panel").length > 0){
div_notificacion = $(".notificacion");
    sp_notificacion = $("#num_notificacion");
    numero_notificaciones_bd();
    notificaciones = setInterval(numero_notificaciones_bd, 5000);
    function numero_notificaciones_bd(){
        $.ajax({
            url: '/plataforma/core/controllers/c_notificaciones.php',
            beforeSend: function() {
                // $("#divres").html("<img src='images/ajax-loader.gif'>");
            },
            success: function(datos){
                // console.log(datos);
                datos = JSON.parse(datos);
                num = datos.total;
                if (sp_notificacion.length > 0 && num > 0 ){
                    div_notificacion.css({'display':'inline-flex'});
                    sp_notificacion.html(num);
                }else{
                    div_notificacion.css({'display':'none'});
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
    }
}
//
// FUNCION JCROP RESPONSIVE
if ($(".input_jcrop").length > 0){
    // Responsive
    if (width_window <= 500) {
        $("input[name='w_jcrop'").val('350');
    }
}
// 
//
if ($("form").prop("enctype") == 'multipart/form-data'){
    $(document).on("submit","form[enctype='multipart/form-data']", function(e){
        var elemento = $(this);
        var btn_submit = elemento.find("button[type='submit']");
        console.log(btn_submit.html().search('Procesando'));
        if (btn_submit.html().search('Procesando') != -1){
            btn_submit.html('<i class="icon-filled-check"></i>Registrar');
            btn_submit.removeClass('procesando');
            console.log('this');
            return false;
        }else{
            var template = '<svg class="btn_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" '+
                'style="margin: auto; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; shape-rendering: auto;"'+
                'viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">'+
                '<rect x="17.5" y="30" width="15" height="40" fill="#ffffff">'+
                  '<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>'+
                  '<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>'+
                '</rect>'+
                '<rect x="42.5" y="30" width="15" height="40" fill="#ffffff">'+
                  '<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>'+
                  '<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>'+
                '</rect>'+
                '<rect x="67.5" y="30" width="15" height="40" fill="#ffffff">'+
                  '<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>'+
                  '<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" '+
                  'values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>'+
                '</rect></svg>'+
                'Procesando';
            btn_submit.html(template);
            btn_submit.addClass('procesando');
        }
        // return false;
    });
}

    // window.onbeforeunload = function() {
    // };
    // console.log($("form[enctype='multipart/form-data']"));
// 
// FUNCION ACCIONES SUBINFORMACION HOVER
if ($(".acciones").length > 0){
    //Funcion Informacion de menu de opciones de celda acciones de una tabla
    $(document).on("mousedown mouseenter",".acciones i", function(e){
        var width_window = $(window).innerWidth();
        var width_element = $(this).outerWidth();
        var width_info = $(this).parent().find('span.icon_info').outerWidth();
        var contenedor = $(this).parent();
        var left = contenedor.offset().left;
        var right = width_window - width_element - left;
        console.log(right);
        // console.log(width_info);
        if (right <= (width_info / 2)) {
            contenedor.find('span.icon_info').css({
                "right":"0",
                "transform": "unset",
                "left": "unset",
            });
        }
        contenedor.find('span.icon_info').show();
    });

    $(document).on("mouseleave",".acciones i", function(e){
        $(this).parent().find('span.icon_info').hide();
        setTimeout(function(){ $('form table div_acciones a.acciones').find('span.icon_info').finish();}, 400);
    });
}
// 
// FUNCION ACCIONES SUB_INFORMACION HOVER
if ($(".input_preview").length > 0){
    $(document).on("mousedown mouseenter","div.contenido_img div.div_img", function(e){
        var validate = $(this).parent('div.contenido_img').hasClass('jcrop');
        if(validate === false){
            var contenedor = $(this);
            var width_window = $(window).innerWidth();
            var width_element = $(this).outerWidth();
            var width_info = $(this).find('div.sub_info').outerWidth();
            var left = contenedor.offset().left;
            var right = width_window - width_element - left;
            console.log(width_element);
            console.log(width_info);
            console.log(left);
            console.log(right);
            console.log(contenedor);
            contenedor.find('div.sub_info').css({"display": "flex"});
            if (right <= (width_info / 2)) {
                contenedor.find('div.sub_info').css({
                    // "display": "flex",
                    "right":"0",
                    "transform": "unset",
                    "left": "unset",
                });
            }
            if (left <= (width_info / 2)) {
                contenedor.find('div.sub_info').css({
                    // "display": "flex",
                    "left":"6px",
                    "transform": "unset",
                    "right": "unset",
                });
            }
            contenedor.find('div.sub_info').show();
        }
    });

    $(document).on("mouseleave","div.contenido_img div.div_img", function(e){
        var validate = $(this).parent('div.contenido_img').hasClass('jcrop');
        if(validate === false){
            $(this).find('div.sub_info').hide();
            setTimeout(function(){ $('div.contenido_img div.div_img').find('div.sub_info').finish();}, 400);
        }
    });
}
//
// FUNCION MATCHES MOUSEDOWN
if ($(".select").length > 0 || $(".menu_elemento").length > 0){
    $(document).on('mousedown', function(e) 
    {
        var select = $(".select, .select .head_select,.select i,.select span");
        var menu_elemento = $(".menu_elemento");
        var select_op = $(".select .opciones");
        target = $(e.target);
        // console.log(select.is(target));
        // console.log(select.has(target).length);
        // console.log(target[0]);

        // OCULTAR LOS OBJETOS AL HACER CLICK AFUERA DE ELLOS
        if (!select.is(target) && select.has(target).length === 0){
            // console.log(target);
            select_op.hide().removeClass('slider_down');
        }

        if (!menu_elemento.is(target.closest('.menu_elemento'))){
            // console.log(target);
            menu_elemento.find('.me_opciones').removeClass('me_open').hide();
        }
      
    });
}
//
// FUNCION TEXTAREA
if ($("textarea").length > 0){
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
}
//
// FUNCION FORM AGREGAR MULTIMEDIA
if ($(".input_preview").length > 0){
    // INPUT FILE NO SE LE PUEDE HACER SET POR SEGURIDAD, PARA LEERLO Y MODIFICARLO ES NECESARIO GUARDARLO EN ARRAY INDEPENDIENTE,LUEGO ESTE ARRAY SE PUEDE ENVIAR A ARCHIVOS PHP.
    var filecollection = new Array();
    $(document).on('change','.input_preview', function(e){
        var elemento = $(this);
        var files = e.target.files;
        var agregar_mult = $(this).closest('.contenido_img').find('.loading_inf');
        $.each(files, function(i,file){
           
            filecollection.push(file);
           
            var reader = new FileReader();

            var file_type = file.type.split("/");
            var type = file_type[0];
            var ext = file_type[1];
            var name = file.name;
            var arr_ext_name = name.split(".");
            var name_clear = arr_ext_name[arr_ext_name.length - 2];
            var ext_name = arr_ext_name[arr_ext_name.length - 1];

            if (elemento.hasClass('subir_archivo')) {
                $(".in_subir_archivo").val(name_clear);
            }

            $('.loading_inf').css({'display':'inline-flex'});
                // console.log(file);
            if (type == 'image') {
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var template ='<div class="div_img"><img id="img_1" class="file" src="'+e.target.result+'" alt="" /><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                    if (elemento.hasClass('input_jcrop')){
                        cargar_jcrop();
                    }
                }
            }
            else if (type == 'video'){
                var template ='<div class="div_img"><div class="video_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/video_b.png" alt="" />'+
                '<p class="video_name">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                agregar_mult.before(template);
            }
            else if (type == 'audio'){
                var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/audio.png" alt="" />'+
                '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                agregar_mult.before(template);
            }
            else if (type == 'text'){
                if (ext == 'plain'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/txt.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }else{
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/file.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
            }
            else if (type == 'application'){
                if (ext == 'msword' || ext == 'vnd.openxmlformats-officedocument.wordprocessingml.document'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/word.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
                else if (ext == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/excel.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                    console.log('excel');
                }
                else if (ext == 'vnd.openxmlformats-officedocument.presentationml.presentation'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/power_point.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
                else if (ext == 'pdf'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/pdf.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
                else{
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/file.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                    console.log('else');
                }
            }
            else{
                if (ext_name == 'rar'){
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/rar.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
                else{
                    var template ='<div class="div_img"><div class="file_preview"><img id="img_1" class="img_file" src="/plataforma/static/img/files/file.png" alt="" />'+
                    '<p class="file_name" aria-label="'+name+'">'+name+'</p></div><i class="icon-filled-no-check quitar_img"></i>'+
                '<div class="sub_info">'+name+'</div></div>';
                    agregar_mult.before(template);
                }
            }

            $('.loading_inf').css({'display':'none'});

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
    // 
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
        console.log('this');
        var name = $(this).prop('name');
        var template = '<input class="input_mult input_preview" id="input_file_'+cont_input_mult+'" name="'+name+'" type="file" multiple />'+
        '<label class="label_icon icon-filled-add-multimedia" for="input_file_'+cont_input_mult+'"></label><div class="div_button">'+
        '<label class="button" for="input_file_'+cont_input_mult+'">Agregar</label></div>';
        $(this).parent().children().hide();
        $('.agregar_mult').append(template);
        cont_input_mult++;
    });
    // 
    $(document).on("change", ".input_file_one", function(event){
        $(this).parent().hide();
    });
}
// 
// FUNCION FORM AGREGAR FIRMA DIGITAL
if ($(".input_firma").length > 0){
    // INPUT FILE NO SE LE PUEDE HACER SET POR SEGURIDAD, PARA LEERLO Y MODIFICARLO ES NECESARIO GUARDARLO EN ARRAY INDEPENDIENTE,LUEGO ESTE ARRAY SE PUEDE ENVIAR A ARCHIVOS PHP.
    var filecollection = new Array();
    $(document).on('change','.input_firma', function(e){
        var elemento = $(this);
        var files = e.target.files;
        var agregar_mult = $(this).closest('.agregar_firma_digital').find('.loading_inf');
        console.log(elemento);
        console.log(agregar_mult);
        $.each(files, function(i,file){
           
            filecollection.push(file);
           
            var reader = new FileReader();

            var file_type = file.type.split("/");
            var type = file_type[0];
            var ext = file_type[1];
            var name = file.name;
            var arr_ext_name = name.split(".");
            var ext_name = arr_ext_name[arr_ext_name.length - 1];

            $('.loading_inf').css({'display':'inline-flex'});

                console.log(type);
                console.log(ext);
                console.log(name);
                // console.log(arr_ext_name);
                // console.log(ext_name);

            if (type == 'image') {
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var template ='<div class="div_img"><img id="img_1" class="file" src="'+e.target.result+'" alt="" />'+
                    '<i class="icon-filled-no-check quitar_img"></i></div>';
                    agregar_mult.before(template);
                    if (elemento.hasClass('input_jcrop')){
                        cargar_jcrop();
                    }
                }
            }
            elemento.closest('.agregar_firma_digital').find('.button_firma').css({'display':'none'});
            $('.loading_inf').css({'display':'none'});
       });
    });
    // 
    $(document).on('click','.div_img .quitar_img', function(e){
        var index = $(".div_img .quitar_img").index($(this));
        var input = $(this).closest('.agregar_firma_digital').find('input');
        var lb_input = $(this).closest('.agregar_firma_digital').find('.button_firma');
        console.log(index);
        console.log(input);
        // $('.agregar_firma_digital input.input_firma').eq(index).remove();
        lb_input.css({'display':'inline-flex'});
        $(this).closest('.div_img').remove();
    });
    // 
    $(document).on("change", ".input_file_one", function(event){
        $(this).parent().hide();
    });
}
//
//RESPONSIVE MENUS
var width_window = $(window).innerWidth();
if (width_window <= 1260){
    $(document).on("click",".responsive_menu", function(e){
        $("div.menu").toggle();
    });
    // 
    $(document).on("click",".responsive_menu_p", function(e){
        $("div.div_menu_lateral").css({'display':'flex'});
        $("div.tabla").css({'overflow-x':'hidden'});
        disableScrolling();
    });

    $(document).on("click",".quitar_menu_lateral", function(e){
        $("div.div_menu_lateral").css({'display':'none'});
        if(window.autoScroll){
          window.clearInterval(window.autoScroll);
          window.autoScroll = false;
        }
        enableScrolling();
    });
}
//
//
$(window).on("load", function() {
    // $('i.icon-filled-lupa[type=submit],a[type=submit],button[type=submit]').attr('disabled',false);
    // $(document).on("change","form input[name='fecha_nac']", function(e){
    //     var fecha_nac = $(this).val();
    //     // var fecha_nac = "2020-04-27 00:00:00";
    //     // var fecha_actual = "2020-12-20 04:32:00";
    //     var edad = dif_fecha(fecha_nac,fecha_i+' '+hora_i);
    //     $("input[name='edad']").val(edad['años']);
    //     console.log(edad);
    // });
    // 
// Fin window onload
});