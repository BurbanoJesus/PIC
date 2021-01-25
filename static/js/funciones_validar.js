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


function validar_select(flag_validar){
    var array_select = [];
    $(".select").each(function(index,value){
        if (!$(this).attr('data')) {
            console.log('this');
            $(this).find('.head_select').css({'border-color':'#D93025'});
            $(this).find('.head_select i').css({'color':'#D93025'});
            array_select.push(false);
        }
        else{
            $(this).find('.head_select').css({'border-color':'var(--gris)'});
            $(this).find('.head_select i').css({'color':'var(--gris)'});
            array_select.push(true);
        }
    });
    array_select.forEach(function(value,index){
        if (value == false) {
            flag_validar = false;
        }
    });
    return flag_validar;
}
    