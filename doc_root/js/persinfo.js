
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){


	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	$('#varTable').hide();
	$('#varHelp').click(function(){
	    $('#varTable').toggle();
	});
	$("table.template_var_table input:input[id^=val_]").css({"background-color":"lightgreen","font-weight":"bold"});
	//On Click Event
	$("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab_content").hide(); //Hide all tab content

        if($('#essen_table').length!=0){
            $('#essen_table').remove();
        }

        if($('#vorschuss_table').length!=0){
            $('#vorschuss_table').remove();
        }

        if($('#dpersstempel_table').length!=0){
            $('#dpersstempel_table').remove();
        }

        if($('#transport_table').length!=0){
            $('#transport_table').remove();
        }

        if($('#anwesenheit_table').length!=0){
            $('#anwesenheit_table').remove();
        }

        if($('#sonstpremie_table').length!=0){
            $('#sonstpremie_table').remove();
        }

        if($('#abmahnung_table').length!=0){
            $('#abmahnung_table').remove();
        }

        if($('#faehigkeiten_table').length!=0){
            $('#faehigkeiten_table').remove();
        }
        if($('#verletzung_table').length!=0){
            $('#verletzung_table').remove();
        }
        if($('#vertrag_table').length!=0){
            $('#vertrag_table').remove();
        }

        if($('#persnrauswaehlen').length!=0){
            $('#persnrauswaehlen').remove();
        }

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(activeTab).fadeIn('fast'); //Fade in the active ID content
        //$(activeTab).show('fast'); //Fade in the active ID content
        return false;
    });


    $('#bewerberformular').hide();
    //$('#frmpersinfo-bt_bewerberform_show').hide();




    $('#frmpersinfo-bt_persnrkopieren').click(bt_persnrkopierenClick);
    $('#frmpersinfo-bt_persnrdelete').click(bt_persnrdeleteClick);

    $('#makePersDoku').click(makePersDoku);

    $('#frmpersinfo-bt_bewerberform_show').click(function(){
        // pokud je formular viditelny, tak ho schovam, pokud neni, tak ho zobrazim
        if($('#bewerberformular').is(":visible")){
            $('#bewerberformular').hide();
        }
        else{
            // na pozadi si vytahnu informace z tabulky dbewerber pro aktualniho persnr
            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var persnr = $('#frmpersinfo-persnr').val();
            $.post(acturl,
            {
                id:id,
                persnr: persnr
            },
            function(data){
                updateValidatePersnrBewerberForm(data);
            },
            'json'
            );

            $('#bewerberformular').show();
        }
    });


    //kdyz a_premie neni checked tak zakazu a_premie_st
    if(!$('#frmpersinfo-a_praemie').attr('checked')){
	$('#frmpersinfo-a_praemie_st').attr('disabled','disabled');
    }

    // zobrazit tlacitko pro bewerbeformular jen v pripade ze dpersstatus u persnr je roven BEWERBER
    dpersstatus = $('#frmpersinfo-dpersstatus').val();
    if(dpersstatus=='BEWERBER'){
        $('#frmpersinfo-bt_bewerberform_show').show();
    }

//--------------------------------------------------------------------------------------------------
//bewerber formular

    $('#frmpersinfo-bewerb_datum').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewerbe_datum',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });


//    $('#frmpersinfo-aufenthaltsort').change(function(event){
//        var id = $(this).attr('id');
//        var acturl = $(this).attr('acturl');
//        var value = $(this).val();
//        $.post(acturl,
//        {
//            id:id,
//            persnr: $('#frmpersinfo-persnr').val(),
//            field: 'aufenthalts_ort',
//            value: $(this).val()
//        },
//        function(data){
//            updateUpdateDpersField(data);
//        },
//        'json'
//        );
//    });

    $('#frmpersinfo-staats_angehoerigkeit_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'staats_angehoerigkeit_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-transport_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'transport_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-eigen_transport_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'eigen_transport_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-geeignet_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'geeignet_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-info_vom_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'info_vom_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-beendet_recht_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'beendet_recht_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-beendet_real_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'beendet_real_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-nicht_eingetretten_grund_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'nicht_eingetretten_grund_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-bew_geeignet_aktual_id').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bew_geeignet_aktual_id',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-bewertung1').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung1',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-bewertung2').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung2',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-bewertung3').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung3',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-oe_voraussichtlich').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'oe_voraussichtlich',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-bewertung_bemerkung').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung_bemerkung',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-uebergang').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'uebergang',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-eintritt_datum').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'eintritt_datum',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-aktual_info_bemerkung').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'aktual_info_bemerkung',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-nicht_eingetreten_grund').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'nicht_eingetreten_grund',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-bemerkung_sonst').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bemerkung_sonst',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-info_vom').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'info_vom',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-erledigt').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'erledigt',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-abydos_agentur').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'abydos_agentur',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-arbamt_evidenz').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'arbamt_evidenz',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-vom_arb_amt_gekommen').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'vom_arb_amt_gekommen',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-gestraft').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'gestraft',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-exekution').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'exekution',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-vertragb').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'vertrag',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-artzt_eingang_untersuchung').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'artzt_eingang_untersuchung',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-schuhe_groesse').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'schuhe_groesse',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-berufskrankheit_gefahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'berufskrankheit_gefahr',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-lehrer').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'lehrer',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-meister').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'meister',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-bewertung_schul_schicht').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung_schul_schicht',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-wettbewerb_1000_CZK').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'wettbewerb_1000_CZK',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-artzt_ausgang').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'artzt_ausgang',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-beendet_vom').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'beendet_vom',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-leistung_bewertung').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'leistung_bewertung',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-stunden_durchschnitt').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'stunden_durchschnitt',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-ausgang_bemerkung').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'ausgang_bemerkung',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

//---------------------------------------------------------------------------------------------------

    $('#frmpersinfo-persnr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');
        $.post(acturl,
        {
            id:id,
            persnr: $(this).val(),
            nurActiveMA: activeMA
        },
        function(data){
            updateValidatePersnr(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-namesuchen').keyup(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');

        if(value.length>=2){
            $.post(
                    acturl,
                    {
                        id:id,
                        name: $(this).val(),
                        nurActiveMA: activeMA
                    },
                    function(data){
                        updateNameSuchen(data);
                    },
                    'json'
            );
        }
        else if(value.length<2 && $('#persnrauswaehlen').length!=0)
            $('#persnrauswaehlen').remove();
    });

    $('#frmpersinfo-name').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'name',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-gebort').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'gebort',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-vorname').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'vorname',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-abkrz').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'abkrz',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-tf_eintrittsdatum').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'eintritt',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-tf_austritt').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'austritt',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-tf_geboren').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'geboren',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-dobaurcita').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'dobaurcita',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-zkusebni_doba_dobaurcita').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'zkusebni_doba_dobaurcita',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersDatumField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-tf_ort').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'komm_ort',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-strasse').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'strasse',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-schrank').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'kasten',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-kfz_rz').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'kfz_rz',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-umkleidenr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'umkleidenr',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-schuhe').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'schuhegroesse',
            value: $(this).val()
        },
        
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

        $('#frmpersinfo-strasse_op').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'strasse_op',
            value: $(this).val()
        },

        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

        $('#frmpersinfo-ort_op').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'ort_op',
            value: $(this).val()
        },

        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

        $('#frmpersinfo-plz_op').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'plz_op',
            value: $(this).val()
        },

        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
        $('#frmpersinfo-plz').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'plz',
            value: $(this).val()
        },

        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
$('#frmpersinfo-tf_handy').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'kom7',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-tf_email').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'email',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-schicht').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'schicht',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-einsatzschicht').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'einsatzschicht',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-regelarbeit').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'regelarbzeit',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-regeltrans').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'regeltrans',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });


    $('#frmpersinfo-cb_regeloe').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'regeloe',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-cb_auto_leistung_abgnr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'auto_leistung_abgnr',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });


    $('#frmpersinfo-dpersstatus').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'dpersstatus',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
            //povolit-zobrazit tlacitko pro zobrazeni bewerber formulare
            // zobrazit tlacitko pro bewerbeformular jen v pripade ze dpersstatus u persnr je roven BEWERBER
            dpersstatus = $('#frmpersinfo-dpersstatus').val();
            if(dpersstatus=='BEWERBER'){
                $('#frmpersinfo-bt_bewerberform_show').show();
            }
            else{
                $('#frmpersinfo-bt_bewerberform_show').hide();
            }
        },
        'json'
        );
    });

$('#frmpersinfo-cb_alteroe').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'alteroe',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-autoleistung').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'auto_leistung',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-kor').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'kor',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-premie_za_vykon').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'premie_za_vykon',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

        $('#frmpersinfo-vertragb').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'vertrag',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-qpremie_akkord').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'qpremie_akkord',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-qpremie_zeit').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'qpremie_zeit',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-premie_za_prasnost').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'premie_za_prasnost',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-premie_za_3_mesice').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'premie_za_3_mesice',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-bewertung').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'bewertung',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-MAStunden').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'MAStunden',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-a_praemie').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
	
	if(value==0){
	    //st premie musi byt take 0 a navic checkbox zakazu
	    $('#frmpersinfo-a_praemie_st').attr('checked','');
	    $.post(acturl,
	    {
		id:'#frmpersinfo-a_praemie_st',
		persnr: $('#frmpersinfo-persnr').val(),
		field: 'a_praemie_st',
		value: 0
	    },
	    function(data){
                updateUpdateDpersField(data);
            },
            'json'
            );
	    //a zakazat
	    $('#frmpersinfo-a_praemie_st').attr('disabled','disabled');
	}
	else{
	    $('#frmpersinfo-a_praemie_st').attr('disabled','');
	}
	
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'a_praemie',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    
    $('#frmpersinfo-a_praemie_st').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'a_praemie_st',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-einarb_zuschlag').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).attr('checked')?1:0;
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'einarb_zuschlag',
            value: value
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-jahranspruch').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'jahranspruch',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-rest').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'rest',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-gekrzt').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float_real(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'gekrzt',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-lohnfaktor').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'lohnfaktor',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-leistfaktor').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'leistfaktor',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-anwvzkd_faktor').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        js_validate_float(this);
        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            field: 'anwvzkd_faktor',
            value: $(this).val()
        },
        function(data){
            updateUpdateDpersField(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-nach_persnr').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            nurActiveMA: activeMA
        },
        function(data){
            updateUpdateVorNachPersnr(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-vor_persnr').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            nurActiveMA: activeMA
        },
        function(data){
            updateUpdateVorNachPersnr(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-dpersstempel').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#dpersstempel_table').length!=0){
            $('#dpersstempel_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateDpersStempel(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-vorschuss').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#vorschuss_table').length!=0){
            $('#vorschuss_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateVorschuss(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-essen').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#essen_table').length!=0){
            $('#essen_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateEssen(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-transport').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#transport_table').length!=0){
            $('#transport_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateTransport(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-sonstpremie').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#sonstpremie_table').length!=0){
            $('#sonstpremie_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateSonstpremie(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-dperszuschlag').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#dperszuschlag_table').length!=0){
            $('#dperszuschlag_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateDpersZuschlag(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-abmahnung').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#abmahnung_table').length!=0){
            $('#abmahnung_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateAbmahnung(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-verletzung').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#verletzung_table').length!=0){
            $('#verletzung_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateVerletzung(data);
        },
        'json'
        );
    });
    $('#frmpersinfo-faehigkeiten').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#faehigkeiten_table').length!=0){
            $('#faehigkeiten_table').remove();
            if($('#schulungen_table').length!=0){
                $('#schulungen_table').remove();
            }
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateFaehigkeiten(data);
        },
        'json'
        );
    });

    $('#frmpersinfo-vertrag').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#vertrag_table').length!=0){
            $('#vertrag_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateVertrag(data);
        },
        'json'
        );
    });

$('#frmpersinfo-anwesenheit').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        // test jestli uz nemam tabulku otevrenou
        if($('#anwesenheit_table').length!=0){
            $('#anwesenheit_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val()
        },
        function(data){
            updateAnwesenheit(data);
        },
        'json'
        );
    });


    $('#frmpersinfo-persnr').focus(function(event){
        this.select();
    });

    $('#frmpersinfo-persnr').get(0).focus();
});


// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------

function updateAnwesenheit(data){

    //$('#debuginfo').prepend("<br>"+data.toSource());
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#anwesenheit_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#anwesenheit_table').css({
        "top":buttonOffset.top+"px"
    });

    $('[id^=anwesenheit_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateAnwesenheitDelete(data);
        },
        'json'
        );
    });

    // udalostni proceduru priradim jen pri otevreni divu

    $('#anwesenheit_zeitraum_jahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#anwesenheit_zeitraum_monat').val();
        var jahr = $('#anwesenheit_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateAnwesenheitZeitraumSet(data);
        },
        'json'
        );
    });

    $('#anwesenheit_zeitraum_monat').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#anwesenheit_zeitraum_monat').val();
        var jahr = $('#anwesenheit_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateAnwesenheitZeitraumSet(data);
        },
        'json'
        );
    });

    $('#anwesenheit_table select[id^=anwesenheit_oe_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var transport_id = $(this).attr('id');//radek.find('select').attr('id');
        var transport_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:transport_id,
            value:transport_value
        },
        function(data){
            updateAnwesenheitUpdate(data);
        },
        'json'
        );
    });

}

function updateTransport(data){

    //$('#debuginfo').prepend("<br>"+data.toSource());
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#transport_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#transport_table').css({
        "top":buttonOffset.top+"px"
    });
    $('#transport_table_close').click(function(event){
        $('#transport_table').remove();
        event.preventDefault();
    });

    $('#transport_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var datum = $('#transport_datum').val();
        var kfz_id = $('#transport_kfz_id').val();
        //var route_id = $('#transport_route_id').val();
        var preis = $('#transport_preis').val();
        var monat = $('#transport_zeitraum_monat').val();
        var jahr = $('#transport_zeitraum_jahr').val();
        var zurueck = $('#transport_zurueck').attr('checked')?1:0;

        js_validate_float($('#transport_preis').get(0));

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            datum:datum,
            kfz_id:kfz_id,
            //route_id:route_id,
            monat: monat,
            jahr: jahr,
            preis:$('#transport_preis').val(),
            zurueck:zurueck
        },
        function(data){
            updateTransportAdd(data);
        },
        'json'
        );
    });

    $('[id^=transport_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateTransportDelete(data);
        },
        'json'
        );
    });

    // udalostni proceduru priradim jen pri otevreni divu

    $('#transport_zeitraum_jahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#transport_zeitraum_monat').val();
        var jahr = $('#transport_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateTransportZeitraumSet(data);
        },
        'json'
        );
    });

    $('#transport_zeitraum_monat').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#transport_zeitraum_monat').val();
        var jahr = $('#transport_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateTransportZeitraumSet(data);
        },
        'json'
        );
    });

    $('#transport_table select[id^=transport_kfz_id_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var transport_id = $(this).attr('id');//radek.find('select').attr('id');
        var transport_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:transport_id,
            value:transport_value
        },
        function(data){
            updateTransportUpdate(data);
        },
        'json'
        );
    });

    $('#transport_table select[id^=transport_route_id_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var transport_id = $(this).attr('id');//radek.find('select').attr('id');
        var route_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:transport_id,
            value:route_value
        },
        function(data){
            updateTransportUpdate(data);
        },
        'json'
        );
    });

    $('#transport_table input[id^=transport_preis_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var transport_id = $(this).attr('id');//radek.find('select').attr('id');
        var preis_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        js_validate_float(this);
        $.post(acturl,
        {
            id:transport_id,
            value:$(this).val()
        },
        function(data){
            updateTransportUpdate(data);
        },
        'json'
        );
    });

    $('#transport_datum').get(0).focus();
    $('#transport_datum').get(0).select();

}

function updateDpersZuschlag(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    buttonOffset.left = 5;
    $('#dperszuschlag_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#dperszuschlag_table').css({
        "top":buttonOffset.top+"px"
    });


    $('#dperszuschlag_table input[id^=zs_]').change(function(event){
        var acturl = $(this).attr('acturl');

        if(js_validate_float_real(this)){
        $.post(acturl,
        {
            id:$(this).attr('id'),
            persnr: $('#frmpersinfo-persnr').val(),
            value: $(this).val()
        },
        function(data){
            updateSonstpremieUpdate(data);
        },
        'json'
        );
        }
    });

    if(data.arbtagezuschlagarray!=null){
        $('#dperszuschlag_table input').get(0).focus();
        $('#dperszuschlag_table input').get(0).select();
    }
}

function updateSonstpremie(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#sonstpremie_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#sonstpremie_table').css({
        "top":buttonOffset.top+"px"
    });


    $('#sonstpremie_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var datum = $('#sonstpremie_datum').val();
        var premie_id = $('#sonstpremie_premie_id').val();
        var betrag = $('#sonstpremie_betrag').val();
        var monat = $('#sonstpremie_zeitraum_monat').val();
        var jahr = $('#sonstpremie_zeitraum_jahr').val();

        js_validate_float_real($('#sonstpremie_betrag').get(0));

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            datum:datum,
            premie_id:premie_id,
            monat: monat,
            jahr: jahr,
            betrag:$('#sonstpremie_betrag').val()
        },
        function(data){
            updateSonstpremieAdd(data);
        },
        'json'
        );
    });

    $('[id^=sonstpremie_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateSonstpremieDelete(data);
        },
        'json'
        );
    });

    // udalostni proceduru priradim jen pri otevreni divu

    $('#sonstpremie_zeitraum_jahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#sonstpremie_zeitraum_monat').val();
        var jahr = $('#sonstpremie_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateSonstpremieZeitraumSet(data);
        },
        'json'
        );
    });

    $('#sonstpremie_zeitraum_monat').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#sonstpremie_zeitraum_monat').val();
        var jahr = $('#sonstpremie_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateSonstpremieZeitraumSet(data);
        },
        'json'
        );
    });

    $('#sonstpremie_table select[id^=sonstpremie_premie_id_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var premie_id = $(this).attr('id');//radek.find('select').attr('id');
        var premie_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:premie_id,
            value:premie_value
        },
        function(data){
            updateSonstpremieUpdate(data);
        },
        'json'
        );
    });
    
    $('#sonstpremie_table input[id^=sonstpremie_betrag_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var transport_id = $(this).attr('id');//radek.find('select').attr('id');
        var preis_value = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        js_validate_float_real(this);
        $.post(acturl,
        {
            id:transport_id,
            value:$(this).val()
        },
        function(data){
            updateSonstpremieUpdate(data);
        },
        'json'
        );
    });

    $('#sonstpremie_datum').get(0).focus();
    $('#sonstpremie_datum').get(0).select();

}

function updateAbmahnung(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#abmahnung_table').css({
        "left":"10px"
    });
    $('#abmahnung_table').css({
        "top":buttonOffset.top+"px"
    });


    $('#abmahnung_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var datum = $('#abmahnung_datum').val();
        var betragDatum = $('#abmahnung_datum_betrag').val();
        var grund = $('#abmahnung_grund').val();
        var betrag = $('#abmahnung_betrag').val();
	var reklamation = $('#abmahnung_reklamation').val();
	var vorschlag = $('#abmahnung1_vorschlag').attr('checked')?1:0;
	var vorschlag_von = $('#abmahnung1_vorschlag_von').val();
	var vorschlag_betrag = $('#abmahnung1_vorschlag_betrag').val();
	var vorschlag_bemerkung = $('#abmahnung1_vorschlag_bemerkung').val();
        var bemerkung = $('#abmahnung_bemerkung').val();
        var monat = $('#abmahnung_zeitraum_monat').val();
        var jahr = $('#abmahnung_zeitraum_jahr').val();

        js_validate_float_real($('#abmahnung_betrag').get(0));

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            datum:datum,
            datumBetrag:betragDatum,
            grund:grund,
	    reklamation:reklamation,
	    vorschlag:vorschlag,
	    vorschlag_von:vorschlag_von,
	    vorschlag_betrag:vorschlag_betrag,
	    vorschlag_bemerkung:vorschlag_bemerkung,
            monat: monat,
            jahr: jahr,
            betrag: $('#abmahnung_betrag').val(),
            bemerkung:bemerkung
        },
        function(data){
            updateAbmahnungAdd(data);
        },
        'json'
        );
    });

    $('[id^=abmahnung_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateAbmahnungDelete(data);
        },
        'json'
        );
    });

    // udalostni proceduru priradim jen pri otevreni divu

    $('#abmahnung_zeitraum_jahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#abmahnung_zeitraum_monat').val();
        var jahr = $('#abmahnung_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateAbmahnungZeitraumSet(data);
        },
        'json'
        );
    });

    $('#abmahnung_zeitraum_monat').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#abmahnung_zeitraum_monat').val();
        var jahr = $('#abmahnung_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateAbmahnungZeitraumSet(data);
        },
        'json'
        );
    });

    $('#abmahnung_table select[id^=abmahnung_grund_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var grund = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:abmahnung_id,
            value:grund
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });

    $('#abmahnung_table select[id^=abmahnung_reklamation_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var reklamation = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:abmahnung_id,
            value:reklamation
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });
    
    $('#abmahnung_table input[id^=abmahnung_betrag_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var betrag = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        js_validate_float_real(this);
        $.post(acturl,
        {
            id: abmahnung_id,
            value: $(this).val()
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });
    
    $('#abmahnung_table input[id^=abmahnungcb_vorschlag_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var acturl = $(this).attr('acturl');
	
	$(this).attr('checked')?1:0;

        js_validate_float_real(this);
        $.post(acturl,
        {
            id: abmahnung_id,
            value: $(this).attr('checked')?1:0
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });
    
        $('#abmahnung_table input[id^=abmahnung_vorschlag_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var acturl = $(this).attr('acturl');
	
        $.post(acturl,
        {
            id: abmahnung_id,
            value: $(this).val()
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });

    $('#abmahnung_table input[id^=abmahnung_datum_betrag_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var datum = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        //js_validate_float_real(this);
        $.post(acturl,
        {
            id: abmahnung_id,
            value: $(this).val()
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });

    $('#abmahnung_table input[id^=abmahnung_bemerkung_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var abmahnung_id = $(this).attr('id');//radek.find('select').attr('id');
        var betrag = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        //js_validate_float_real(this);
        $.post(acturl,
        {
            id: abmahnung_id,
            value: $(this).val()
        },
        function(data){
            updateAbmahnungUpdate(data);
        },
        'json'
        );
    });
    $('#abmahnung_datum').get(0).focus();
    $('#abmahnung_datum').get(0).select();

}
function updateVerletzung(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#verletzung_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#verletzung_table').css({
        "top":buttonOffset.top+"px"
    });


    $('#verletzung_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var datum = $('#verletzung_datum').val();
        var grund = $('#verletzung_grund').val();
        var monat = $('#verletzung_zeitraum_monat').val();
        var jahr = $('#verletzung_zeitraum_jahr').val();

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            datum:datum,
            grund:grund,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateVerletzungAdd(data);
        },
        'json'
        );
    });

    $('[id^=verletzung_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateVerletzungDelete(data);
        },
        'json'
        );
    });

    $('#verletzung_table select[id^=verletzung_grund_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var verletzung_id = $(this).attr('id');//radek.find('select').attr('id');
        var grund = $(this).val();//radek.find('select').val();
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:verletzung_id,
            value:grund
        },
        function(data){
            updateVerletzungUpdate(data);
        },
        'json'
        );
    });

    $('#verletzung_datum').get(0).focus();
    $('#verletzung_datum').get(0).select();

}

function updateVertrag(data){
    var buttonOffset = $('#'+data.id).offset();

    var left = buttonOffset.left-600;
    var top = buttonOffset.top+$('#'+data.id).outerHeight();;
    $(data.divcontent).appendTo('body');
    left = 10;
    $('#vertrag_table').css({
        "left":left+"px"
    });
    $('#vertrag_table').css({
        "top":top+"px"
    });

    $('#vertrag_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var eintritt = $('#vertrag_dat_eintritt').val();
        var austritt = $('#vertrag_dat_austritt').val();
        var probezeit = $('#vertrag_dat_probezeit').val();
        var befristet = $('#vertrag_dat_befristet').val();
        var regelstunden = $('#vertrag_regelstunden').val();
	var vertragtypid = $('#vertragtypid').val();
        var vertrag_anfang = $('#vertrag_vertraganfang').attr('checked')?1:0;
        var verlang = $('#vertrag_verlang').attr('checked')?1:0;


        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            eintritt:eintritt,
            austritt:austritt,
            probezeit: probezeit,
            befristet: befristet,
            regelstunden: regelstunden,
            vertrag_anfang: vertrag_anfang,
            verlang: verlang,
	    vertragtypid: vertragtypid
        },
        function(data){
            updateVertragAdd(data);
        },
        'json'
        );

    });

  $('[id^=vertrag_del_]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateVertragDelete(data);
        },
        'json'
        );
    });

    $('[id^=vertrag_i_]').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id,
            value:$(this).val()
        },
        function(data){
            updateVertragUpdate(data);
        },
        'json'
        );
    });

    $('[id^=vertragtypid_]').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id,
            value:$(this).val()
        },
        function(data){
            updateVertragUpdate(data);
        },
        'json'
        );
    });

        $('[id^=vertrag_cb_vertraganfang]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id,
            value:$(this).attr('checked')?1:0
        },
        function(data){
            updateVertragUpdate(data);
        },
        'json'
        );
    });
}

function updateFaehigkeiten(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    var left = buttonOffset.left;//+$('#'+data.id).outerWidth();
    var top = buttonOffset.top+$('#'+data.id).outerHeight();;
    //alert('pred pripojenim tabulky,data.id='+data.id+'data.divcontent='+data.divcontent);
    $(data.divcontent).appendTo('body');
    $('#faehigkeiten_table').css({
        "left":left+"px"
    });
    $('#faehigkeiten_table').css({
        "top":top+"px"
    });
    //alert('po umisteni tabulky');
    $('#faehigkeiten_table input[id^=faehigkeit_sollist_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var faehigkeit_id = $(this).attr('id');//radek.find('select').attr('id');
        var acturl = $(this).attr('acturl');

        if(js_validate_float_between(this,-10,10)){
            $.post(acturl,
            {
                id: faehigkeit_id,
                value: $(this).val()
            },
            function(data){
                updateAbmahnungUpdate(data);
            },
            'json'
            );
        }
    });

    $('#faehigkeiten_table input[id^=faehigkeit_bemerkung_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var faehigkeit_id = $(this).attr('id');//radek.find('select').attr('id');
        var acturl = $(this).attr('acturl');

            $.post(acturl,
            {
                id: faehigkeit_id,
                value: $(this).val()
            },
            function(data){
                updateAbmahnungUpdate(data);
            },
            'json'
            );
    });

//
    $('#faehigkeit_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var soll = $('#faehigkeit_soll').val();
        var ist = $('#faehigkeit_ist').val();
        var bemerkung = $('#faehigkeit_bemerkung').val();
        var faehigkeit_id = $('#faehigkeit_faehigkeit').val();
        var faehigkeit_faehigkeittyp_id = $('#faehigkeit_faehigkeittyp').val();

        if(js_validate_float_between($('#faehigkeit_soll').get(0), -10, 10) && js_validate_float_between($('#faehigkeit_ist').get(0), -10, 10)){
            $.post(acturl,
            {
                id:id,
                persnr:persnr,
                soll:soll,
                ist:ist,
                bemerkung: bemerkung,
                faehigkeit_faehigkeittyp_id: faehigkeit_faehigkeittyp_id,
                faehigkeit_id: faehigkeit_id
            },
            function(data){
                updateFaehigkeitAdd(data);
            },
            'json'
            );
        }
    });
//
    $('[id^=faehigkeit_delete_]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateFaehigkeitDelete(data);
        },
        'json'
        );
    });
    $('[id^=faehigkeit_schulungen_]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        if($('#schulungen_table').length!=0){
            $('#schulungen_table').remove();
            return;
        }

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateFaehigkeitenSchulungen(data);
        },
        'json'
        );
    });
//
    $('#faehigkeiten_table select[id^=faehigkeit_faehigkeittyp]').change(function(event){
        // zjistit hodnotu selectboxu
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:$(this).attr('id'),
            value:$(this).val()
        },
        function(data){
            updateFaehigkeitTypSelect(data);
        },
        'json'
        );
    });
//
//    $('#verletzung_datum').get(0).focus();
//    $('#verletzung_datum').get(0).select();

}
function updateEssen(data){

    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#essen_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#essen_table').css({
        "top":buttonOffset.top+"px"
    });
    $('#essen_table_close').click(function(event){
        $('#essen_table').remove();
        event.preventDefault();
    });

    // udalostni proceduru priradim jen pri otevreni divu essen
    
    $('#essen_zeitraum_jahr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#essen_zeitraum_monat').val();
        var jahr = $('#essen_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateEssenZeitraumSet(data);
        },
        'json'
        );
    });

    $('#essen_zeitraum_monat').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        var monat = $('#essen_zeitraum_monat').val();
        var jahr = $('#essen_zeitraum_jahr').val();


        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            value: value,
            monat: monat,
            jahr: jahr
        },
        function(data){
            updateEssenZeitraumSet(data);
        },
        'json'
        );
    });

    $('#essen_table input:checkbox').click(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var essen_id = radek.find('select').attr('id');
        var essen_value = radek.find('select').val();
        var essen = $(this).attr('checked')?1:0;
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:essen_id,
            essenId:essen_value,
            essen:essen
        },
        function(data){
            updateEssenUpdate(data);
        },
        'json'
        );
    });

    $('#essen_table select').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var essen_id = $(this).attr('id');//radek.find('select').attr('id');
        var essen_value = $(this).val();//radek.find('select').val();
        var essen = radek.find('input:checkbox').attr('checked')?1:0;//$(this).attr('checked')?1:0;
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:essen_id,
            essenId:essen_value,
            essen:essen
        },
        function(data){
            updateEssenUpdate(data);
        },
        'json'
        );
    });

}
function updateVorschuss(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#vorschuss_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#vorschuss_table').css({
        "top":buttonOffset.top+"px"
    });
    $('#vorschuss_table_close').click(function(event){
        $('#vorschuss_table').remove();
        event.preventDefault();
    });

    $('[id^=vorschuss_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateVorschussDelete(data);
        },
        'json'
        );
    });

    $('#vorschuss_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var vorschuss = $('#vorschuss_vorschuss').val();
        var datum = $('#vorschuss_datum').val();

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            vorschuss:vorschuss,
            datum:datum
        },
        function(data){
            updateVorschussAdd(data);
        },
        'json'
        );
    });
}

function updateEssenZeitraumSet(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#essen_table').length!=0){
        $('#essen_table').remove();
    }
    data.id = 'frmpersinfo-essen';
    updateEssen(data);
}

function updateTransportZeitraumSet(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#transport_table').length!=0){
        $('#transport_table').remove();
    }
    data.id = 'frmpersinfo-transport';
    updateTransport(data);
}

function updateSonstpremieZeitraumSet(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#sonstpremie_table').length!=0){
        $('#sonstpremie_table').remove();
    }
    data.id = 'frmpersinfo-sonstpremie';
    updateSonstpremie(data);
}

function updateAbmahnungZeitraumSet(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#abmahnung_table').length!=0){
        $('#abmahnung_table').remove();
    }
    data.id = 'frmpersinfo-abmahnung';
    updateAbmahnung(data);
}

function updateAnwesenheitZeitraumSet(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#anwesenheit_table').length!=0){
        $('#anwesenheit_table').remove();
    }
    data.id = 'frmpersinfo-anwesenheit';
    updateAnwesenheit(data);
}

function updateDpersStempel(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    buttonOffset.top += $('#'+data.id).outerHeight();
    
    $(data.divcontent).appendTo('body');
    $('#dpersstempel_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#dpersstempel_table').css({
        "top":buttonOffset.top+"px"
    });
    $('#dpersstempel_table_close').click(function(event){
        $('#dpersstempel_table').remove();
        event.preventDefault();
    });

    $('[id^=dpersstempel_delete]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        
        $.post(acturl,
        {
            id:id
        },
        function(data){
            updateDpersStempelDelete(data);
        },
        'json'
        );
    });

    $('#dpersstempel_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var persnr = $('#frmpersinfo-persnr').val();
        var oe = $('#dpersstempel_oe').val();
        var qpraemie_prozent = $('#dpersstempel_qpraemie_prozent').val();
        var stempel_id = $('#dpersstempel_stempel_id').val();
        var datum_von = $('#dpersstempel_datum_von').val();

        $.post(acturl,
        {
            id:id,
            persnr:persnr,
            oe:oe,
            qpraemie_prozent:qpraemie_prozent,
            stempel_id:stempel_id,
            datum_von:datum_von
        },
        function(data){
            updateDpersStempelAdd(data);
        },
        'json'
        );
    });
}


function updateDpersStempelAdd(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#dpersstempel_table').remove();
}

function updateTransportAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#transport_table').remove();
    data.id = 'frmpersinfo-transport';
    updateTransport(data);
}

function updateSonstpremieAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#sonstpremie_table').remove();
    data.id = 'frmpersinfo-sonstpremie';
    updateSonstpremie(data);
}

function updateAbmahnungAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#abmahnung_table').remove();
    data.id = 'frmpersinfo-abmahnung';
    updateAbmahnung(data);
}
function updateVerletzungAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#verletzung_table').remove();
    data.id = 'frmpersinfo-verletzung';
    updateVerletzung(data);
}


function updateFaehigkeitAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#faehigkeiten_table').remove();
    data.id = 'frmpersinfo-faehigkeiten';
    updateFaehigkeiten(data);
}

function updateVertragAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#vertrag_table').remove();
    data.id = 'frmpersinfo-vertrag';
    updateVertrag(data);
}

function updateSchulungAdd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    $('#schulungen_table').remove();
    //data.id = '';
    updateFaehigkeitenSchulungen(data);
}
function updateVorschussAdd(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#vorschuss_table').remove();
}

function updateEssenUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

function updateTransportUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

function updateSonstpremieUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

function updateFaehigkeitTypSelect(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    var options = '';
    var poradi = 0;
    $.each(data.faehigkeitenarray, function(index,row){
                if(poradi==0)
                    options += "<option selected='selected' value='"+row.id+"'>( "+row.faeh_abkrz+" ) "+row.beschreibung+"</option>";
                else
                    options += "<option value='"+row.id+"'>( "+row.faeh_abkrz+" ) "+row.beschreibung+"</option>";
                poradi++;
            });
    $('#faehigkeit_faehigkeit').html(options);
}

function updateAbmahnungUpdate(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
}
function updateVerletzungUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}
function updateVertragUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).val(data.validvalue);
}

function updateAnwesenheitUpdate(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

function updateDpersStempelDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#dpersstempelrow_'+data.dpersstempel_id).remove();
}

function updateVorschussDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#vorschussrow_'+data.vorschuss_id).remove();
}

function updateTransportDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#transportrow_'+data.transport_id).remove();
}

function updateSonstpremieDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#sonstpremierow_'+data.sonstpremie_id).remove();
}

function updateAbmahnungDelete(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#abmahnungrow_'+data.abmahnung_id).remove();
}

function updateVerletzungDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#verletzungrow_'+data.verletzung_id).remove();
}
function updateFaehigkeitDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#faehigkeitrow_'+data.faehigkeit_id).remove();
}

function updateVertragDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#vertragrow_'+data.vertrag_id).remove();
}

function updateSchulungDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#schulungrow_'+data.schulung_id).remove();
}

function updateAnwesenheitDelete(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    $('#'+data.id).parent().parent().css({
        'background-color':'red'
    });
    $('#anwesenheitrow_'+data.dzeit_id).remove();
}

function updateFaehigkeitenSchulungen(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    var left = buttonOffset.left-300;//-$('#'+data.id).outerWidth();
    var top = buttonOffset.top+$('#'+data.id).outerHeight();
    //alert('pred pripojenim tabulky,data.id='+data.id+'data.divcontent='+data.divcontent);
    $(data.divcontent).appendTo('body');
    $('#schulungen_table').css({
        "left":left+"px"
    });
    $('#schulungen_table').css({
        "top":top+"px"
    });

    $('#schulung_add').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var schulung_datum = $('#schulung_datum').val();
        var schulung_ergebniss = $('#schulung_ergebniss').val();

            $.post(acturl,
            {
                id: id,
                schulung_datum: schulung_datum,
                schulung_ergebniss: schulung_ergebniss
            },
            function(data){
                updateSchulungAdd(data);
            },
            'json'
            );
    });

        $('[id^=schulung_delete_]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');

            $.post(acturl,
            {
                id: id
            },
            function(data){
                updateSchulungDelete(data);
            },
            'json'
            );
    });

        $('#schulungen_table input[id^=schulung_ergebniss_]').change(function(event){
        // zjistit hodnotu selectboxu
        var radek = $(this).parent().parent();
        //radek.css({'background-color':'red'});
        var faehigkeit_id = $(this).attr('id');//radek.find('select').attr('id');
        var acturl = $(this).attr('acturl');

            $.post(acturl,
            {
                id: faehigkeit_id,
                value: $(this).val()
            },
            function(data){
                updateAbmahnungUpdate(data);
            },
            'json'
            );
    });

}

function updateUpdateVorNachPersnr(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    if(data.nextpersnr!=null){
        $('#frmpersinfo-persnr').val(data.nextpersnr);
        var id = 'frmpersinfo-persnr';
        var acturl = $('#frmpersinfo-persnr').attr('acturl');
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');

        $.post(acturl,
        {
            id:id,
            persnr: $('#frmpersinfo-persnr').val(),
            nurActiveMA: activeMA
        },
        function(data){
            updateValidatePersnr(data);
        },
        'json'
        );
    }
}

function updateUpdateDpersField(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

function updateUpdateDpersDatumField(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    if(data.datumvalue==null){
        $('#'+data.id).css({
            'background-color':'red'
        });
        $('#'+data.id).val('');
        $('#'+data.id).get(0).focus();
    }
    else{
        $('#'+data.id).css({
            'background-color':''
        });
        $('#'+data.id).val(data.datumvalue);
    }
}



function updateValidatePersnr(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
    if(data.redirect){
        // v pripade, ze mi vyprsi prihlaseni
        window.location.href = data.redirect;
    }

    if(data.persinfo!=null){
	$('#showPath').html(data.showPath);
	$('#doklady_table_div').html(data.dokumentyTable);
	$('#dokumente_savePath').val(data.savePath);
	$('#dokumente_persnr').val(data.persnr);
	$('#dokumente_acturl').val(data.acturl);
	$('#dokumente_uploader #uploader').remove();
	//reinicializovat uploader
	$('#dokumente_uploader').html(data.uploader);
//	alert('reinit uploader, savepath='+$('#dokumente_savePath').val());

	$('#varTable').html(data.varTable);
	$("table.template_var_table input:input[id^=val_]").css({"background-color":"lightgreen","font-weight":"bold"});
	
	var uploader = new plupload.Uploader({
	    runtimes: 'html5,flash,browserplus',
	    flash_swf_url: '{!$baseUri}plupload/js/plupload.flash.swf',
	    browse_button: 'pickfiles',
	    container: 'uploader',
	    url: 'upload.php?savepath='+$('#dokumente_savePath').val()
	});
    
	uploader.init();
	uploader.bind('FilesAdded', function(up, files) {
	    $.each(files, function(i, file) {
		$('#filelist').append(
		    '<div id="' + file.id + '">' +
		    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' + '</div>');
	    });
	    up.start();
	});

	uploader.bind('UploadProgress', function(up, file) {
	    $('#' + file.id + " b").html(file.percent + "%");
	});

	uploader.bind('Error', function(up, err) {
	    $('#filelist').append("<div>Error: " + err.code +
            ", popis chyby: " + err.message +
            (err.file ? ", soubor: " + err.file.name : "") +
            "</div>"
	    );
	    up.refresh(); // Reposition Flash/Silverlight
	});
	uploader.bind('FileUploaded', function(up, file) {
	    //$('#' + file.id + " b").html("uloženo");
	    $('#' + file.id).remove();
	    //var acturl = '{!$acturl}';
	    var acturl = $('#dokumente_acturl').val();

	    $.post(acturl,
	    {
		//persnr:'{!$persnr}'
		persnr:$('#dokumente_persnr').val()
	    },
	    function(data){
		updateNewFileTable(data);
	    },
	    'json'
	    );    
	});
//******************************************************************************
	
        if(data.form!=null){
            $.each(data.form, function(name,control){
                if(control.attrs.type=='text') $('#'+control.attrs.id).val(control.attrs.value);
                if(control.attrs.type=='checkbox') $('#'+control.attrs.id).attr('checked',control.attrs.checked);
                if(control.attrs.name=='cb_regeloe') $('#'+control.attrs.id).val(data.persinfo.regeloe.selected);
                if(control.attrs.name=='cb_alteroe') $('#'+control.attrs.id).val(data.persinfo.alteroe.selected);
                if(control.attrs.name=='dpersstatus') $('#'+control.attrs.id).val(data.persinfo.dpersstatus.selected);
                if(control.attrs.name=='staats_angehoerigkeit_id') $('#'+control.attrs.id).val(data.persinfo.staats_angehoerigkeit_id.selected);
                if(control.attrs.name=='transport_id') $('#'+control.attrs.id).val(data.persinfo.transport_id.selected);
                if(control.attrs.name=='oe_voraussichtlich') $('#'+control.attrs.id).val(data.persinfo.oe_voraussichtlich.selected);
                if(control.attrs.name=='erledigt') $('#'+control.attrs.id).val(data.persinfo.erledigt.selected);
                if(control.attrs.name=='abydos_agentur') $('#'+control.attrs.id).val(data.persinfo.abydos_agentur.selected);
                if(control.attrs.name=='geeignet_id') $('#'+control.attrs.id).val(data.persinfo.geeignet_id.selected);
                if(control.attrs.name=='bew_geeignet_aktual_id') $('#'+control.attrs.id).val(data.persinfo.bew_geeignet_aktual_id.selected);
                if(control.attrs.name=='beendet_recht_id') $('#'+control.attrs.id).val(data.persinfo.beendet_recht_id.selected);
                if(control.attrs.name=='beendet_real_id') $('#'+control.attrs.id).val(data.persinfo.beendet_real_id.selected);
                if(control.attrs.name=='nicht_eingetretten_grund_id') $('#'+control.attrs.id).val(data.persinfo.nicht_eingetretten_grund_id.selected);
                if(control.attrs.name=='info_vom_id') $('#'+control.attrs.id).val(data.persinfo.info_vom_id.selected);
                if(control.attrs.name=='bewertung1') $('#'+control.attrs.id).val(data.persinfo.bewertung1.selected);
                if(control.attrs.name=='bewertung2') $('#'+control.attrs.id).val(data.persinfo.bewertung2.selected);
                if(control.attrs.name=='bewertung3') $('#'+control.attrs.id).val(data.persinfo.bewertung3.selected);
                if(control.attrs.name=='eigen_transport_id') $('#'+control.attrs.id).val(data.persinfo.eigen_transport_id.selected);
            });

            $('div.persid').html(data.persinfo.persnr+' - '+data.persinfo.name+' '+data.persinfo.vorname);
        }

        if($('#essen_table').length!=0){
            $('#essen_table').remove();
        }

        if($('#vorschuss_table').length!=0){
            $('#vorschuss_table').remove();
        }

        if($('#dpersstempel_table').length!=0){
            $('#dpersstempel_table').remove();
        }
        
        if($('#transport_table').length!=0){
            $('#transport_table').remove();
        }

        if($('#anwesenheit_table').length!=0){
            $('#anwesenheit_table').remove();
        }

        if($('#sonstpremie_table').length!=0){
            $('#sonstpremie_table').remove();
        }

        if($('#abmahnung_table').length!=0){
            $('#abmahnung_table').remove();
        }

        if($('#faehigkeiten_table').length!=0){
            $('#faehigkeiten_table').remove();
        }
        if($('#verletzung_table').length!=0){
            $('#verletzung_table').remove();
        }
        if($('#vertrag_table').length!=0){
            $('#vertrag_table').remove();
        }

        if($('#persnrauswaehlen').length!=0){
            $('#persnrauswaehlen').remove();
        }
// zjistim zda je zatrhnuto jen aktive MA
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked')?1:0;
        if(activeMA==0 && data.form.persnr.attrs.value==''){
        //if(activeMA==0 && data.persinfo==null){
            // dotazu se zda chci vytvorit noveho pracovnika se zadanym cislem
            odpoved = confirm("Neuen MA mit PersNr="+data.persnr+" erstellen ?");
            if(odpoved==true){
                // pomoci ajaxu vytvorim noveho pracovnika
                var acturl = $('#'+data.form.persnr.attrs.id).attr('acturl');
                var value = $(this).val();
                $.post(acturl,
                {
                    id: data.form.persnr.attrs.id,
                    persnr: data.persnr,
                    nurActiveMA: activeMA,
                    neuMA: 1
                },
                function(data){
                    updateValidatePersnr(data);
                },
                'json'
                );
            }
        }
    }
    else{
        activeMA = $('#frmpersinfo-aktive_MA').attr('checked')?1:0;
        alert('PersNr  nicht gefunden');
        //if(activeMA==0 && data.form.persnr.attrs.value==''){
        if(activeMA==0 && data.persinfo==null){
            // dotazu se zda chci vytvorit noveho pracovnika se zadanym cislem
            odpoved = confirm("Neuen MA mit PersNr="+data.persnr+" erstellen ?");
            if(odpoved==true){
                // pomoci ajaxu vytvorim noveho pracovnika
                acturl = $('#frmpersinfo-persnr').attr('acturl');
                value = $(this).val();
                $.post(acturl,
                {
                    id: 'frmpersinfo-persnr',
                    persnr: data.persnr,
                    nurActiveMA: activeMA,
                    neuMA: 1
                },
                function(data){
                    updateValidatePersnr(data);
                },
                'json'
                );
            }
        }
    }
}

function updatePersnrDelete(data){

}

function updateNewFileTable(data){
    $('#doklady_table_div').html(data.dokumentyTable);
}


function updatePersnrKopieren(data){
    // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();

    $(data.divcontent).appendTo('body');
    buttonOffset.top += $('#'+data.id).outerHeight();
    $('#persnrkopieren_table').css({
        "left":buttonOffset.left+"px"
    });
    $('#persnrkopieren_table').css({
        "top":buttonOffset.top+"px"
    });

    //priradim udalostni funkce k objektum

    // pole s persnr_neu
    $('#persnr_neu').blur(persnr_neuBlur);
    $('#persnr_neu').get(0).focus();

    //tlacitko persnr_neu_run
    $('#persnr_neu_run').click(persnr_neu_runClick);
}

function persnr_neu_runClick(){
    var persnrNeu = $('#persnr_neu').val();
    var persnrAlt = $('#frmpersinfo-persnr').val();
    var acturl = $(this).attr('acturl');
    $.post(acturl,
    {
        id:$(this).attr('id'),
        persnrneu: persnrNeu,
        persnralt: persnrAlt
    },
    function(data){
        updatePersnrNeuRunClick(data);
    },
    'json'
    );
}

function updatePersnrNeuRunClick(data){
    // test jestli uz nemam tabulku otevrenou
    if($('#persnrkopieren_table').length!=0){
        $('#persnrkopieren_table').remove();
    }

    // nastavim formular na nove persnr
        var id = 'frmpersinfo-persnr';
        var acturl = $('#frmpersinfo-persnr').attr('acturl');
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');
        $.post(acturl,
        {
            id:id,
            persnr: data.persnrneu,
            nurActiveMA: activeMA
        },
        function(data){
            updateValidatePersnr(data);
        },
        'json'
        );
}

function updateValidatePersnrBewerberForm(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
    if(data.redirect){
        // v pripade, ze mi vyprsi prihlaseni
        window.location.href = data.redirect;
    }

    if(data.bewerbinfo!=null){
        if(data.form!=null){
            $.each(data.form, function(name,control){
                if(control.attrs.type=='text')
                    $('#'+control.attrs.id).val(control.attrs.value);
                if(control.attrs.type=='checkbox')
                    $('#'+control.attrs.id).attr('checked',control.attrs.checked);
                if(control.attrs.name=='staats_angehoerigkeit_id')
                    $('#'+control.attrs.id).val(data.bewerbinfo.staats_angehoerigkeit_id.selected);
                if(control.attrs.name=='transport_id')
                    $('#'+control.attrs.id).val(data.bewerbinfo.transport_id.selected);
                if(control.attrs.name=='oe_voraussichtlich')
                    $('#'+control.attrs.id).val(data.bewerbinfo.oe_voraussichtlich.selected);
                if(control.attrs.name=='erledigt')
                    $('#'+control.attrs.id).val(data.bewerbinfo.erledigt.selected);
                if(control.attrs.name=='abydos_agentur')
                    $('#'+control.attrs.id).val(data.bewerbinfo.abydos_agentur.selected);
            });

        }
    }
}

function updateNameSuchen(data){
     // zjistim si pozici tlacitka
    var buttonOffset = $('#'+data.id).offset();
    buttonOffset.left += $('#'+data.id).outerWidth();

    if(data.persnrcount>0){
        if($('#persnrauswaehlen').length!=0) $('#persnrauswaehlen').remove();
        $(data.infodiv).appendTo('body');
        $('#persnrauswaehlen').css({"left":buttonOffset.left+"px"});
        $('#persnrauswaehlen').css({"top":buttonOffset.top+"px"});
	$('input:button[id^=gopersnr_]').click(goPersnrClick);
    }
    else{
        if($('#persnrauswaehlen').length!=0) $('#persnrauswaehlen').remove();
    }
   
}

function goPersnrClick(event){
        var id = $('#frmpersinfo-persnr').attr('id');
        var acturl = $('#frmpersinfo-persnr').attr('acturl');
        var value = $(this).val();
        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked');
        $.post(acturl,
        {
            id:id,
            persnr: value,
            nurActiveMA: activeMA
        },
        function(data){
            updateValidatePersnr(data);
        },
        'json'
        );
}

function persnr_neuBlur(){
    var id = $(this).attr('id');
    var acturl = $(this).attr('acturl');
    var value = $(this).val();

    if(js_validate_float_between(this, 1, 99999)){
            $.post(acturl,
            {
                id:id,
                persnrneu: value
            },
            function(data){
                updatePersnrNeuBlur(data);
            },
            'json'
            );
    }
}

function updatePersnrNeuBlur(data){
    if(data.exists==true){
        $('#persnr_neu_meldung').html('eingegebene PersNr existiert schon !<br>'+'( '+data.persinfo.name+' '+data.persinfo.vorname+' )').css({'color':'red','font-weight':'bold'});
        $('#persnr_neu').get(0).focus();
        $('#persnr_neu').get(0).select();
        $('#persnr_neu_run').attr('disabled','disabled');
    }
    else{
        $('#persnr_neu_meldung').html('').css({'color':'','font-weight':''});
        $('#persnr_neu_run').attr('disabled','');
    }
}

function bt_persnrdeleteClick(){

            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var persnr = $('#frmpersinfo-persnr').val();

            $.post(acturl,
            {
                id:id,
                persnr: persnr
            },
            function(data){
                updatePersnrDelete(data);
            },
            'json'
            );
}

function makePersDoku(){

            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var persnr = $('#dokumente_persnr').val();

//	    var idSelector = function() { return this.id; };
//	    var selectedTemplates = $("input:checkbox:checked[class=template_checkbox]").map(idSelector).get();
	    
	    
	    var temps = [];
	    var i=0;
	    $("input:checkbox:checked[class=template_checkbox]").each(function(){
		temps[i++]=$(this).attr("id");
	    });
	    
	    var vals = [];
	    var ids = [];
	    var i=0;
	    $("table.template_var_table input:input[id^=val_]").each(function(){
		ids[i]=$(this).attr("id").substr($(this).attr("id").indexOf('_')+1);
		vals[i++]=$(this).val();
	    });
            $.post(acturl,
            {
                id:id,
                persnr: persnr,
		templates:temps.join(';'),
		vals:vals.join(';'),
		ids:ids.join(';')
            },
            function(data){
                updateMakePersDoku(data);
            },
            'json'
            );
}

function updateMakePersDoku(data){
    $('#doklady_table_div').html(data.dokumentyTable);
}

function bt_persnrkopierenClick(){

            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var persnr = $('#frmpersinfo-persnr').val();

            // test jestli uz nemam tabulku otevrenou
            if($('#persnrkopieren_table').length!=0){
                $('#persnrkopieren_table').remove();
                return;
            }

            $.post(acturl,
            {
                id:id,
                persnr: persnr
            },
            function(data){
                updatePersnrKopieren(data);
            },
            'json'
            );
}
//// posun k dalsimu inputu pomoci enteru
//    //var inputy = $('input:text');
//    var inputy = $('.entermove');
//    $('input:text[class=entermove]').bind('focus',function(e){
//        this.select();
//    });
//
//    //na prvni nastavim focus
//    if(inputy[0]!=null){
//        inputy[0].focus();
//        inputy[0].select();
//    }
//    //inputy.css({'background-color':'green'});
//    //alert(inputy);
//    inputy.bind('keypress',function(e){
//        var key = e.which;
//        if(key==13){
//            e.preventDefault();
//
//            var nextIndex = inputy.index(this) + 1;
//            //alert('this='+this+' nextIndex='+nextIndex);
//            if(inputy[nextIndex]!=null){
//                var nextBox = inputy[nextIndex];
//                //alert(nextBox);
//                nextBox.focus();
//                //nextBox.select();
//            }
//        }
//    });

