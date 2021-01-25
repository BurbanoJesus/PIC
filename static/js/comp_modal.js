

// MODAL, THEATER
$(window).resize(function() {
    // var width_window = document.body.scrollWidth;
    // var width_window = document.body.clientWidth;
    width_window = window.innerWidth;
    height_window = window.innerHeight;
    $(".modal").css({'width': width_window+'px'});
    $(".theater").css({'width': width_window+'px'});
});

var target = "";
var width_window = window.innerWidth;

function call_modal(target){
    $(target).css("width",width_window+"px");
    $(target).fadeIn().css("display","inline-flex");
    $(target).find(".modal_main, .theater_main").show().css("display","block");
    // $('html').css('overflow','hidden');
    disableScrolling();
}

function call_theater(){
    $("#theater").css("width",width_window+"px");
    $("#theater").fadeIn().css("display","inline-flex");
    $("#theater").find(".theater_main").show().css("display","block");
    // $('html').css('overflow','hidden');
    if ($(".theater_content").height() > window.innerHeight) {
        $(".theater_content").css('padding-right','17px');
    }
    disableScrolling();
}

$(document).on("click",".modal .close, .modal .acept", function(e){ 
    e.stopPropagation();
    var target = '#'+$(this).closest('.modal').attr("id");
    // var is_closed = '#'+$(this).closest('.modal').attr("data_close");
    $(target).fadeOut();
    $(target).find(".modal_main").fadeOut();
    $('html').css('overflow','auto');
    if(window.autoScroll){
      window.clearInterval(window.autoScroll);
      window.autoScroll = false;
    }
    enableScrolling();
});

$(document).on("click",".theater .close, .theater .acept, .theater", function(e){ 
    e.stopPropagation();
    var target = '#theater';
    $(target).fadeOut();
    $(target).find(".theater_main").fadeOut();
    $(target).find(".theater_content").children().remove();
    $('html').css('overflow','auto');
    if(window.autoScroll){
      window.clearInterval(window.autoScroll);
      window.autoScroll = false;
    }
    enableScrolling();
    if ($('#theater').attr('slider_theater') != undefined) {
        destroy_slider();
        console.log($('#theater').prop('outerHTML'));
    }
});

$(document).on("click",".modal_main", function(e){ 
    e.stopPropagation();
});

$(document).on("click",".theater_main", function(e){ 
    e.stopPropagation();
});

$(document).on("click",".theater .indicador", function(e){ 
    e.stopPropagation();
});


$(document).on("click",".call_modal", function(){
    var target = "#"+$(this).attr("target");
    // console.log(target);
    call_modal(target);
});

//----
//----
//----

$(document).on("click",".call_theater", function(e){
    e.stopPropagation();
    var elemento = $(this);
    init_theater(elemento);
});

function init_theater(elemento){
    var target = "#theater";
    var source = elemento;
    var target_t = $(target).find(".theater_content");
    if (elemento.hasClass('multimedia')) {
        var data = elemento.closest('div.slider_multimedia').attr('id');
        var index = parseInt(elemento.attr('index'));
        var array = elemento.closest('div.slider_multimedia').find('div.file_multimedia').find('.imagen');
    }
    if (elemento.hasClass('simple')) {
        var data = elemento.closest('div.file_multimedia').attr('id');
        var index = parseInt(elemento.attr('index'));
        var array = elemento.closest('div.file_multimedia').find('.file');
        console.log(array);
    }
    if (elemento.hasClass('enlace')) {
        var data = elemento.attr("data_target");
        var array = $('#'+data).find('.file');
        source = array.eq(0);
        var index = parseInt(source.attr('index'));
    }

    source = source.prop('outerHTML');
    target_t.html(source);
    source = target_t.find('.file');
    source.prop('class','file');
    $(target).attr('data',data);
    // $(target).find('.indicador').html(index+'/'+array.length-1);
    var numero = index+1;
    var total = array.length;
    console.log(index);
    console.log(numero);
    (total > 1) ? $(target).find('.indicador').html(numero+" / "+total) : true;
    check_index_theater(target,array,index);
    call_theater();
    // console.log($('#theater').prop('outerHTML'));
}


$(document).on("click",".theater .btn_left,.theater .btn_right", function(e){
    e.stopPropagation();
    var theater = "#"+$(this).closest('.theater').attr("id");
    var target_t = $(this).closest('.theater').find(".theater_content");
    var data = $(this).closest('.theater').attr('data');
    var index = parseInt($(this).attr('index'));
        console.log(data);
    if ($('#'+data).hasClass('slider_multimedia')) {
        var array = $('#'+data).find('div.file_multimedia').find('.imagen');
        var elemento = array.eq(index);
        var source = elemento.find('.file');
    }
    else{
        var array = $('#'+data).find('.file');
        var elemento = array.eq(index);
        var source = elemento;
    }
    source = source.prop('outerHTML');
    target_t.html(source);
    source = target_t.find('.file');
    source.prop('class','');
    var numero = index+1;
    var total = array.length;
    $(theater).find('.indicador').html(numero+" / "+total);
    check_index_theater(theater,array,index);
});

function check_index_theater(theater,array,index){
    var btn_left = $(theater).find('.btn_left');
    var btn_right = $(theater).find('.btn_right');
    btn_left.show();
    btn_right.show();
    if (array.length == 1) {
        btn_left.attr('index',0).hide();
        btn_right.attr('index',0).hide();
    }
    else if (index == 0) {
        btn_left.attr('index',array.length-1);
        btn_right.attr('index',index+1);
    }
    else if(index == array.length-1){
        btn_left.attr('index',index-1);
        btn_right.attr('index',0);
    }
    else if(index > 0 && index < array.length-1){
        btn_left.attr('index',index-1);
        btn_right.attr('index',index+1);
    }
}
