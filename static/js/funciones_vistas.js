// 
// VISTA EXPERIENCIAS EXITOSAS
if ($("#experiencias_exitosas").length > 0) {
// TIPO DE VISTA
    $(document).on("click",".vista .vista_lista", function(){
        if ($("div#contenido").hasClass('contenido_g')) {
            $("div.contenido_g").removeClass('contenido_g');
            $("div.productos_g").removeClass('productos_g').addClass('productos');
            $("div.info_producto_g").removeClass('info_producto_g').addClass('info_producto');
            $(".vista_grid").removeClass('active');
            $(this).addClass('active');
        }
    });

    $(document).on("click",".vista .vista_grid", function(){
        if ($("div#contenido").hasClass('contenido')) {
            $("div.contenido").addClass('contenido_g');
            $("div.productos").removeClass('productos').addClass('productos_g');
            $("div.info_producto").removeClass('info_producto').addClass('info_producto_g');
            $(".vista_lista").removeClass('active');
            $(this).addClass('active');
        }
    });

    $(document).on("click",".quitar_filtros", function(){
        window.location = '/plataforma/experiencias_exitosas';
    });

    $(document).on("click",".r_filtros", function(e){
       $("div.filtros").toggle();
       console.log('this 1');
    });

    // Responsive
    if ($(".r_filtros").hasClass('get_on') && width_window <= 500) {
        $("div.filtros").toggle();
    }

    if (width_window <= 500) {
        $("div.filtros").toggle();
    }
}
//
// VISTA REGISTRAR EXAMEN
else if ($("#agregar_examen").length > 0) {
    var cont_preguntas = 2;
    $(document).on("click", "#agregar_examen #add_pregunta", function(event){
        console.log('this');
        var template = '<div class="contenido_preguntas">'+
                        '<div class="input s100">'+
                            '<h3>Pregunta '+cont_preguntas+'.</h3>'+
                            '<div class="contenido_input">'+
                            '<textarea class="input input_text" name="pregunta_'+cont_preguntas+'" placeholder="Ingresar Información..." required></textarea>'+
                            '</div>'+
                        '</div>'+
                        '<div class="input s100">'+
                            '<h3>Respuesta Correcta.</h3>'+
                            '<div class="contenido_input"><input class="input" type="text" name="respuesta_'+cont_preguntas+'"  placeholder="Ingresar respuesta..." required /></div>'+
                            '<h3>Respuesta Incorrecta.</h3>'+
                            '<div class="contenido_input"><input class="input" type="text" name="respuesta_a'+cont_preguntas+'"  placeholder="Ingresar respuesta..." required /></div>'+
                            '<h3>Respuesta Incorrecta.</h3>'+
                            '<div class="contenido_input"><input class="input" type="text" name="respuesta_b'+cont_preguntas+'"  placeholder="Ingresar respuesta..." required /></div>'+
                            '<h3>Respuesta Incorrecta.</h3>'+
                            '<div class="contenido_input"><input class="input" type="text" name="respuesta_c'+cont_preguntas+'"  placeholder="Ingresar respuesta..." required /></div>'+
                        '</div>'+
                    '</div>';
        $('.content_examen').append(template);
        cont_preguntas++;
        $('#remove_pregunta').removeClass('disabled');
    });

    $(document).on("click", "#agregar_examen #remove_pregunta", function(event){
        var array = $('.content_examen').children();
        var length = array.length;
        if (length > 1){
            array[length - 1].remove();
            cont_preguntas--;
            (length == 2) ? $(this).addClass('disabled') : true;
        }
    });
}
//
// VISTA REGISTRAR JUEGO VF
else if ($("#registrar_juego_vf").length > 0) {
    var cont_juegos_vf = 2;
    $(document).on("click", "#registrar_juego_vf #add_pregunta", function(event){
        console.log('this');
        var template = '<div class="contenido_preguntas">'+
                            '<div class="input s100">'+
                                '<h3>Pregunta '+cont_juegos_vf+'.</h3>'+
                                '<div class="contenido_input">'+
                                '<textarea class="input input_text" name="pregunta_'+cont_juegos_vf+'" id="" placeholder="Ingresar Información..." required></textarea></div>'+
                            '</div>'+
                            '<div class="input s100">'+
                                '<h3>Respuesta '+cont_juegos_vf+'.</h3>'+
                                '<div class="select" id="categoria" data="">'+
                                '<div class="head_select">'+
                                    '<span class="nombre_select">Seleccione respuesta</span>'+
                                    '<i class="icon-arrow"></i>'+
                                '</div>'+
                                '<div class="opciones">'+
                                    '<div class="opcion"><i class="icon-filled-check"></i><span>Verdadero</span></div>'+
                                    '<div class="opcion"><i class="icon-filled-check"></i><span>Falso</span></div>'+
                                '</div>'+
                                '<input type="hidden" name="respuesta_'+cont_juegos_vf+'" required />'+
                           '</div>'+
                            '</div>'+
                            '<div class="input s100">'+
                                '<h3>Agregar Imagen.</h3>'+
                                '<div class="contenido_input">'+
                                    '<div id="contenido_img" class="contenido_img">'+
                                        '<div id="loading_inf_1" class="loading_inf"><img src="/plataforma/static/img/loading/loading3.gif" alt=""></div>'+
                                        '<div class="agregar_mult">'+
                                            '<input class="input_preview input_file_one" id="input_file_'+cont_juegos_vf+'" name="image_'+cont_juegos_vf+'" type="file" accept="image/*" required />'+
                                            '<label class="label_icon icon-filled-add-multimedia" for="input_file_'+cont_juegos_vf+'"></label>'+
                                            '<div class="div_button"><label class="button" for="input_file_'+cont_juegos_vf+'">Agregar</label></div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
        $('.content_juegos_vf').append(template);
        cont_juegos_vf++;
        $('#remove_pregunta').removeClass('disabled');
    });

    $(document).on("click", "#registrar_juego_vf #remove_pregunta", function(event){
        var array = $('.content_juegos_vf').children();
        var length = array.length;
        if (length > 1){
            array[length - 1].remove();
            cont_preguntas--;
            (length == 2) ? $(this).addClass('disabled') : true;
        }
    });
}
// 

// VISTA LOGIN
else if ($("input[type='password']").length > 0) {
    $("form .input_login input").each(function(index,value){
        if ($(this).val().length > 0) {
            console.log($(this).length);
            $(this).next().addClass('input_fijo');
        }
    });


    $("form .input_login input").on('focusout', function(){
        if ($(this).val().length > 0) {

            $(this).next().addClass('input_fijo');
        } else {
            $(this).next().removeClass('input_fijo');
        }
    });

    $(document).on("click","i.pass", function(e){
        var icon = $(this);
        var input = $(this).closest('.input_login, .contenido_input').find('input');
        if (icon.hasClass('icon-lineal-visible')) {
            $(this).removeClass('icon-lineal-visible').addClass('icon-lineal-no-visible');
            input.attr('type','text').focus();

        } else {
            $(this).removeClass('icon-lineal-no-visible').addClass('icon-lineal-visible');
            input.attr('type','password').focus();
        }
    });

    $(document).on("click","i.pass_db", function(e){
        var icon = $(this);
        var input = $(this).closest('form').find('input.input_pass');
        console.log(input);
        if (icon.hasClass('icon-lineal-visible')) {
            $('i.pass_db').removeClass('icon-lineal-visible').addClass('icon-lineal-no-visible');
            input.attr('type','text').focus();

        } else {
            $('i.pass_db').removeClass('icon-lineal-no-visible').addClass('icon-lineal-visible');
            input.attr('type','password').focus();
        }
    });
}
//
// VISTA ACTIVIDAD
else if ($("#actividad").length > 0){
    var subs = $("#actividad").attr('subs');
    console.log(subs);
    // 
    if (subs !== '0') {
        console.log('this');
        const data = new FormData();
        let id = $("#actividad").attr('id_data');
        data.append('id', id);
        console.log(id);
        $.ajax({
            url: '/plataforma/core/controllers/inicio/aprende/c_tiempo_actividad.php',
            method: 'POST',
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // $("#divres").html("<img src='images/ajax-loader.gif'>");
            },
            success: function(datos){
                console.log(datos);
                datos = JSON.parse(datos);
                let minutos = datos.row.tiempo;
                let segundos = parseInt(minutos*60);
                interval_temp(3);


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
    //
    function interval_temp(tiempo){
        let tiempo_final = tiempo;
        let t = {};
        let str_time = '';
        const intervalo =  setInterval(function(){
            t = get_time_temp_min(tiempo_final);
            // console.log(t.tiempo);
            if (t.mins > 0) {
                str_time = t.mins+' Min: '+t.secs+' Seg.';
            }else{
                t.secs = parseInt(t.secs);
                str_time = t.secs+' Seg.';
            }
            document.getElementById("tiempo").innerHTML = str_time;
            if (t.tiempo <= 0) {
                clearInterval(intervalo);
                $("#btn_actividad").prop('disabled', false);
                $("#btn_actividad").removeClass('disabled');
                if ($("#actividad_general").length > 0) {
                    document.getElementById("tiempo").innerHTML = 'Ya puedes finalizar la actividad!';
                }else if ($("#examen").length > 0){
                    document.getElementById("tiempo").innerHTML = 'Fin de tiempo!';
                    console.log('enviar submit');
                    // $("#form_examen").submit();
                }
            }else{
                tiempo_final =  tiempo_final - 1;
            }
            // console.log('this');
        },1000);
    }
    // 
    $(document).on("click","#btn_actividad", function(e){
        e.preventDefault();
        let id_modulo = $("#actividad").attr('id_modulo');
        if (subs === '1') {
            const data = new FormData();
            let id = $("#actividad").attr('id_data');
            data.append('id', id);
            $.ajax({
                url: '/plataforma/core/controllers/inicio/aprende/c_actualizar_progreso.php',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                // dataType:  "json",
                beforeSend: function() {
                    // $("#divres").html("<img src='images/ajax-loader.gif'>");
                },
                success: function(datos){
                    // console.log(datos);
                    // datos = JSON.parse(datos);
                    window.location = '/plataforma/actividades?id='+id_modulo;
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
        }else{
             window.location = '/plataforma/actividades?id='+id_modulo;
        }
    });
    // 
}
//
// VISTA AGREGAR COMENTARIO
if ($("#agregar_comentario").length > 0){
    if ($(".input_valoracion").find('input').val() != ''){
        var array_img = $(".wrap_img_estrella img");
        var index = $(".input_valoracion").find('input').val();
        index = parseInt(index) - 1;
        var sp_estrella = $(".input_valoracion").find('span');
        var sp_string = sp_estrella.attr('string');
        var flag_rtx = false;
        // 
        for (i = 0; i <= index; i++) {
            console.log(array_img.eq(i));
            array_img.eq(i).prop('src','/plataforma/static/img/estrellas/medium/estrella_m.png');
        }
        if (index == 0) {
            str_span = 'Una estrella!';
        }
        else  if (index == 1) {
            str_span = 'Dos estrellas!';
        }
        else  if (index == 2) {
            str_span = 'Tres estrellas!';
        }
        else  if (index == 3) {
            str_span = 'Cuatro estrellas!';
        }
        else  if (index == 4) {
            str_span = 'Cinco estrellas!';
        }

        sp_estrella.html(str_span);

        for (i = 0; i < array_img.length; i++) {
            if (i <= index) {
                array_img.eq(i).addClass('rtx_on');
            }else{
                array_img.eq(i).prop('src','/plataforma/static/img/estrellas/medium/borde_estrella_m.png');
                array_img.eq(i).removeClass('rtx_on');
            }
        }
        sp_estrella.attr('string',str_span);
    }
    // 
    $(document).on("mousedown mouseenter",".wrap_img_estrella", function(e){
        var array = $(".wrap_img_estrella");
        var index = array.index($(this));
        var array_img = array.find('img');
        var sp_estrella = $(".input_valoracion").find('span');
        for (i = 0; i <= index; i++) {
            array_img.eq(i).prop('src','/plataforma/static/img/estrellas/medium/estrella_m.png');
        }
        if (index == 0) {
            str_span = 'Una estrella!';
        }
        else  if (index == 1) {
            str_span = 'Dos estrellas!';
        }
        else  if (index == 2) {
            str_span = 'Tres estrellas!';
        }
        else  if (index == 3) {
            str_span = 'Cuatro estrellas!';
        }
        else  if (index == 4) {
            str_span = 'Cinco estrellas!';
        }

        sp_estrella.html(str_span);
    });
    // 
    $(document).on("mouseleave",".wrap_img_estrella", function(e){
        var array_img = $(".wrap_img_estrella img");
        var sp_estrella = $(".input_valoracion").find('span');
        var sp_string = sp_estrella.attr('string');
        var flag_rtx = false;
        for (i = 0; i < array_img.length; i++) {
            if (array_img.eq(i).hasClass('rtx_on') != true) {
                array_img.eq(i).prop('src','/plataforma/static/img/estrellas/medium/borde_estrella_m.png');
            }else{
                flag_rtx = true;
            }
        }
        if (flag_rtx == false) {
            sp_estrella.html('Se requiere calificación.');
        }else{
            sp_estrella.html(sp_string);
        }
    });
    // 
    $(document).on("click",".wrap_img_estrella", function(e){
        var array = $(".wrap_img_estrella");
        var index = array.index($(this));
        var array_img = array.find('img');
        var sp_estrella = $(".input_valoracion").find('span');
        var sp_actual = sp_estrella.html();
        var input = $(".input_valoracion").find('input');
        for (i = 0; i < array_img.length; i++) {
            if (i <= index) {
                array_img.eq(i).addClass('rtx_on');
            }else{
                array_img.eq(i).prop('src','/plataforma/static/img/estrellas/medium/borde_estrella_m.png');
                array_img.eq(i).removeClass('rtx_on');
            }
        }
        sp_estrella.attr('string',sp_actual);
        input.val(index+1);
    });
}
//
// VISTA LISTA ARCHIVOS PANEL
if ($("#lista_archivos").length > 0){
    $(document).on("click",".btn_filtros_lista_archivos", function(e){
        let elemento = $("div.filtros_panel");
        if (elemento.hasClass('open')){
            elemento.removeClass('open');
            elemento.css({'display':'none'});
        }else{
            elemento.css({'display':'inline-flex'});
            elemento.addClass('open');
        }
    });
}
