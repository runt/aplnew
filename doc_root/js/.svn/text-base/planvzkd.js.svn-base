
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){

    $('#frmvzkdplanfilter-planoe').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            planoe: $('#frmvzkdplanfilter-planoe').val(),
            datumvon: $('#frmvzkdplanfilter-datumvon').val()
//            persnr: $('#frmvzkdplanfilter-persnr').val()
        },
        function(data){
            updateValidateFilter(data);
        },
        'json'
        );
    });

    $('#frmvzkdplanfilter-datumvon').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            planoe: $('#frmvzkdplanfilter-planoe').val(),
            datumvon: $('#frmvzkdplanfilter-datumvon').val()
//            persnr: $('#frmvzkdplanfilter-persnr').val()
        },
        function(data){
            updateValidateFilter(data);
        },
        'json'
        );
    });

$('#frmvzkdplanfilter-persnr').blur(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            planoe: $('#frmvzkdplanfilter-planoe').val(),
            datumvon: $('#frmvzkdplanfilter-datumvon').val()
//            persnr: $('#frmvzkdplanfilter-persnr').val()
        },
        function(data){
            updateValidateFilter(data);
        },
        'json'
        );
    });

$('[id^=frmvzkdplanfilter-woche]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        //alert('click');
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            planoe: $('#frmvzkdplanfilter-planoe').val(),
            datumvon: $('#frmvzkdplanfilter-datumvon').val()
//            persnr: $('#frmvzkdplanfilter-persnr').val()
        },
        function(data){
            updateWoche(data);
        },
        'json'
        );
    });

    $('#frmvzkdplanfilter-planoe').get(0).focus();
});


// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------

function updateWoche(data){
    $('#frmvzkdplanfilter-datumvon').val(data.datumvon);
    updateValidateFilter(data);
}

function updateValidateFilter(data){
    //$('#debuginfo').prepend(data.toSource());
    $('#vzkdplantable').html(data.infodiv);
    if(true){
        //$('#vzkdplantable').show();

        $('[id^=datumvzkd_]').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        js_validate_float_real(this);
        $.post(acturl,
        {
            id:id,
            value: $(this).val()
        },
        function(data){
            updateDatumVzKd(data);
        },
        'json'
        );
    });

        $('[id^=anwvzkd_faktor_]').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

        js_validate_float_real(this);
        $.post(acturl,
        {
            id:id,
            value: $(this).val()
        },
        function(data){
            updateAnwVzkdFaktor(data);
        },
        'json'
        );
    });

        $('[id^=fillvzkd_]').click(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();

    
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            planoe: $('#frmvzkdplanfilter-planoe').val(),
            datumvon: $('#frmvzkdplanfilter-datumvon').val()
        },
        function(data){
            updateFillVzkd(data);
        },
        'json'
        );
    });

    }
}

function updateFillVzkd(data){
    //$('#debuginfo').prepend("<br>"+data.toSource());
    if(data.affectedRows>0){
            $('#'+data.id).css({'background-color':'green'});
            $('#'+data.id).css({'color':'white'});
            //projdu vracene pole a nastavim hodnoty v inputech
            $.each(data.personenArray,function(persnr,person){
               //alert(persnr);
               $.each(person,function(index,hodnota){
                  if(!isNaN(index)){
                      idbunky = 'datumvzkd_'+persnr+'_'+index+'_'+data.oe;
                      //alert(idbunky+'='+hodnota.vzkdstunden);
                      $('#'+idbunky).val(hodnota.vzkdstunden);
                      $('#'+idbunky).css({'font-weight':'bold'});
                  }
               });
            });
    }
    else{
        $('#'+data.id).css({'background-color':''});
        $('#'+data.id).css({'color':''});
    }

}

function updateAnwVzkdFaktor(data){
    if(data.affectedRows>0){
        $('#'+data.id).val(data.formattedValue);
    }
}

function updateDatumVzKd(data){
    if(data.affectedRows>0){
        $('#'+data.id).val(data.formattedValue);
    }
}


function updateUpdateDpersField(data){
    $('#debuginfo').prepend("<br>"+data.toSource());
}

//function updateUpdateDpersDatumField(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
//    if(data.datumvalue==null){
//        $('#'+data.id).css({
//            'background-color':'red'
//        });
//        $('#'+data.id).val('');
//        $('#'+data.id).get(0).focus();
//    }
//    else{
//        $('#'+data.id).css({
//            'background-color':''
//        });
//        $('#'+data.id).val(data.datumvalue);
//    }
//}
//
//function updateValidatePersnr(data){
//    $('#debuginfo').prepend("<br>"+data.toSource());
//    if(data.redirect){
//        // v pripade, ze mi vyprsi prihlaseni
//        window.location.href = data.redirect;
//    }
//
//    if(data.persinfo!=null){
//        if(data.form!=null){
//            $.each(data.form, function(name,control){
//                if(control.attrs.type=='text')
//                    $('#'+control.attrs.id).val(control.attrs.value);
//                if(control.attrs.type=='checkbox')
//                    $('#'+control.attrs.id).attr('checked',control.attrs.checked);
//                if(control.attrs.name=='cb_regeloe')
//                    $('#'+control.attrs.id).val(data.persinfo.regeloe.selected);
//                if(control.attrs.name=='cb_alteroe')
//                    $('#'+control.attrs.id).val(data.persinfo.alteroe.selected);
//            });
//        }
//
//        if($('#essen_table').length!=0){
//            $('#essen_table').remove();
//        }
//
//        if($('#vorschuss_table').length!=0){
//            $('#vorschuss_table').remove();
//        }
//
//        if($('#dpersstempel_table').length!=0){
//            $('#dpersstempel_table').remove();
//        }
//
//        if($('#transport_table').length!=0){
//            $('#transport_table').remove();
//        }
//
//        if($('#anwesenheit_table').length!=0){
//            $('#anwesenheit_table').remove();
//        }
//
//        if($('#sonstpremie_table').length!=0){
//            $('#sonstpremie_table').remove();
//        }
//
//        if($('#abmahnung_table').length!=0){
//            $('#abmahnung_table').remove();
//        }
//
//        if($('#persnrauswaehlen').length!=0){
//            $('#persnrauswaehlen').remove();
//        }
//// zjistim zda je zatrhnuto jen aktive MA
//        var activeMA = $('#frmpersinfo-aktive_MA').attr('checked')?1:0;
//        if(activeMA==0 && data.form.persnr.attrs.value==''){
//            // dotazu se zda chci vytvorit noveho pracovnika se zadanym cislem
//            odpoved = confirm("Neuen MA mit PersNr="+data.persnr+" erstellen ?");
//            if(odpoved==true){
//                // pomoci ajaxu vytvorim noveho pracovnika
//                var acturl = $('#'+data.form.persnr.attrs.id).attr('acturl');
//                var value = $(this).val();
//                $.post(acturl,
//                {
//                    id: data.form.persnr.attrs.id,
//                    persnr: data.persnr,
//                    nurActiveMA: activeMA,
//                    neuMA: 1
//                },
//                function(data){
//                    updateValidatePersnr(data);
//                },
//                'json'
//                );
//            }
//        }
//    }
//    else{
//
//}
//}
//
//function updateNameSuchen(data){
//     // zjistim si pozici tlacitka
//    var buttonOffset = $('#'+data.id).offset();
//    buttonOffset.left += $('#'+data.id).outerWidth();
//
//    if(data.persnrcount>0){
//        if($('#persnrauswaehlen').length!=0) $('#persnrauswaehlen').remove();
//        $(data.infodiv).appendTo('body');
//        $('#persnrauswaehlen').css({"left":buttonOffset.left+"px"});
//        $('#persnrauswaehlen').css({"top":buttonOffset.top+"px"});
//    }
//    else{
//        if($('#persnrauswaehlen').length!=0) $('#persnrauswaehlen').remove();
//    }
//
//}