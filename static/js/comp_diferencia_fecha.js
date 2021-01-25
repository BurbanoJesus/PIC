function dif_fecha(fecha_1,fecha_2){
    // Agregar hora por default en caso de recibir fecha sin la hora
    fecha_1 = (fecha_1.search(" ") == -1) ? fecha_1 +=" 00:00:00" : fecha_1;
    fecha_2 = (fecha_2.search(" ") == -1) ? fecha_2 +=" 00:00:00" : fecha_2;
    // Guardar en aux las fechas para cambiar el orden segun cual sea la fecha mayor
    var aux_fecha_1 = fecha_1;
    var aux_fecha_2 = fecha_2;
    // Crear objeto fecha para las dos fechas
    var fecha_1 = new Date(fecha_1);
    var fecha_2 = new Date(fecha_2);
    // Crear variables de las fechas en milisegundos
    var fecha_1_time = fecha_1.getTime();
    var fecha_2_time = fecha_2.getTime();

    // Verificar cual fecha es mayor y establecer fecha inicial(1) y fecha final(2)
    if (fecha_1_time < fecha_2_time) {
        var str_fecha_1 = aux_fecha_1;
        var str_fecha_2 = aux_fecha_2;
        diferencia = fecha_2_time - fecha_1_time;
    }
    else{
        var str_fecha_1 = aux_fecha_2;
        var str_fecha_2 = aux_fecha_1;
        diferencia = fecha_1_time - fecha_2_time;
    }

    // extraer el año, mes y dia de cada fecha
    var values_1 = str_fecha_1.split(" ")[0].split("-");
    var yy_1 = values_1[0];
    var mm_1 = values_1[1];
    var dd_1 = values_1[2];
    //
    var values_2 = str_fecha_2.split(" ")[0].split("-");
    var yy_2 = values_2[0];
    var mm_2 = values_2[1];
    var dd_2 = values_2[2];

    year_inicio = parseInt(yy_1);
    year_final = parseInt(yy_2);
    mes_inicio = parseInt(mm_1);
    mes_final = parseInt(mm_2); 
    dia_inicio = parseInt(dd_1);
    dia_final = parseInt(dd_2);

    // 
    segundos = diferencia/1000;

    if (segundos >= 60) {
        minutos = segundos/60;
        minutos = Math.floor10(minutos);
        segundos = segundos%60;
    } else {
        minutos = 0;
    }
    console.log(minutos);
    console.log(segundos);

    if (minutos >= 60) {
        horas = minutos/60;
        horas = Math.floor10(horas);
        minutos = minutos%60;
    } else {
        horas = 0;
    }
    console.log(minutos);

    if (horas >= 24) {
        dias = horas/24;
        dias = Math.floor10(dias);
        horas = horas%24;
    } else {
        dias = 0;
    }


    var years_evaluados = [];
    var dias_bisiestos = 0;
    var aux_year_inicio = year_inicio;
    var aux_year_final = year_final;

    console.log('dias: '+dias);

    for (var year_i = year_inicio; year_i <= year_final; year_i ++){
        if (((year_i % 4 == 0) && (year_i % 100 != 0 )) || (year_i % 400 == 0)){
             switch(true){
                case aux_year_inicio == aux_year_final:
                    if (mes_inicio <= 2){
                        if ((mes_inicio == 2 && dia_inicio <=29 && mes_final >= 3) || (mes_inicio == 1 && dia_inicio <=31 && mes_final >= 3)) {
                            dias_bisiestos++;
                        }
                    }
                    break;

                case aux_year_inicio == year_i:
                    if (mes_inicio <= 2 && dia_inicio <= 31){
                        dias_bisiestos++;
                        // console.log('bi <');
                    }
                    break;

                case aux_year_final == year_i:
                    if (mes_final >= 3){
                            dias_bisiestos++;
                            // console.log('bi <');
                    }
                    break;

                default:
                    dias_bisiestos++;
                    // console.log('bi otro');
                    break;
            }
        }
    }
    (dias >= 28 ) ? dias -= dias_bisiestos: true;
    // console.log(dias);
    console.log('dias bi: '+dias_bisiestos);

    var dias_cada_mes = [0,31,28,31,30,31,30,31,31,30,31,30,31];
    var meses = 0;
    var aux_mes_inicio = mes_inicio;
    var aux_mes_final = mes_final;

    if (dias >= 365) {
        years = dias/365;
        years = Math.floor10(years);
        dias = dias%365;
    } else {
        years = 0;
    }
    // 06 - 04
    switch(true){
        case mes_inicio > mes_final:
            for (mes_inicio; mes_inicio <= 12; mes_inicio++) {
                if (dias >= dias_cada_mes[mes_inicio]) {
                    dias -= dias_cada_mes[mes_inicio];
                    meses++;
                    console.log(dias);
                }
            }
            for (i = 1; i <= mes_final; i++) {
               if (dias >= dias_cada_mes[i]) {
                    dias -= dias_cada_mes[i];
                    meses++;
                    console.log(dias);
                }
            }
            break;

        case mes_inicio < mes_final:
            for (mes_inicio; mes_inicio <= mes_final; mes_inicio++) {
                if (dias >= dias_cada_mes[mes_inicio]) {
                    dias -= dias_cada_mes[mes_inicio];
                    meses++;
                }
            }
            break;

        case mes_inicio == mes_final && dias >= 334:
            for (mes_inicio; mes_inicio <= 12; mes_inicio++) {
                if (dias >= dias_cada_mes[mes_inicio]) {
                    dias -= dias_cada_mes[mes_inicio];
                    meses++;
                }
            }
            for (i = 1; i < mes_final; i++) {
               if (dias >= dias_cada_mes[i]) {
                    dias -= dias_cada_mes[i];
                    meses++;
                }
                console.log(dias);
            }
            break;

    }
    console.log('meses :'+meses);

    if (meses >= 12) {
        years ++;
        meses = 0;
    }

    var dif_fecha = {
        "años" : years,
        "meses" : meses,
        "dias" : dias,
        "horas" : horas,
        "minutos" : minutos,
        "segundos" : segundos,
    }

    // return years+' Años y '+meses+' Meses y '+dias+' Dias y '+horas+' Horas y '+minutos;
    return dif_fecha;
}
//