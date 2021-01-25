// 
// VISTA INFORME 2
if ($("#informe_2").length > 0) {
    var c_inf_2 = 6;
    $(document).on("click","#informe_2 #add_1", function(e){
        var elemento = $(this);
        var template = '<tr class="center">'+
                        '<td class="center nopadd"><input class="total center" type="text" name="municipio_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="dirigido_'+c_inf_2+' "/></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="tema_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="fecha_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="responsable_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="seguimiento_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="eval_satis_'+c_inf_2+'" /></td>'+
                        '<td class="center nopadd"><input class="total center" type="text" name="observaciones_'+c_inf_2+'" /></td>'+
                    '</tr>';
        elemento.closest('table').find('tbody').append(template);
        c_inf_2++;
    });
}
//
// VISTA INFORME 4
else if ($("#informe_4").length > 0) {
    var cont_a = 6;
    $(document).on("click","#informe_4 #add_asistentes", function(e){
        var elemento = $(this);
        var template = '<tr class="center">'+
                            '<td class="center nopadd">'+cont_a+'</td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="nombre_'+cont_a+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="documento_'+cont_a+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="area_'+cont_a+'" /></td>'+
                            '<td class="center nopadd">'+
                               '<div class="agregar_firma_digital">'+
                                   '<div id="loading_'+cont_a+'" class="loading_inf">'+
                                        '<img src="/plataforma/static/img/loading/loading3.gif" alt=""></div>'+
                                   '<input class="input_firma" id="in_firma_'+cont_a+'" '+
                                   'name="firma_'+cont_a+'" accept="image/jpeg,image/png" type="file" />'+
                                   '<div class="div_button"><label class="button_firma" for="in_firma_'+cont_a+'">Seleccionar Imagen</label></div>'+
                                '</div>'+
                           '</td>'+
                        '</tr>';
        elemento.closest('table').find('tbody').append(template);
        cont_a++;
    });
    var cont_b = 6;
    $(document).on("click","#informe_4 #add_orden", function(e){
        var elemento = $(this);
        var template = '<tr class="center">'+
                            '<td class="center">'+cont_b+'</td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="tematica_'+cont_b+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="responsable_'+cont_b+'" /></td>'+
                        '</tr>';
        elemento.closest('table').find('tbody').append(template);
        cont_b++;
    });
    var cont_c = 6;
    $(document).on("click","#informe_4 #add_compromisos", function(e){
        var elemento = $(this);
        var template = '<tr class="center">'+
                            '<td class="center nopadd"><input class="total center" type="text" name="compromisos_'+cont_c+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="responsable_ejecutar_'+cont_c+'" /></td>'+
                            '<td class="center nopadd"><input type="date" name="fecha_reunion_'+cont_c+'" value="'+fecha_i+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="obs_compromisos_'+cont_c+'" /></td>'+
                        '</tr>';
        elemento.closest('table').find('tbody').append(template);
        cont_c++;
    });
    var cont_d = 6;
    $(document).on("click","#informe_4 #add_seguimiento", function(e){
        var elemento = $(this);
        var template = '<tr class="center">'+
                            '<td colspan="2" class="center nopadd">'+
                                '<input class="total center" type="text" name="compromisos_seguimiento_'+cont_d+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="seguimiento_'+cont_d+'" /></td>'+
                            '<td class="center nopadd">'+
                                '<input type="date" name="fecha_seguimiento_'+cont_d+'" value="'+fecha_i+'" /></td>'+
                            '<td class="center nopadd"><input class="total center" type="text" name="obs_seguimiento_'+cont_d+'" /></td>'+
                        '</tr>';
        elemento.closest('table').find('tbody').append(template);
        cont_d++;
    });
}