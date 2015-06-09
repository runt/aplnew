
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){

// ajax handling for monatjahr
$('input#monatjahr').blur(function(){
        var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    $('#debuginfo').append( "<br>onchange - START"+
                            "<br>id="+id+
                            "<br>acturl="+acturl+
                            "<br>value="+value);

    $.post(acturl,
        {
            elementid: id,
            monatjahr: value
        },
        function(data){
                updateMonat(data);
        },
        'json'
    );

});

//$('input#monatjahr').focus();
//$('#debuginfo').hide();


// validate policek pro zadani casu od do
$('div#fillformular input:text').blur(ajaxHandlerVonBis);
// funkce plniciho tlacitka
$('div#fillformular input:button').click(ajaxFillVonBis);

});


function ajaxHandlerSvatek(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).attr('checked');

    $('#debuginfo').prepend( "<br>click - START"+
                            "<br>id="+id+
                            "<br>acturl="+acturl+
                            "<br>value="+value
                            );

    $.post(acturl,
        {
            elementid: id,
            value: value
        },
        function(data){
                updateSvatek(data);
        },
        'json'
    );

}

function ajaxFillVonBis(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var monatjahr = $('#monatjahr').val();
    var value = '';
    var vonvalue = '';
    var bisvalue = '';

    switch (id) {
        case 'button_fill_guss_f':
            vonvalue = $('#fill_guss_f_von').val();
            bisvalue = $('#fill_guss_f_bis').val();
            break;
        case 'button_fill_guss_s':
            vonvalue = $('#fill_guss_s_von').val();
            bisvalue = $('#fill_guss_s_bis').val();
            break;
        case 'button_fill_ne_f':
            vonvalue = $('#fill_ne_f_von').val();
            bisvalue = $('#fill_ne_f_bis').val();
            break;
        case 'button_fill_ne_s':
            vonvalue = $('#fill_ne_s_von').val();
            bisvalue = $('#fill_ne_s_bis').val();
            break;
        default:
            break;
    }

//    $('#debuginfo').prepend( "<br>click - START"+
//                            "<br>id="+id+
//                            "<br>acturl="+acturl+
//                            "<br>value="+value
//                            );

    $.post(acturl,
        {
            elementid: id,
            monatjahr: monatjahr,
            value: value,
            von:vonvalue,
            bis:bisvalue
        },
        function(data){
                updateFillvonbis(data);
        },
        'json'
    );

}


/**
 * ajax Handler for monatjahr
 *
 */
function ajaxHandlerMonatJahr(event){

    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    $('#debuginfo').append( "<br>onchange - START"+
                            "<br>id="+id+
                            "<br>acturl="+acturl+
                            "<br>value="+value);

    $.post(acturl,
        {
            elementid: id,
            monatjahr: value
        },
        function(data){
                updateMonat(data);
        },
        'json'
    );

}

/**
 *
 */
function updateMonat(data){
    dny = new Array('Mo/Po','Di/Ut','Mi/St','Do/Ct','Fr/Pa','Sa/So','So/Ne');
    if(data.calendarinfo==null){
        // chyba v zadani datumu
        $('#monatPlanTable').html("Fehler in Datumeingabe / chyba v zadani datumu !");
        $('#'+data.elementid).focus().select();
    }
    else{
//        $('#debuginfo').prepend("<br><b>ajaxUpdateInfo</b><br>"+data.toSource());
        // vykresleni kalendare pro zvoleny mesic
        calendarTable = "<table border='1' id='calendartable'>";

        // radek s nadpisama dnu
        calendarTable += "<tr>";
        $.each(dny,function(poradi,den){
            if(poradi==5 || poradi==6)
                vikendclass='vikend';
            else
                vikendclass='';
            calendarTable += "<td class='"+vikendclass+"'>"+den+"</td>";
        });
        calendarTable += "</tr>";

        // zjistim na kterem dnu v tydnu budu zacinat
        prvniDenVTydnu = data.calendarinfo[0].cislodne
        denVTydnu = 1;
        // na prvnim radku kalendare se posunu na spravny den v tydnu
        calendarTable += "<tr>";
        while(denVTydnu<prvniDenVTydnu){
            calendarTable += "<td>&nbsp;</td>";
            denVTydnu++;
        }

        lastdatum = '';
        // a zacinam projizdet data z calendarinfo
        $.each(data.calendarinfo,function(poradi,info){

            if(info.cislodne==6 || info.cislodne==7)
                vikendclass='vikend';
            else
                vikendclass='';

            if(info.datum!=lastdatum){
                // ukoncim bunku
                calendarTable += "</td>";
                denVTydnu++;
            }

            if(info.datum!=lastdatum){
                // zacnu novou bunku
                calendarTable += "<td class='"+vikendclass+"'>";
                den = info.datum.substr(8,2);
                calendarTable += "<div class='datuminfobox'>"+den+".</div>";
            }

            
            calendarTable += "<div>";
            // svatek
            svatek_id = "svatek_"+info.datum;
            checked = '';
            if(info.svatek!=0) checked = 'checked="checked"';

            svatek_input = 'feiertag/svatek<input type="checkbox" id="'+svatek_id+'" '+checked+' acturl="'+data.ajaxurl_svatek+'" />';
            calendarTable += svatek_input;
            calendarTable += '</div>';
            
            //guss
            calendarTable += '<div>';

            calendarTable+= '<h6 class="abteilungguss">Guss</h6>'
            id = 'von_f_guss_'+info.datum;
            value = info.von_f_guss==null?'':info.von_f_guss.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'von:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/>';
            calendarTable += input;

            id = 'bis_f_guss_'+info.datum;
            value = info.bis_f_guss==null?'':info.bis_f_guss.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'bis:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/><br>';
            calendarTable += input;

            id = 'von_s_guss_'+info.datum;
            value = info.von_s_guss==null?'':info.von_s_guss.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'von:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/>';
            calendarTable += input;
            
            id = 'bis_s_guss_'+info.datum;
            value = info.bis_s_guss==null?'':info.bis_s_guss.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'bis:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/><br>';
            calendarTable += input;

            calendarTable+='</div>';
            
            //kemper
            calendarTable+='<div>';
            calendarTable+= '<h6 class="abteilungkemper">NE</h6>'
            id = 'von_f_ne_'+info.datum;
            value = info.von_f_ne==null?'':info.von_f_ne.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'von:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/>';
            calendarTable += input;

            id = 'bis_f_ne_'+info.datum;
            value = info.bis_f_ne==null?'':info.bis_f_ne.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'bis:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/><br>';
            calendarTable += input;

            id = 'von_s_ne_'+info.datum;
            value = info.von_s_ne==null?'':info.von_s_ne.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'von:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/>';
            calendarTable += input;

            id = 'bis_s_ne_'+info.datum;
            value = info.bis_s_ne==null?'':info.bis_s_ne.substr(0, 5);
            acturl = data.ajaxurl_vonbisinput;
            input = 'bis:<input type="text" size ="5" maxlength="5"';
            input+= ' id="'+id+'"';
            input+= ' value="'+value+'"';
            input+= ' acturl="'+acturl+'"';
            input+= '/><br>';
            calendarTable += input;

            calendarTable += '</div>';

            calendarTable += "</div>";

            if(denVTydnu%7 == 1){
                //vytvorit novy radek
                calendarTable += "</tr><tr>";
            }

            lastdatum = info.datum;
        });

        // ukoncim posledni radek
        calendarTable += "</tr>";
        calendarTable += "</table>";

        $('#monatPlanTable').html(calendarTable);

        // priradit ajax rutiny
        $('input:checkbox').click(ajaxHandlerSvatek);
        $('#monatPlanTable input:text').change(ajaxHandlerVonBis);
    }
}


function ajaxHandlerVonBis(event){
    var id = $(this).attr('id');
    var value = $(this).val();

    $.post(acturl,
        {
            elementid: id,
            value: $(this).val()
        },
        function(data){
                ajaxUpdateVonBis(data);
        },
        'json'
    );
}

/**
 *
 */
//function ajaxHandlerInput(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $(this).val();
//    var monatjahr = $('#monatjahr').val();
//    var persnr = $('#persnr').val();
//
//    js_validate_float(this);
//
//    $('#debuginfo').append( "<br>onchange - START"+
//                            "<br>id="+id+
//                            "<br>acturl="+acturl+
//                            "<br>value="+value);
//
//    $.post(acturl,
//        {
//            elementid: id,
//            value: $(this).val(),
//            monatjahr: monatjahr,
//            persnr: persnr
//        },
//        function(data){
//                ajaxUpdateInfo(data);
//        },
//        'json'
//    );
//}


/**
 *
 */
//function getStrSelect(idAndName,optionsarray,selectedoption,ajaxurl){
//
//    name = " name='"+idAndName+"'";
//    id = " id='"+idAndName+"'";
//    aurl = " acturl='"+ajaxurl+"'";
//
//    retez = "<select"+name+id+aurl+">";
//    $.each(optionsarray,function(poradi,opt){
//        option = "<option ";
//        optionValue = " value='"+opt.tat+"'";
//        option += optionValue;
//        if(opt.tat==selectedoption)
//            option += "selected='selected'";
//        option += ">"+opt.tat;
//        option += "</option>";
//        retez += option;
//    });
//    retez+= "</select>";
//    return retez;
//}


function ajaxUpdateVonBis(data){
//    ajaxUpdateInfo(data);
    var elementid = data.elementid;
    var hhmm = data.hhmm;

    if(hhmm=='null') hhmm = '';
    $('#'+elementid).val(hhmm);
}

function updateSvatek(data){
    ajaxUpdateInfo(data);
}

/**
 *
 */
function ajaxUpdateInfo(data){
    $('#debuginfo').prepend("<br><b>ajaxUpdateInfo</b><br>"+data.toSource());
    if(data.field=="oe")
        $('#stunden_'+data.id).val(data.stunden).select();

    if(data.planstunden!=null)
        $('#planstundenvalue').text(data.planstunden);

    if(data.plusminusstunden!=null)
        $('#plusminusstundenvalue').text(data.plusminusstunden.plusminusstunden);
}

/**
 *
 */
function updateFillvonbis(data){
    $('#debuginfo').prepend("<br><b>ajaxUpdateInfo</b><br>"+data.toSource());
    var id = $('#monatjahr').attr('id');
    var acturl = $('#monatjahr').attr('acturl');
    var value = $('#monatjahr').val();
    $.post(acturl,
        {
            elementid: id,
            monatjahr: value
        },
        function(data){
                updateMonat(data);
        },
        'json'
    );
}