
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){
}
);

//$('input#profilneu').click(function(event){
//    $('div#neuesprofilform').show('slow');
//});
//
//$('input#cancelnewprofile').click(function(event){
//    $('div#neuesprofilform').hide('slow');
//    $('div#planprofile').hide('slow');
//});
//
//$('input#savenewprofile').click(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $('input#profilename').val();
//
//    $.post(acturl,
//        {
//            newProfileName: value
//        },
//        function(data){
//                updateSaveNewProfile(data);
//                window.location.reload();
////            updateUmlageFormular(data);
////            umlageReInit();
//        },
//        'json'
//    );
//});

// handler for setting profile active
//$('input[id^=setactiveprofile]').click(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $('input#profilename').val();
////    alert('click');
//    $.post(acturl,
//        {
//            fieldId: id
//        },
//        function(data){
//                message = data.toSource();
//              $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//              window.location.reload(true);
////            updateUmlageFormular(data);
////            umlageReInit();
//        },
//        'json'
//    );
//    // chci aby fungoval i jako odkaz tak vratim true
//    // false ruci defaultni zpracovani eventu pro A
//    return;
//});
//
////handler for deleting profile
//$('input[id^=deleteprofile]').click(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $('input#profilename').val();
////    alert('click');
//    $.post(acturl,
//        {
//            fieldId: id
//        },
//        function(data){
//              message = data.toSource();
//              $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//              // v data.profileid mam cislo profilu, ktery jsem smazal
//              // pomoci tohoto id si vytvorim id radku v tabulce profilu a ten potom smazu
//              radekId = "row_profile_"+data.profileid;
//              $('tr#'+radekId).remove();
////              window.location.reload(true);
////            updateUmlageFormular(data);
////            umlageReInit();
//        },
//        'json'
//    );
//    // chci aby fungoval i jako odkaz tak vratim true
//    // false ruci defaultni zpracovani eventu pro A
//    return;
//});

//// zakazu / povolim prepinac pro debug
//$('a#toggleplanbabinfo').hide();
//// link for showing planprofiles selection
//$('a#toggleplanbabinfo').toggle(
//    function(event){
//        $('div#planbabinfo').show('slow');
//        return false;
//    },
//    function(event){
//        $('div#planbabinfo').hide('slow');
//        return false;
//    }
//);
//
//// link for showing planprofiles selection
//$('a#profileanzeigen').toggle(
//    function(event){
//        $('div#planprofile').show('slow');
//        return false;
//    },
//    function(event){
//        $('div#planprofile').hide('slow');
//        return false;
//    }
//);
//
//// link for showing planprofiles selection
//$('a#druckformanzeigen').toggle(
//    function(event){
//        var acturl = $(this).attr('acturl');
//        // pomoci ajaxu si vytahnu aktualni nastaveni drucku
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id')
//                },
//                function(data){
//                    message = data.toSource();
//                    $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//                    $('div#druckform div#druckoptionen').html(data.ul);
//                    //druck optionen handler
//                    addDruckoptionenHandler();
//                    $('div#druckform').show();
//                },
//                'json'
//        );
//        return false;
//    },
//    function(event){
//        $('div#druckform').hide();
//        return false;
//    }
//);
//
//
//// make from TD input for BAB Table
//$('td[id*=ZinsenMan]').each(function(){
//   elId = $(this).attr('id');
//   podtrzitkoPredKoncovkou = elId.lastIndexOf("_");
//   povoleneKoncovky = new Array('m1','m2','m3','m4','m5','m6','m7','m8','m9','m10','m11','m12');
//
//   koncovka = elId.substr(podtrzitkoPredKoncovkou+1);
//   if(povoleneKoncovky.indexOf(koncovka)>-1){
//    strValue = $(this).text();
//    value = parseFloat(strValue);
//    acturl = $(this).attr('acturl');
//    inputID = 'input_'+$(this).attr('id');
//    novyinput = "<input type='text' id='"+inputID+"' acturl='"+acturl+"' class='nummer' value='"+value+"' />";
//    $(this).html(novyinput);
//   }
//   // a jeste puvodnimu td odeberu id
//});
//
//$('td[id*=ausruestKostenMan]').each(function(){
//   elId = $(this).attr('id');
//   podtrzitkoPredKoncovkou = elId.lastIndexOf("_");
//   povoleneKoncovky = new Array('m1','m2','m3','m4','m5','m6','m7','m8','m9','m10','m11','m12');
//
//   koncovka = elId.substr(podtrzitkoPredKoncovkou+1);
//   if(povoleneKoncovky.indexOf(koncovka)>-1){
//    strValue = $(this).text();
//    value = parseFloat(strValue);
//    acturl = $(this).attr('acturl');
//    inputID = 'input_'+$(this).attr('id');
//    novyinput = "<input type='text' id='"+inputID+"' acturl='"+acturl+"' class='nummer' value='"+value+"' />";
//    $(this).html(novyinput);
//   }
//   // a jeste puvodnimu td odeberu id
//});
//
//
//
//
//
//// if tr has class eingabe a id matches _plan_m make from text in td element an input element
//$('td[id*=_plan_m]').each(function(){
//    // zjistit classname u parent elementu, protoze input vytvorim jen u td, jejichz tr ma class eingabe
//    trClass = $(this).parent().get(0).className;
//    pripona = '';
//    // zajistim cislo mesice podle aktualniho datumu
//    dnesnidatum = new Date();
//    dnesniMesic = dnesnidatum.getMonth()+1;
//    id = $(this).attr('id');
//    poziceM = id.lastIndexOf("_m");
//    cisloMesice = parseInt(id.substr(poziceM+2));
//    // jeste si zjistim stelle , protoze u gesamt nebudu delat z td inputy
//    pozicePoslednihoPodtrzitka = id.lastIndexOf("_");
//
//    stelle = id.substr(pozicePoslednihoPodtrzitka+1);
//
//    if((trClass=="eingabe")&&(cisloMesice>=dnesniMesic)&&(stelle!="gesamt")){
//        strValue = $(this).text();
//        indexProcenta = strValue.indexOf("%");
//        value = parseFloat(strValue);
//        // pokud je value hodnota s procentem tak odstranim procento a nastavim priponu na procento
//        if(indexProcenta>0){
//            //nasel jsem
//            pripona='%';
//        }
//        acturl = $(this).attr('acturl');
//        inputID = 'input_'+$(this).attr('id');
//        novyinput = "<input type='text' id='"+inputID+"' acturl='"+acturl+"' class='nummer' value='"+value+"' />"+pripona;
//        $(this).html(novyinput);
//        // a jeste puvodnimu td odeberu id
//    }
//});
//
//$('td[id*=_plan_m] input').focus(function(event){
//    $(this).get(0).select();
//});
//
//// ajax handling for BAB table input fields
//$('td[id*=ZinsenMan] input').blur(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $(this).val();
//
//    $.post(acturl,
//        {
//            fieldId: id,
//            fieldValue: $(this).val()
//        },
//        function(data){
//                updateBABTable(data);
//        },
//        'json'
//    );
//});
//
//// ajax handling for BAB table input fields
//$('td[id*=ausruestKostenMan] input').blur(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $(this).val();
//
//    $.post(acturl,
//        {
//            fieldId: id,
//            fieldValue: $(this).val()
//        },
//        function(data){
//                updateBABTable(data);
//        },
//        'json'
//    );
//});
//
//// ajax handling for blur event
//$('td[id*=_plan_m] input').blur(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $(this).val();
//
//    // rozeberu ID
//    // 1. pokud tam najdu _planangepasst_ tak angepasst bude 1 jinak nula
//    angepasstIndex = id.indexOf("_planangepasst_",0);
//    if(angepasstIndex>=0)
//       angepasst = 1
//   else
//       angepasst = 0;
//    //2. cislo mesice - jsou posledni znaky za m, tj. budu hledat odzadu m a vemu potom od pozice m do konce retezce
//    poziceM = id.lastIndexOf("_m");
//    cisloMesice = parseInt(id.substr(poziceM+2));
//    //3. jmeno policka v databazi se nachazi hned za slovem input_, tj hned za prvnim podtrzitkem
//    prvniPodtrzitkoIndex = id.indexOf("_");
//    druhePodtrzitkoIndex = id.indexOf("_",prvniPodtrzitkoIndex+1);
//    dbFieldName = id.substring(prvniPodtrzitkoIndex+1,druhePodtrzitkoIndex);
//
//    $.post(acturl,
//        {
//            elementId: $(this).attr('id'),
//            elementValue: $(this).val(),
//            dbFieldName: dbFieldName,
//            monat: cisloMesice,
//            angepasst: angepasst
//        },
//        function(data){
//                updatePlanBAB(data);
////            updateUmlageFormular(data);
////            umlageReInit();
//        },
//        'json'
//    );
//
//});
//
//
//$('td[id*=_planangepasst_m]').each(function(){
//    // zjistit classname u parent elementu, protoze input vytvorim jen u td, jejichz tr ma class eingabe
//    trClass = $(this).parent().get(0).className;
//    pripona = '';
//    // zajistim cislo mesice podle aktualniho datumu
//    dnesnidatum = new Date();
//    dnesniMesic = dnesnidatum.getMonth()+1;
//    id = $(this).attr('id');
//    poziceM = id.lastIndexOf("_m");
//    cisloMesice = parseInt(id.substr(poziceM+2));
//    // jeste si zjistim stelle , protoze u gesamt nebudu delat z td inputy
//    pozicePoslednihoPodtrzitka = id.lastIndexOf("_");
//
//    stelle = id.substr(pozicePoslednihoPodtrzitka+1);
//
//    if((trClass=="eingabe")&&(cisloMesice>=dnesniMesic)&&(stelle!="gesamt")){
//        strValue = $(this).text();
//        indexProcenta = strValue.indexOf("%");
//        value = parseFloat(strValue);
//        // pokud je value hodnota s procentem tak odstranim procento a nastavim priponu na procento
//        if(indexProcenta>0){
//            //nasel jsem
//            pripona='%';
//        }
//        acturl = $(this).attr('acturl');
//        inputID = 'input_'+$(this).attr('id');
//        novyinput = "<input type='text' id='"+inputID+"' acturl='"+acturl+"' class='nummer' value='"+value+"' />"+pripona;
//        $(this).html(novyinput);
//    }
//});
//
//$('td[id*=_planangepasst_m] input').blur(function(event){
//    var id = $(this).attr('id');
//    var acturl = $(this).attr('acturl');
//    var value = $(this).val();
//
//    // rozeberu ID
//    // 1. pokud tam najdu _planangepasst_ tak angepasst bude 1 jinak nula
//    angepasstIndex = id.indexOf("_planangepasst_",0);
//    if(angepasstIndex>=0)
//       angepasst = 1
//   else
//       angepasst = 0;
//    //2. cislo mesice - jsou posledni znaky za m, tj. budu hledat odzadu m a vemu potom od pozice m do konce retezce
//    poziceM = id.lastIndexOf("_m");
//    cisloMesice = parseInt(id.substr(poziceM+2));
//    //3. jmeno policka v databazi se nachazi hned za slovem input_, tj hned za prvnim podtrzitkem
//    prvniPodtrzitkoIndex = id.indexOf("_");
//    druhePodtrzitkoIndex = id.indexOf("_",prvniPodtrzitkoIndex+1);
//    dbFieldName = id.substring(prvniPodtrzitkoIndex+1,druhePodtrzitkoIndex);
//
//    $.post(acturl,
//        {
//            elementId: $(this).attr('id'),
//            elementValue: $(this).val(),
//            dbFieldName: dbFieldName,
//            monat: cisloMesice,
//            angepasst: angepasst
//        },
//        function(data){
//                updatePlanBAB(data);
////            updateUmlageFormular(data);
////            umlageReInit();
//        },
//        'json'
//    );
//});

//------------------------------------------------------------------------------
// jahrauswahl is initialy hidden

//$('div#settings').hide();
////------------------------------------------------------------------------------
//
////------------------------------------------------------------------------------
//// jahrauswahl is initialy hidden
//
//$('div#mainheader a#showjahrauswahl').click(function(event){
//    $('div#settings').show();
//    return false;
//});
////------------------------------------------------------------------------------
//
//
//
////------------------------------------------------------------------------------
//// afalager yellow background
////$('table#stammarray td[id*=afa_lager]').css({"border":"2px solid orange"});
//$('table#stammarray td[id*=afa_lager]').addClass("afalager");
//
////------------------------------------------------------------------------------
//
//
////------------------------------------------------------------------------------
//// area for setting for table
//$('div#settings').width('50%');
////------------------------------------------------------------------------------
//
////------------------------------------------------------------------------------
//// stamm daten fucus handler for value editing , select all
////
//
//$('table#stammarray tbody td input[type=text]').focus(function(event){
//    this.select();
//});
//
////------------------------------------------------------------------------------
//// stamm daten onclick handler for value editing
////
//
//
//$('table#stammarray tbody td input[type=text]').blur(function(event){
//
//    var acturl = $(this).attr('acturl');
//    $.post(acturl,
//                {
//                    fieldId: $(this).attr('id'),
//                    fieldValue: $(this).val()
//                },
//                function(data){
//                    if(data.isnumeric=="1")
//                        $("#output").html(data.message);
//                    else{
//                            message = "id :"+data.fieldId
//                                        +" value :"+data.fieldValue
//                                        +"actualJahr: "+data.actualJahr
//                                        +"jahrTyp: "+data.jahrTyp
//                                        +"prozent: "+data.prozent
//                                        +"sql: "+data.sql
//                                        +"affectedRows: "+data.affectedRows
//                                        +" nummer: "+data.isnumeric;
//                        $("#output").html(message);
//                    }
//
////                    $('#output').append("<br>id :"+data.fieldId
////                                        +" value :"+data.fieldValue
////                                        +"actualJahr: "+data.actualJahr
////                                        +"jahrTyp: "+data.jahrTyp
////                                        +"prozent: "+data.prozent
////                                        +"sql: "+data.sql
////                                        +"affectedRows: "+data.affectedRows
////                                        +" nummer: "+data.isnumeric
////                                        );
////                    //showColumn(idSloupce);
//                },
//                'json' // jako komunikační formát použijeme JSON
//                //
//            );
//    //$("<input type='text' id="+id+"/>").insertAfter(this);
//    //$(this).html(id);
//});
//
//    //------------------------------------------------------------------------------
////umlage schluessel1 onchange handler
//$('select[id$=umlageSchlussel1]').change(function(event){
//    // selected value
//    var selectedSchluessel = $(this).val();
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////umlage schluessel1 onchange handler
//$('select[id$=umlageSchlussel2]').change(function(event){
//    // selected value
//    var selectedSchluessel = $(this).val();
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////kosten textfield onblur handler
//$('input[id$=_kosten]').blur(function(event){
//    //alert('id inputu je :'+$(this).attr('id'));
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////umlage1 textfield onblur handler
//$('input[id$=_umlage1]').blur(function(event){
//    //alert('id inputu je :'+$(this).attr('id'));
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////umlage2 textfield onblur handler
//$('input[id$=_umlage2]').blur(function(event){
//    //alert('id inputu je :'+$(this).attr('id'));
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
////
////------------------------------------------------------------------------------
//// on click show variable info using ajax
//$('table#stammarray tbody th:nth-child(2)').mouseover(function(event){
//    $(this).css({"cursor":"pointer"});
//});
//
//$('#varspeichern').click(function(event){
//    var acturl = $(this).attr('acturl');
//    var name = $('#varname').val();
//    var varname = $('#varvar').val();
//    var info = $('#varinfo').val();
////    alert(
////            '\nacturl:'+acturl+
////            '\nname:'+name+
////            '\nvarname:'+varname+
////            '\ninfo:'+info
////        );
//    $.post(acturl,
//                {
//                    variable: varname,
//                    name: name,
//                    info: info
//                },
//                function(data){
////                    $('#output').append("<br>"+data.varinfo.toSource());
//                    //alert('submit ready info.length='+info.length+' info='+info);
//                    if(info.length>0)
//                        $('#'+varname).text('INFO');
//                    if(info.length==0)
//                        $('#'+varname).text('i');
//                },
//                'json' // jako komunikační formát použijeme JSON
//                //
//            );
//});
//
//$('table#stammarray tbody th:nth-child(2)').attr('title','click fur Info');
//
//$('table#stammarray tbody th:nth-child(2)').click(function(event){
//    var acturl = $(this).attr('acturl');
//    $.post(acturl,
//                {
//                    variable: $(this).attr('id')
//                },
//                function(data){
////                    $('#output').append("<br>"+data.varinfo.toSource());
//                    $('#varname').val(data.varinfo.name);
//                    $('#varvar').val(data.varinfo.varname);
//                    $('#varinfo').text(data.varinfo.info);
//                    $('#varinfo').val(data.varinfo.info);
//                    //showColumn(idSloupce);
//                },
//                'json' // jako komunikační formát použijeme JSON
//                //
//            );
//});
//------------------------------------------------------------------------------
//
//
//
//------------------------------------------------------------------------------
// ajax spinner
//$('<div id="ajax-spinner"></div>').ajaxStart(function () {
//        // po ajaxStartu ukážu
//        $(this).show();
//    }).ajaxStop(function () {
//        // a při ajaxStopu schovám
//        $(this).hide();
//    }).appendTo("body").hide();
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// mouseover for table cells
//$("td").mouseover(function(event){
//    $(this).css({"background-color":"#ffffaa","font-weight":"bolder"});
//});
//
//$("td").mouseout(function(event){
//    $(this).css({"background-color":"","font-weight":""});
//});
//------------------------------------------------------------------------------






//------------------------------------------------------------------------------
// switch for columns displaying block
//$("#sichtschalter").toggle(
//    function(event){
//        $("#sichtbarkeit").show("slow");
//    },
//    function(event){
//        $("#sichtbarkeit").hide("slow");
//    }
//);
//------------------------------------------------------------------------------




//------------------------------------------------------------------------------
//display switch mouseover
//$(".sichtflag").mouseover(function(event){
//    $(this).css({"border-color":"blue"});
//});
//$(".sichtflag").mouseout(function(event){
//    $(this).css({"border-color":"","border-width":""});
//});
////------------------------------------------------------------------------------
//
//
////------------------------------------------------------------------------------
//// minus values goes red
//$("table td").each(function(){
//   var value = $(this).text();
//   if(parseFloat(value)<0){
//       $(this).css("color","red");
//   }
//});
////------------------------------------------------------------------------------
//
//
////------------------------------------------------------------------------------
//// columns display switching code with ajax
//// acturl has presenter and action link from template
//
//$(".sichtflag").click(function(event){
//    var ident = $(this).attr('id');
//    var idSloupce = ident.substr(ident.indexOf('_')+1);
//    var isColHidden = $(this).hasClass('colhidden');
//    var acturl = $(this).attr('acturl');
//
// // pustim ajax
//    $.post(acturl,
//                {idColumn: idSloupce,isHidden: isColHidden},
//                function(data){
//                    //alert(idSloupce+' display flag set to '+data.flag);
//                },
//                'json' // jako komunikační formát použijeme JSON
//        );
//
//    if(isColHidden){
//        //sloupec je schovan, budu ho odkryvat
//        showColumn(idSloupce);
//        //nastavim styl
//        $(this).toggleClass('colhidden');
//        $(this).toggleClass('colshown');
//    }
//    else{
//        //sloupec je videt, budu ho schovavat
//        hideColumn(idSloupce);
//        //nastavim styl
//        $(this).toggleClass('colhidden');
//        $(this).toggleClass('colshown');
//    }
//
//
//});
//
//
//
////------------------------------------------------------------------------------
//// click handler for toggling all columns in one click
//$("input.sichtflagAlle").click(
//    function(event){
//        clickAlleSichtFlag();
//    }
//);
////------------------------------------------------------------------------------
//
//});
//
//function negativeWerteReInit()
//{
////------------------------------------------------------------------------------
//// minus values goes red
//$("table td").each(function(){
//   var value = $(this).text();
//   if(parseFloat(value)<0){
//       $(this).css("color","red");
//   }
//   else{
//       $(this).css("color","inherit");
//   }
//});
//
//}
//
//function umlageReInit(){
//    //------------------------------------------------------------------------------
////umlage schluessel1 onchange handler
//
////------------------------------------------------------------------------------
////umlage schluessel1 onchange handler
//$('select[id$=umlageSchlussel2]').change(function(event){
//    // selected value
//    var selectedSchluessel = $(this).val();
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////umlage1 textfield onblur handler
//$('input[id$=_umlage1]').blur(function(event){
//    //alert('id inputu je :'+$(this).attr('id'));
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
////------------------------------------------------------------------------------
////umlage2 textfield onblur handler
//$('input[id$=_umlage2]').blur(function(event){
//    //alert('id inputu je :'+$(this).attr('id'));
//    var acturl = $(this).attr('acturl');
//
//        $.post(acturl,
//                {
//                    elementId: $(this).attr('id'),
//                    elementValue: $(this).val()
//                },
//                function(data){
//                        updateUmlageFormular(data);
//                        umlageReInit();
//                    },
//                    'json'
//            );
//});
//
//}
///**
// * hides column identified by idColumn
// */
//function hideColumn(idColumn){
//    $("table.grid [id$="+idColumn+"]").hide();
//}
//
///**
// * shows column identified by idColumn
// */
//function showColumn(idColumn){
//    $("table.grid [id$="+idColumn+"]").show();
//}
//
///**
// * starts click handler for all display switches
// */
//function clickAlleSichtFlag(){
//    // vyberu vsechny tlacitka pro skryvani sloupcu
//    $("input.sichtflag").each(function(){
//        $(this).click();
//    });
//}
//
//// ajax ready function for newprofile
//function updateSaveNewProfile(data){
//    message = "newid:"+data.newprofileinfo.profileid+"newname:"+data.newprofileinfo.profilename;
//    $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//    // a schovam formular pro zadani noveho jmena a seznam profilu
//    // taky bych mel v hlavicce upravit jmeno a id profilu
//    $('div#neuesprofilform').hide('slow');
//    $('div#planprofile').hide('slow');
//    $('span#info_profileid').html(data.newprofileinfo.profileid+"");
//    $('span#info_profilename').html(data.newprofileinfo.profilename+"");
//}
//
//// ajax ready function for planbab
//function updatePlanBAB(data){
////    $('div#planbabinfo').html("updatePlanBAB"+$('div#planbabinfo').html());
////    message='';
//    start = Date.now();
//    pocetcyklu=0;
//    if(data.sqloutput.affectedrows>0){
//        $.each(data.tabulka,function(abteilung,tab){
//            $.each(tab, function(radek,sloupce){
//                radekId = "row_"+radek+"_"+abteilung;
//                trClass = $('#'+radekId).get(0).className;
//                $.each(sloupce,function(sloupec,value){
//                      elementId = radek+"_"+sloupec+"_"+abteilung;
//                      pocetcyklu++;
//                        if(trClass=='eingabe'){
//                            // muzou tu byt inputy
//                            // jeste zkontroluju jestli id neobsahuje _plan_m nebo _plan_angepasst_m
//                          if(elementId.indexOf("_plan_m")>0 || elementId.indexOf("_planangepasst_m")>0){
//                                // je to input nedelam nic
//                          }
//                          else{
//                            setAndMarkNewValue(elementId, value);
//                          }
//                        }
//                        else{
//                            setAndMarkNewValue(elementId, value);
//                        }
//                });
//            });
//        });
//        negativeWerteReInit();
//    }
//    else{
////        message = "<br>data.dbfield:"+data.dbfield
////        +"<br>data.jahr:"+data.jahr
////        +"<br>data.abteilung:"+data.abteilung
////        +"<br>data.monat:"+data.monat
////        +"<br>data.profileid:"+data.profileid
////        +"<br>data.sqloutput:"+data.sqloutput.toSource()
////        +"<br>data.angepasst:"+data.angepasst;
//    }
//        stop = Date.now();
//        rozdil = stop-start;
//        $('div#planbabinfo').html('rozdil='+rozdil+' cyklu='+pocetcyklu);
//
////    $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//}
//
//// ajax ready function for planbab
//function updateBABTable(data){
//
//   povoleneKoncovky = new Array('m1','m2','m3','m4','m5','m6','m7','m8','m9','m10','m11','m12');
//    if(data.sqloutput.affectedrows>0){
//            $.each(data.tabulka.gesamt, function(radek,sloupce){
//                radekId = "row_gesamt_"+radek;
//                trClass = $('#'+radekId).get(0).className;
//                $.each(sloupce,function(sloupec,value){
//                      elementId = "gesamt_"+radek+"_"+sloupec;
//                        if(trClass=='eingabe'){
//                            // muzou tu byt inputy
//                          if(povoleneKoncovky.indexOf(sloupec)>-1){
//                                // je to input nedelam nic
//                          }
//                          else{
//                            setAndMarkNewValue(elementId, value);
//                          }
//                        }
//                        else{
//                            setAndMarkNewValue(elementId, value);
//                        }
//                });
//            });
//        negativeWerteReInit();
//    }
//    else{
////        message = "<br>data.toSource():"+data.toSource();
//    }
//    message = "<br>data.toSource():"+data.toSource();
//    $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//}
//
///**
// * sets html value and marks the change
// */
//function setAndMarkNewValue(elementId,value){
//    // muzu zkusit oznacit pole, ktera se po aktualizaci zmenila
//    puvodniObsah = $('#'+elementId).html();
//    po = $.trim(puvodniObsah);
//    if(po!=value){
//        $('#'+elementId).css({"background-color":"#eef"});
//    }
//    else
//        $('#'+elementId).css({"background-color":""});
//    $('#'+elementId).html(value+" ");
//}
//
//function updateUmlageFormular(data){
//                        if(data.checkStelle==1)
//                            checkMessage = "<br><b>Daten in TAB : umlage_erg aktualisiert</b>";
//                        else
//                            checkMessage = "<br><font color='#f00'><b>Daten in TAB : umlage_erg wurden NICHT aktualisiert !<br>Fehler in umlage werten Summe (%<>100 oder Absolutwert stimmt nicht)</b></font>";
//                        zprava = "stelle: "+data.stelle
//                                +"<br>elementId: "+data.elementId
//                                +checkMessage;
//                        $("#messages").html(zprava);
//                        //upravim hodnoty umlagen
//                        var citac = 0;
//                        var innerCounter=0;
//                        $('#'+data.umlagen1ID+' td').each(function(){
//                            // zajimaji me jen od tretiho elementu dal
//                            if(citac>1){
//                                $(this).html(data.umlagen1Content[innerCounter++]);
//                            }
//                            citac++;
//                        });
//
//                        //upravim hodnoty umlagen2
//                        citac = 0;
//                        innerCounter=0;
//                        $('#'+data.umlagen2ID+' td').each(function(){
//                            // zajimaji me jen od tretiho elementu dal
//                            if(citac>1){
//                                $(this).html(data.umlagen2Content[innerCounter++]);
//                            }
//                            citac++;
//                        });
//
//                        //umlage1 values
//                        $.each(data.umlage1ValuesID,function(n,value){
//                            $('#'+value).html(data.umlage1ValuesContent[n].toString());
//                        });
//
//                        //umlage2 values
//                        $.each(data.umlage2ValuesID,function(n,value){
//                            $('#'+value).html(data.umlage2ValuesContent[n].toString());
//                        });
//
//                        //umlageGesamt values
//                        $.each(data.umlageGesamtValuesID,function(n,value){
//                            $('#'+value).html(data.umlageGesamtValuesContent[n].toString());
//                        });
//
//                        //holding kosten
//                        $('#'+data.kostenVerteilungHoldingID).html(data.kostenVerteilungHoldingContent.toString());
//
//                        //schluessel2
//                        $('#'+data.schluessel2tdID).html(data.schluessel2tdContent);
//
//}
//
//function addDruckoptionenHandler(){
//    $('div#druckoptionen input[type=checkbox]').click(function(event){
//        var acturl = $(this).attr('acturl');
//        // pomoci ajaxu si vytahnu aktualni nastaveni drucku
//        $.post(acturl,
//                {
//                    field: $(this).attr('id'),
//                    value: $(this).attr('checked')
//                },
//                function(data){
////                    message = data.toSource();
////                    $('div#planbabinfo').html(message+$('div#planbabinfo').html());
//                },
//                'json'
//        );
//
////        alert('id:'+$(this).attr('id')+" value:"+$(this).attr('checked'));
//    });
//}


function js_validate_float(control)
{

	var hodnota = control.value

	re = /,/
	novahodnota=hodnota.replace(re,".");

	floatvalue = parseFloat(novahodnota);

	if(!isNaN(floatvalue)&&(floatvalue>=0))
	{
		control.value=floatvalue;
		control.style.backgroundColor='';
	}
	else
	{
		//chyba validace
		control.style.backgroundColor='red';
		//failed.className='error';
		//failed.value=error_description;
	}
}

function js_validate_float_real(control)
{

	var hodnota = control.value

	re = /,/
	novahodnota=hodnota.replace(re,".");

	floatvalue = parseFloat(novahodnota);

	if(!isNaN(floatvalue))
	{
		control.value=floatvalue;
		control.style.backgroundColor='';
                return 1;
	}
	else
	{
		//chyba validace
		control.style.backgroundColor='red';
		//failed.className='error';
		//failed.value=error_description;
                return 0;
	}
}

function js_validate_float_between(control,von,bis)
{
        var validatedOk = 0;
	var hodnota = control.value

	re = /,/
	novahodnota=hodnota.replace(re,".");

	floatvalue = parseFloat(novahodnota);

	if(!isNaN(floatvalue))
	{
            if((floatvalue>=von) && (floatvalue<=bis)){
		control.value=floatvalue;
		control.style.backgroundColor='';
                validatedOk = 1;
            }
            else{
                control.style.backgroundColor='red';
            }
	}
	else
	{
		//chyba validace
		control.style.backgroundColor='red';
		//failed.className='error';
		//failed.value=error_description;
	}

        return validatedOk;
}
