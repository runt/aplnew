
//------------------------------------------------------------------------------
// DOM ready handler jQuery
$(document).ready(function(){

    //oznacit prvky formulare, kde se bude zadavat datum
    
    $('#frmedataanwfilter-datum').attr('class','datepicker');
    
    
    $.datepicker.setDefaults($.datepicker.regional["de"]);
    $(".datepicker" ).datepicker($.datepicker.regional["de"]);
    
    $('#frmedataanwfilter-datum').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        // smazu aktualni obsah divu
        $('#edataanwtable').html('<h3>zpracovavam pozadavek ...</h3>');
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            persnr: $('#frmedataanwfilter-persnr').val()
        },
        function(data){
            updateDatumFilter(data);
        },
        'json'
        );
    });

    $('td input[id^=ins_]').click(function(event){
            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var value = $(this).val();
        
            underscorePos = id.indexOf('_', 0);
            restId = id.substr(underscorePos,id.length-underscorePos);
        
            // vybrat vsechny radky z tabulky, ktere maji id like 668
            likeID='tr[id*=r'+restId+'_]';
            
//            $(likeID).css({'background-color':'green'});
            var oeArray = new Array();
            var vonArray = new Array();
            var bisArray = new Array();
            var pauseArray = new Array();
            var ridArray = new Array();
            
            $(likeID).each(function(index){
               ridArray[index]=$(this).attr('id');
               oeArray[index]=$(this).find('td[id^=oe_]').html();
               vonArray[index]=$(this).find('input[id^=von_]').val();
               bisArray[index]=$(this).find('input[id^=bis_]').val();
               pauseArray[index]=$(this).find('input[id^=pause_]').val();
               $(this).css({'background-color':'greenyellow'});
            });

            $.post(acturl,
            {
                id:id,
                datum: $('#frmedataanwfilter-datum').val(),
                likeID: likeID,
                oeArray: oeArray,
                vonArray: vonArray,
                bisArray: bisArray,
                pauseArray: pauseArray,
                ridArray: ridArray,
                restId: restId
            },
            function(data){
                updateInsertAnwesenheitAll(data);
            },
            'json'
            );
        });

        $('#frmedataanwfilter-persnr').change(function(event){
        var id = $(this).attr('id');
        var acturl = $(this).attr('acturl');
        var value = $(this).val();
        
        if(value.length==0){
            $(this).val('*');
        }
        // smazu aktualni obsah divu
        $('#edataanwtable').html('<h3>zpracovavam pozadavek ...</h3>');
        $.post(acturl,
        {
            id:id,
            value: $(this).val(),
            datum: $('#frmedataanwfilter-datum').val()
        },
        function(data){
            updateDatumFilter(data);
        },
        'json'
        );
    });
    
    $('td input[id^=von_]').attr('readonly','readonly');
    $('td input[id^=bis_]').attr('readonly','readonly');
    $('td input[id^=pause_]').attr('readonly','readonly');
        
//    $('td input[id^=pause_]').css({'background-color':'green'});
//    $('td input[id^=von_]').change(function(event){
//        id = $(this).attr('id');
//        validateVonBis(id);
//    });
//    $('td input[id^=bis_]').change(function(event){
//        id = $(this).attr('id');
//        validateVonBis(id);
//    });
//    $('td input[id^=pause_]').change(function(event){
//        id = $(this).attr('id');
//        validateFloat(id);
//    });


});


// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------
function validateFloat(elementId){
    	var hodnota = $('#'+elementId).val();
        underscorePos = elementId.indexOf('_', 0);
        restId = elementId.substr(underscorePos,elementId.length-underscorePos);

	re = /,/
	novahodnota=hodnota.replace(re,".");

	floatvalue = parseFloat(novahodnota);

	if(!isNaN(floatvalue)&&(floatvalue>=0))
	{
		$('#'+elementId).val(floatvalue);
                $('#'+elementId).css({'background-color':''});
                $('#insert'+restId).attr('disabled','');
	}
	else
	{
		//chyba validace
		$('#'+elementId).css({'background-color':'red'});
                $('#insert'+restId).attr('disabled','disabled');
	}
}

function validateVonBis(elementId){
        //alert('validateVonBis '+elementId);
	var e = $("#"+elementId);
        value = e.val();
        //alert(value);
        validated = true;

        underscorePos = elementId.indexOf('_', 0);
        restId = elementId.substr(underscorePos,elementId.length-underscorePos);
        
	var hodiny,minuty;
	if(value.length==4)
	{
            //jen pridam dvojtecku mezi hodiny a minuty
		hodiny=e.val().substr(0,2);
		minuty=e.val().substr(2,2);
                if((hodiny<24) && (hodiny>=0) && (minuty>=0) && (minuty<60)){
                    e.val(hodiny+":"+minuty);
                }
                else{
                    e.val('');
                    validated = false;
                }
        }
        else if(value.length==5){
            //jen zkontroluu hodnoty hodin a minut
            	hodiny=e.val().substr(0,2);
		minuty=e.val().substr(3,2);
                if((hodiny<24) && (hodiny>=0) && (minuty>=0) && (minuty<60)){
                    e.val(hodiny+":"+minuty);
                }
                else{
                    e.val('');
                    validated = false;
                }
        }
        else{
            e.val('');
            validated = false;
        }
        
        // pokud bude validated false zakazu tlacitko insert, jinak ho povolim
        if(validated==false){
            $('#insert'+restId).attr('disabled','disabled');
        }
        else{
            $('#insert'+restId).attr('disabled','');
        }
}

function updateInsertAnwesenheitAll(data){
        $('#'+data.id).hide();
        $.each(data.anwArray,function(index,hodnoty){
            i = '#tid_'+hodnoty["rid"].substr(2, hodnoty["rid"].length-2);
            $(i).html(data.iA[index]["stunden"]);
        });
}
function updateInsertAnwesenheit(data){
    if(data.result==1){
        $('#'+data.id).hide();
        $('#'+data.id).parent().css({'text-align':'right'});
        $('#'+data.id).parent().html(data.stunden);
    }
}
    
function updateDatumFilter(data){
    if(data.edataanwtableContent.length==0){
        $('#edataanwtable').html("<h3>zadna data</h3>");
    }
    else{
        $('#edataanwtable').html(data.edataanwtableContent);
        
        // a priradit udalostni procedury
        $('td input[id^=ins_]').click(function(event){
            var id = $(this).attr('id');
            var acturl = $(this).attr('acturl');
            var value = $(this).val();
            underscorePos = id.indexOf('_', 0);
            restId = id.substr(underscorePos,id.length-underscorePos);
            // vybrat vsechny radky z tabulky, ktere maji id like 668
            likeID='tr[id*=r'+restId+'_]';
            var oeArray = new Array();
            var vonArray = new Array();
            var bisArray = new Array();
            var pauseArray = new Array();
            var ridArray = new Array();
            $(likeID).each(function(index){
                ridArray[index]=$(this).attr('id');
                oeArray[index]=$(this).find('td[id^=oe_]').html();
                vonArray[index]=$(this).find('input[id^=von_]').val();
                bisArray[index]=$(this).find('input[id^=bis_]').val();
                pauseArray[index]=$(this).find('input[id^=pause_]').val();
                $(this).css({
                    'background-color':'greenyellow'
                });
            });
            $.post(acturl,
            {
                id:id,
                datum: $('#frmedataanwfilter-datum').val(),
                likeID: likeID,
                oeArray: oeArray,
                vonArray: vonArray,
                bisArray: bisArray,
                pauseArray: pauseArray,
                ridArray: ridArray,
                restId: restId
            },
            function(data){
                updateInsertAnwesenheitAll(data);
            },
            'json'
            );
        });

        $('td input[id^=von_]').attr('readonly','readonly');
        $('td input[id^=bis_]').attr('readonly','readonly');
        $('td input[id^=pause_]').attr('readonly','readonly');


    }
}

