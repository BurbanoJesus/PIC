
var target_actual = {};
// SELECT
$(document).on("mousedown",".select .head_select", function(){
    target_actual = $(this).parent();
    var elemento = $(this);
    var target = elemento.parent().find('.opciones');
    // console.log(target);
    if (target.hasClass('slider_down')) {
        target.hide();
        target.removeClass('slider_down');
    }else{
        $(".select .opciones").removeClass('slider_down').hide();
        target.show();
        target.addClass('slider_down');
    }
});

$(document).on("click",".select .opciones .opcion", function(){
    var elemento = $(this);
    var data_elemento = $(this).find('span').html();
    var select = $(this).closest('.select');
    var target = select.find('.opciones');
    var data_select = $(this).closest('.select').attr('data');
    target.removeClass('slider_down');
    if (data_elemento != data_select) {
        select.attr('data',data_elemento);
        select.find('.head_select').find('.nombre_select').html(data_elemento);
        select.find('input[type="hidden"]').val(data_elemento);
        if (elemento.hasClass('default')){
            select.find('input[type="hidden"]').val('');
        }
    }
    if (elemento.hasClass('t_submit')) {
        elemento.closest('form').submit();
    }
    $(this).parent().hide();
});

function data_select(){
    $(".select").each(function(index,value){
        var select = $(this);
        var data = select.attr('data');
        if (data.length > 0){
            select.find('.head_select').find('.nombre_select').html(data);
            select.find('input[type="hidden"]').val(data);
        }
    });
}

data_select();

function selected(){
    $(".select .opciones .opcion").each(function(index,value){
        var select = $(this).closest('.select');
        var elemento = $(this);
        if (elemento.attr('selected') == 'selected'){
            var data = elemento.find('span').html();
            select.attr('data',data);
            select.find('.head_select').find('.nombre_select').html(data);
            select.find('input[type="hidden"]').val(data);
        }
    });
}

selected();