// 
// CHECK
$(document).on("click",".check .elemento", function(){
    var elemento = $(this);
    var data_elemento = $(this).find('span').html();
    var check = $(this).closest('.check');
    var data_check = $(this).closest('.check').attr('data');
    if (data_elemento != data_check) {
        check.find(".elemento").css({'color':'var(--gris)'});
        elemento.css({'color':'var(--verde_check)'});
        check.attr('data',data_elemento);
        check.find('input[type="hidden"]').val(data_elemento);
    }else{
        elemento.css({'color':'var(--gris)'});
        check.attr('data','');
        check.find('input[type="hidden"]').val('');
    }
});

function checked(check){
    $(".check .elemento").each(function(index,value){
        var check = $(this).closest('.check');
        var elemento = $(this);
        var data_elemento = $(this).find('span').html();
        if (elemento.attr('checked') == 'checked'){
            check.find(".elemento").css({'color':'var(--gris)'});
            elemento.css({'color':'var(--verde_check)'});
            check.attr('data',data_elemento);
            check.find('input[type="hidden"]').val(data_elemento);
        }
    });
}
checked();

function checked_elem(check){
    check.find('.elemento').each(function(index,value){
        var check = $(this).closest('.check');
        var elemento = $(this);
        var data_elemento = $(this).find('span').html();
        if (elemento.attr('checked') == 'checked'){
            check.find(".elemento").css({'color':'var(--gris)'});
            elemento.css({'color':'var(--verde_check)'});
            check.attr('data',data_elemento);
            check.find('input[type="hidden"]').val(data_elemento);
        }
    });
}

function data_check(){
    $(".check").each(function(index,value){
        var check = $(this);
        var data = $(this).attr('data');
        var array = $(this).find('.elemento span');
        if (data.length > 0) {
            array.each(function(index,value){
                if(value.innerHTML == data){
                    console.log(value);
                    console.log(data);
                    array.eq(index).closest('.elemento').attr('checked','');
                    checked_elem(check);
                }
            });
        }
    });
}
data_check();
// 
