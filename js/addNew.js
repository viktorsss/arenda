    $(document).ready(function() {
	$(document).on('click', 'span.delete', function(){
	    $(this).parent().remove();
	});

	stringcut("#titleReklText", "#outTitleRekText");
	stringcut("#addInf_textarea", "#addInf_view");

	$(".fb").click(function() {
	    alert("Тут может быть ваша реклама))))"); 
	});

	$(".tw").click(function() {
	    alert("Тут может быть ваша реклама))))"); 
	});

    
	$('#area, #price, #onekv, #allkv, #komprice, #yeskom, #nokom').on('change keyup keydown',function() {
            summ = 1;
            komsumm = 0;
            area = $('#area').val();
            price = $('#price').val().replace(/\s+/g, '');
            onekv = $('#onekv').val();
            allkv = $('#allkv').val();
            komprice = $('#komprice').val();
            yeskom = $('#yeskom').val();
            nokom = $('#nokom').val();
            
            
            //alert(allkv.length);
            if((area.length != 0) && (price.length != 0) && ($('#onekv').is(':checked'))) {
                summ = parseInt(area) * parseInt(price);
                //$('#allPrice').text(summ);
            }
            if($('#allkv').is(":checked")) {
                summ = parseInt(price);
            }
            if((komprice.length != 0) && ($('#yeskom').is(':checked'))) {
                komsumm = parseInt(komprice) * parseInt(summ) / 100;
            }
	    
            $('#allPrice').text(summ);
            $('#komAgent').text(komprice);
            $('#sumAgent').text(komsumm);
            
            url = '/items/getnumbworlds?char='+summ;
            $.post( url, function( data ) {
                $('#summPropis').html(data);
            });
            
            url = '/items/getnumbworlds?char='+komsumm;
            $.post( url, function( data ) {
                $('#summKomPropis').html(data);
            });
        });
	
	$('#price').on('keyup change',function() {
	    $(".summary-text").show('slow');
	});
	
	
    });