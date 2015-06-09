
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){

$('#frmpersinfo-persnr').change(function(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();
        $.post(acturl,
        {
            persnr: $(this).val()
        },
        function(data){
                updateValidatePersnr(data);
        },
        'json'
    );
});

$('#frmpersinfo-persnr').focus(function(event){
    this.select();
});

$('#frmpersinfo-persnr').focus();


// persnr get focus and selection on page load
$('input#persnr').focus(function(event){
    this.select();
});
$('input#persnr').focus();

$('input#regelarbzeit').val('');

$('input#regelarbzeit').change(function(event){

    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    js_validate_float(this);
    $.post(acturl,
        {
            elementid: id,
            persnr: $('#persnr').val(),
            regelarbzeit: value
        },
        function(data){
                updateRegelarbzeit(data);
        },
        'json'
    );
});


$('a#saveursprunglink').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var datum = $('#monatjahr').val();


        $.post(acturl,
        {
            monatjahr: datum,
            run:1
        },
        function(data){
            updateSaveursprung(data);
        },
        'json'
        );
        return false;
});

$('a#fillMonatPlanlink').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var datum = $('#monatjahr').val();

        $.post(acturl,
        {
            monatjahr: datum
        },
        function(data){
            updateFillMonatPlan(data);
        },
        'json'
        );
        return false;
});


$('input#stdsolldatum').val('');

$('input#stdsolldatum').change(function(event){

    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    js_validate_float(this);
    $.post(acturl,
        {
            elementid: id,
            persnr: $('#persnr').val(),
            stdsolldatum: value
        },
        function(data){
                updateStdsolldatum(data);
        },
        'json'
    );
});

// ajax handling for persnr
$('input#persnr').blur(function(event){

    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();


    $.post(acturl,
        {
            elementid: id,
            persnr: $(this).val()
        },
        function(data){
                updatePersNrInfo(data);
        },
        'json'
    );
});


// ajax handling for monatjahr
$('input#monatjahr').blur(ajaxHandlerMonatJahr);

//ajax handling for regeloeselect
$('#regeloeselect').change(ajaxHandlerRegelOESelect);


});


function ajaxHandlerRegelOESelect(event){

    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();
    var persnr = $('#persnr').val();


    $.post(acturl,
        {
            value: value,
            personal: persnr
        },
        function(data){
                ajaxUpdateInfo(data);
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
    var persnr = $('#persnr').val();

    $('#debuginfo').prepend( "<br>ajaxHandlerMonatJahr blur"+
                            "<br>id="+id+
                            "<br>acturl="+acturl+
                            "<br>persnr="+persnr+
                            "<br>value="+value);

    $.post(acturl,
        {
            elementid: id,
            persnr: persnr,
            monatjahr: value
        },
        function(data){
                            $('#debuginfo').prepend( "<br>monatjahr blur / navratova ajax funkce, pred vyvolanim updateMonat"+
                            "<br>id="+id+
                            "<br>acturl="+acturl+
                            "<br>persnr="+persnr+
                            "<br>value="+value);

                updateMonat(data);
                $('#debuginfo').prepend( "<br>po vyvolani updateMonat");
        },
        'json'
    );
}


function updateSaveursprung(data){
    odpoved = 0;
    if(data.datumok==1){
        if(data.hasdata==1){
            // v tabulce uz mam data, zeptam se uzivatele
            odpoved = confirm("Uz mam nejaka data. Smazat a prepsat novymi ?");
        }
        else
            odpoved = 1;
    }
    if(odpoved==1){
        // uzivatel opravdu chce zapsat data
        var acturl = data.acturl2;
        $.post(acturl,
        {
            monatjahr: '',
            monat: data.monat,
            jahr: data.jahr,
            run:2
        },
        function(data){
            updateSaveursprung2(data);
        },
        'json'
        );
    }
}

function updateFillMonatPlan(data){
    $('#debuginfo').html(data.toSource());
    alert('Fuer Jahr:'+data.jahr+' und Monat: '+data.monat+' haben '+data.planinfocount+' Personen Planinfo gefuellt.');
}

function updateSaveursprung2(data){
    $('#debuginfo').html('Vom Dzeitsoll nach dzeitsoll2 wurden '+data.savedpositionen+' Zeilen gespeichert'+'<br>');
}


/**
 *
 */
function updateMonat(data){
    dny = new Array('Mo/Po','Di/Ut','Mi/St','Do/Ct','Fr/Pa','Sa/So','So/Ne');

    if(data.setmonatjahr==1){
        $('#debuginfo').prepend(data.toSource()+'<br>');
    }else if(data.planinfo==null){
        // chyba v zadani datumu
        $('#monatPlanTable').html("Fehler in Datumeingabe / chyba v zadani datumu !");
        $('#'+data.elementid).focus().select();
    }
    else{
        $('#debuginfo').prepend(data.plusminusstunden.toSource()+'<br>');
//        $('#stdsolldatum').text(data.stdsolldatum);
        //pocet pracovnich dnu
        $('#arbtagevalue').text(data.sollstundenlautcalendar.arbtage);
        $('#sollstundenvalue').text(data.sollstundenlautcalendar.sollstunden);
        $('#urlaubrestbisvalue').text(data.urlaubrestbis);
        $('#urlaubrestvalue').text(data.urlaubinfo.rest);
        $('#plusminusstundenvalue').text(data.plusminusstunden.plusminusstunden);
        
        if(data.istanwesenheit!=null)
            $('#istanwesenheitvalue').text(data.istanwesenheit);
        else
            $('#istanwesenheitvalue').text('');

        if(data.planstunden!=null)
            $('#planstundenvalue').text(data.planstunden);
        else
            $('#planstundenvalue').text('');

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
        prvniDenVTydnu = data.planinfo[0].cislodne
        denVTydnu = 1;
        // na prvnim radku kalendare se posunu na spravny den v tydnu
        calendarTable += "<tr>";
        while(denVTydnu<prvniDenVTydnu){
            calendarTable += "<td>&nbsp;</td>";
            denVTydnu++;
        }

        lastdatum = '';
        // a zacinam projizdet data z planinfo
        $.each(data.planinfo,function(poradi,info){

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
            // oe select
            oe_id = "oe_"+info.id;
            oe_select = getStrSelect(oe_id,data.oelist,info.oe,data.ajaxurl_select);
            calendarTable += oe_select;

            // stunden input
            stunden_id = "stunden_"+info.id;
            stunden_input_name = " name='"+stunden_id+"'";
            stunden_input_id = " id='"+stunden_id+"'";
            stunden_input_value = " value='"+info.stunden+"'";
            stunden_input_acturl = " acturl='"+data.ajaxurl_input+"'";

            stunden_input = "<input type='text' size='2' maxlength='4' "
                            + stunden_input_name
                            + stunden_input_id
                            + stunden_input_value
                            + stunden_input_acturl
                            + "/>"

            calendarTable += stunden_input;

            newdatum_id = "newdatum_"+info.id;
            newdatumbutton_id = " id='"+newdatum_id+"'";
            newdatumbutton_acturl = " acturl='"+data.ajaxurl_newdatumbutton+"'";

            newdatumbutton = "<input type='button' value='+'"
                            + newdatumbutton_id
                            + newdatumbutton_acturl
                            + "/>";

            calendarTable += newdatumbutton;

            delete_id = "delete_"+info.id;
            deletebutton_id = " id='"+delete_id+"'";
            deletebutton_acturl = " acturl='"+data.ajaxurl_deletebutton+"'";

            deletebutton = "<input type='button' value='-'"
                            + deletebutton_id
                            + deletebutton_acturl
                            + "/>";


            calendarTable += deletebutton;
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
        // 1. pro selecty
        $('#monatPlanTable select').change(ajaxHandlerSelect);
        // 2. inputy
        $('#monatPlanTable input:text').blur(ajaxHandlerInput);
        $('#monatPlanTable input:text').focus(function(){
           this.select();
        });
        // 3. newdatumbutton a deletebutton
        $('#monatPlanTable input:button').click(ajaxHandlerNewdatumButton);
    }
}

/**
 *
 */
function ajaxHandlerNewdatumButton(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    $.post(acturl,
        {
            elementid: id
        },
        function(data){
                ajaxUpdateInfo(data);
                $('input#monatjahr').blur();
                var id = $('input#monatjahr').attr('id');
                var acturl = $('input#monatjahr').attr('acturl');
                var value = $('input#monatjahr').val();
                var persnr = $('#persnr').val();

                $.post(acturl,
                    {
                        elementid: id,
                        persnr: persnr,
                        monatjahr: value
                    },
                    function(data){
                        updateMonat(data);
                    },
                        'json'
                );
        },
        'json'
    );

}


/**
 *
 */
function ajaxHandlerInput(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();
    var monatjahr = $('#monatjahr').val();
    var persnr = $('#persnr').val();

    js_validate_float(this);
    
    $.post(acturl,
        {
            elementid: id,
            value: $(this).val(),
            monatjahr: monatjahr,
            persnr: persnr
        },
        function(data){
                ajaxUpdateInfo(data);
        },
        'json'
    );
}

/**
 *
 */
function ajaxHandlerSelect(event){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    $.post(acturl,
        {
            elementid: id,
            value: $(this).val(),
            monatjahr : $('#monatjahr').val(),
            persnr : $('#persnr').val()
        },
        function(data){
                ajaxUpdateInfo(data);
        },
        'json'
    );
}

/**
 *
 */
function getStrSelect(idAndName,optionsarray,selectedoption,ajaxurl){

    name = " name='"+idAndName+"'";
    id = " id='"+idAndName+"'";
    aurl = " acturl='"+ajaxurl+"'";

    retez = "<select"+name+id+aurl+">";
    $.each(optionsarray,function(poradi,opt){
        option = "<option ";
        optionValue = " value='"+opt.tat+"'";
        option += optionValue;
        if(opt.tat==selectedoption)
            option += "selected='selected'";
        option += ">"+opt.tat;
        option += "</option>";
        retez += option;
    });
    retez+= "</select>";
    return retez;
}

/**
 *
 */
function ajaxUpdateInfo(data){
    $('#debuginfo').prepend("<br><b>ajaxUpdateInfo</b><br>"+data.toSource());

    if(data.field=="oe")
        {
            $('#stunden_'+data.id).val(data.stunden).select();
            // musim pouzit primo DOM objekt, proto puziju get(0), jQuery totiz vraci pole
            $('#stunden_'+data.id).get(0).select();
        }

    if(data.planstunden!=null)
        $('#planstundenvalue').text(data.planstunden);

    if(data.plusminusstunden!=null)
        $('#plusminusstundenvalue').text(data.plusminusstunden.plusminusstunden);
}


function updateRegelarbzeit(data){
    $('#sollstundenvalue').text(data.sollstunden);
    $('#debuginfo').prepend("<br>"+data.toSource());
}


function updateStdsolldatum(data){
//    $('#stdsolldatum').text(data.sollstunden);
    $('#debuginfo').prepend("<br>"+data.toSource());
}

//function updateNameSuchen(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
//    if(data.persnrcount>1){
//        var buttonOffset = $(this).offset();
//        buttonOffset.left += $(this).outerWidth();
//        if($('#persnrauswaehlen').length!=0) $('#persnrauswaehlen').remove();
//        $(data.infodiv).appendTo('body');
//        $('#persnrauswaehlen').css({"left":buttonOffset.left+"px"});
//        $('#persnrauswaehlen').css({"top":buttonOffset.top+"px"});
//        }
//
//    }


function updateValidatePersnr(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    if(data.persinfo!=null){
        //$('div.persid').html('validace persnr');
        if(data.form!=null){
            $.each(data.form, function(name,control){
                if(control.attrs.type=='text')
                    $('#'+control.attrs.id).val(control.attrs.value);
                if(control.attrs.type=='checkbox')
                    $('#'+control.attrs.id).attr('checked',control.attrs.checked);
            });
        }
    }
}
/**
 *
 */
function updatePersNrInfo(data){
    if(data.persinfo!=null){
        name = data.persinfo.name;
        vorname = data.persinfo.vorname;
        trida = 'persinfo';
        regelarbzeit = data.persinfo.regelarbzeit;
        stdsolldatum = data.persinfo.stdsoll_datum;
        $('#regeloeselect').attr('disabled','');
        if(data.persinfo.regeloe==null)
            $('#regeloeselect').val('-');
        else
            $('#regeloeselect').val(data.persinfo.regeloe);
    }
    else{
        //$('#'+data.elementid).focus().select();
        name = 'unbekannte PersNr / nezname osobni cislo';
        vorname = '';
        trida = 'validateerror';
        $('#regeloeselect').attr('disabled','disabled');
    }

    if(data.persinfo!=null){
        $('#nameinfo').html("Name : "+vorname+" "+name).css(trida);
        $('#regelarbzeit').val(regelarbzeit);
        $('#stdsolldatum').val(stdsolldatum);
    }
    else{
        $('#nameinfo').html("Name : "+vorname+" "+name).css(trida);
        el = $('#'+data.elementid).get(0);
        el.focus();
        el.select();
    }

}
