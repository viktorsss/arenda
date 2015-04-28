<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container">
    <a href="#" class="close"><i class="icon-6"></i></a>
    <p class="title">Выберите тип объекта</p>
    <div class="add-table">
	<ul class="column" id="col_id1">
            <li><a href="#" class="active">Сдать</a></li>
            <li><a href="#">Продать</a></li>
	</ul>
	<ul class="column" id="col_id2">
            <li><a href="#">Жилую недвижимость</a></li>
            <li><a href="#" class="active">Коммерческую недвижимость</a></li>
	</ul>
	<ul class="column" id="col_id3">
            <li><a href="#">Офисное помещение</a></li>
            <li><a href="#">Торговое помещение</a></li>
            <li><a href="#">Складское помещение</a></li>
            <li><a href="#">Автосервис помещение</a></li>
            <li><a href="#">Общепит</a></li>
            <li><a href="#">Открытая площадка</a></li>
	</ul>
    </div>
    <a href="#" class="button center">Применить</a>
</div> <!-- end container -->

<script type="text/javascript"> 
    $("a.link_cat, a.back_cat").on("click", function() {
	data = $(this).attr('id').split('-');
	url = "/product/catalog?id="+data[1]+"&sec="+data[2];
	$.post( url, function( data ) {
	    $('#catlog_elements').html(data);
	});
    });
</script>