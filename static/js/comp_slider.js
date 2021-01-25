
// SLIDER
var slider = '';
var interval = '';
var sections = [];


function init_slider(){
    slider = $('#slider');
    sections = slider.find('section');
    sliderLength();
    if (sections.length == 1) {
        slider.closest('.contenedor_slider').find('#btn_prev').hide();
        slider.closest('.contenedor_slider').find('#btn_next').hide();
    }else{
        $('#slider .slider_section:last').insertBefore('#slider .slider_section:first');
        //mostrar la primera imagen con un margen de -100%
        slider.css('margin-left', '-'+100+'%');
    }
    autoplay();
}

init_slider();

//mover ultima imagen al primer lugar
function sliderLength(){
    var slider_length = ($("#slider .slider_section").length*100);
    $("#slider").css('width',slider_length+'%');
}

function moverD() {
    slider.animate({
        marginLeft:'-'+200+'%'
    } ,700, function(){
        $('#slider .slider_section:first').insertAfter('#slider .slider_section:last');
        slider.css('margin-left', '-'+100+'%');
    });
}

function moverI() {
    slider.animate({
        marginLeft:0
    } ,700, function(){
        $('#slider .slider_section:last').insertBefore('#slider .slider_section:first');
        slider.css('margin-left', '-'+100+'%');
    });
}

function autoplay() {
    var slider_move = ($(".slider_move").length > 0) ? true: false;
    if (sections.length > 1 && slider_move === false) {
        interval = setInterval(function(){
            moverD();
        }, 2000);
    }
}

function destroy_slider(){
    if (interval !== ''){
        clearInterval(interval);
    }
}


$(document).on("click","#btn_next",function() {
    moverD();
    clearInterval(interval);
    autoplay();
});

$(document).on("click","#btn_prev",function() {
    moverI();
    clearInterval(interval);
    autoplay();
});

$(document).on("mouseenter mousedown",".slider", function(e){
    if (sections.length > 1) {
        clearInterval(interval);
    }
});

$(document).on("mouseleave",".slider", function(e){
    if (sections.length > 1) {
        clearInterval(interval);
        autoplay();
    }
});