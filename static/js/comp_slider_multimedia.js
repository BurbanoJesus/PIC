
    // SLIDER MULTIMEDIA
    $(document).on("click",".slider_multimedia .imagen", function(){
        var elemento = $(this);
        var array= $(this).parent().children();
        var source = $(this).find('.file');
        // console.log(source);
        var index = parseInt($(this).attr("index"));
        var target = $(this).closest(".slider_multimedia").find('.current_mult');
        var slider_multimedia = $(this).closest('.slider_multimedia');
        console.log(source);
        source = source.prop('outerHTML');
        target.html(source);
        source = target.find('.file');
        source.attr('index',index);
        source.prop('class','call_theater multimedia file');
        source.attr('target','theater');

        array.removeClass('active');
        elemento.addClass('active');
        console.log(index);
        var btn_left = slider_multimedia.find('.btn_left');
        var btn_right = slider_multimedia.find('.btn_right');
        if (index == 0) {
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
    });

    $(document).on("click",".slider_multimedia .img_main .btn_left, .slider_multimedia .img_main .btn_right", function(e){
        e.stopPropagation();
        var index = parseInt($(this).attr("index"));
        var array= $(this).closest('.slider_multimedia').find('div.file_multimedia').find('.imagen');
        var elemento = array.eq(index);
        var source = elemento.find('.file');
        var target = $(this).closest(".img_main").find('.current_mult');
        var slider_multimedia = $(this).closest('div.slider_multimedia');
        var slider_num_imgs = slider_multimedia.attr('numero_imgs');
        source = source.prop('outerHTML');
        console.log(source);
        console.log(index);
        target.html(source);
        target.attr('index',index);
        source = target.find('.file');
        source.attr('index',index);
        source.prop('class','call_theater multimedia file');
        source.attr('target','theater');

        console.log(index);
        var btn_left = slider_multimedia.find('.btn_left');
        var btn_right = slider_multimedia.find('.btn_right');
        if (index == 0) {
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


        if (index <= slider_num_imgs) {
            array.removeClass('active');
            elemento.addClass('active');
        }else{
            array.eq(slider_num_imgs).addClass('active');
        }
    });
