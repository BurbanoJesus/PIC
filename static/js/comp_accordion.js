
    // ACCORDION

    // $('.accordion_contenido').hide();
    $(document).on("click",".accordion_elemento .nombre_elemento", function(e){
        var elemento = $(this);
        var target = elemento.next();


        // accordionItemHeader = this;
        // accordionItemHeader.classList.toggle("active");
        // const accordionItemBody = accordionItemHeader.nextElementSibling;
        // if(accordionItemHeader.classList.contains("active")) {
        //   accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
        // }
        // else {
        //   accordionItemBody.style.maxHeight = 0;
        // }

        console.log(target.prop('scrollHeight'));
        var scroll_height = target.prop('scrollHeight');

        elemento.toggleClass('open');
        if (elemento.hasClass('open')) {
            elemento.find('.arrow_accordion').css({'transform': 'translateY(-50%) rotate(270deg)'});
            target.css('max-height',scroll_height+'px');
        } 
        else {
            elemento.find('.arrow_accordion').css({'transform': 'translateY(-50%) rotate(90deg)'});
            target.css({'max-height':'0px'});
        }
        // console.log(this);
    });
    // 
