<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<title></title>

	<!-- Данное значение часто используют поисковые системы, заполняем ответственно -->
	<meta name="description" content="" />

	<!-- Адаптируем страницу для мобильных устройств -->
	<meta name="viewport" content="width=1280, maximum-scale=2.0" />

	<!-- Традиционная иконка сайта, размер 16x16, прозрачность поддерживается. Рекомендуемый формат: .ico -->
	<link rel="shortcut icon" href="favicon.ico" />

	<!-- Иконка сайта для устройств от Apple, рекомендуемый размер 114x114, прозрачность не поддерживается -->
	<link rel="apple-touch-icon" href="apple-touch-icon.png" />

	<!-- Подключаем файлы стилей -->
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.arcticmodal-0.3.css" />

	<!-- Скрипты -->
	<script type="text/javascript" src="/js/modernizr.custom.js"></script> <!-- Определение возможностей браузера -->
	<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="/js/jquery.arcticmodal-0.3.min.js"></script>
        <script type="text/javascript" src="/js/string.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
	<script type="text/javascript" src="/js/addNew.js"></script>
	<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        
        
</head>

<body>
    <?php echo $this->renderPartial('/layouts/_regionSearchReq'); ?>
	<div class="wrapper with-sidebar-icon">
            <?php echo $content; //var_dump(Yii::app()->session['addProd']); ?>
		<div class="clear"></div>
		<div class="right-sidebar">
			<div class="right-sidebar-links">
				<a href="#" class="to-top"><i class="icon-9"></i>Вверх</a>
				<a href="#" class="operator-link">Задать вопрос</a>
				<a href="#" class="information-link"><i class="icon-8"></i></a>
			</div>
		</div><!-- end right-sidebar -->
	</div> <!-- end wrapper -->
	
	<section id="shadow"></section>
	<?php // echo $this->renderPartial('/layouts/_regent_block'); ?>
	
	<section class="popup add-popup">
		<div class="container">
			<a href="#" class="close"><i class="icon-6"></i></a>
			<p class="title">Выберите тип объекта</p>
			<div class="add-table">
				<ul class="column" id="typeRent">
				    <li><a id="trans-1" href="#" class="active">Сдать</a></li>
					<li><a id="trans-2" href="#">Продать</a></li>
				</ul>
				<ul class="column" id="typeFunc">
					<li><a id="catid-2" href="#" class="active">Жилую недвижимость</a></li>
					<li><a id="catid-1" href="#">Коммерческую недвижимость</a></li>
				</ul>
				<ul class="column" id="func">
                                    <?php foreach(Func::model()->findAllByAttributes(array('catid' => 2)) as $key => $item) { ?>
					<li><a id="func-<?php echo $item->id; ?>" href="#" <?php echo (!$key) ? "class='active'" : ""; ?>><?php echo $item->name ?></a></li>
                                    <?php } ?>
				</ul>
			</div>
			<a href="#" class="button center">Применить</a>
		</div> <!-- end container -->
	</section><!-- end popup -->
	<script type="text/javascript">
            $(document).ready(function(){
                $('#typeRent a').click(function() {
                    data = $(this).attr('id').split('-');
                    
                    $.post("/items/setparam?p=trans&id="+data[1]+"&arr=0");
                    
                    $("#typeRent .active").removeClass('active');
                    $(this).addClass("active");
                });
                
                $('#typeFunc a').click(function() {
                    $("#typeFunc .active").removeClass('active');
                    $(this).addClass("active");
                    
                    data = $(this).attr('id').split('-');
                    
                    url = "/items/getfunc?id="+data[1];
                    $.post( url, function( data ) {
                        $('#func').html(data);
                    });
                });
                
                $(document).on('click', '#func a', function() {
                    $("#func .active").removeClass('active');
                    $(this).addClass("active");
                    
                    data = $(this).attr('id').split('-');
                    
                    url = "/items/setparam?p=typeobj&id="+data[1];
                    $.post(url);
                });
                
                $('.add-popup .button').click(function() {
                    $('.request-title').text($('#func .active').text());
                    $('.add-popup').hide('slow');
                    $("#shadow").hide('slow');
                    
                    $(".addFields").remove();
                    $(".roomsCount").html("");
		    $(".sac_checkbox_list").html("");
                    
                    data = $('#func .active').attr('id').split("-");
                    //alert();
                    
                    // Choose Rooms
                    url = "/items/preroom?id="+data[1];
                    $.post( url, function( data ) {
                        if(data == 1) {
                            $(".roomsCount").html('<span class="label">Кол-во комнат:</span>' +
                                '<div class="right-part">' +
                                    '<ul class="rooms-list">' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="1" />1</label></li>' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="2" checked="checked"/>2</label></li>' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="3" />3</label></li>' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="4" />4</label></li>' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="5" />5</label></li>' +
                                        '<li><label class="radio"><input type="radio" name="rooms-number" value="40" />5+</label></li>' +
                                    '</ul>' +
                                '</div>'
                            );
                        }
                    });
                    // ----------------
                    
                    url = "/items/getonestepfields?id="+data[1];
                    $.post(url, function(data) {
                        $(".firstField").before(data);
                    });
                    
                    url = "/items/getthreestepfields?id=" + data[1];
                    $.post(url, function(data) {
                        $(".sac_checkbox_list").html(data);
                    });
                });
            });
	ymaps.ready(init);
        var myMap, 
            myPlacemark

        function init(){ 
            myMap = new ymaps.Map("request-map", {
                center: [55.76, 37.64],
                zoom: 13,
				controls: ['smallMapDefaultSet']
            }); 
            
            myPlacemark = new ymaps.Placemark([55.76, 37.64], {}, {
				iconLayout: 'default#image',
				iconImageHref: '/images/placemark.png',
				iconImageSize: [29, 40]
			});
            
            myMap.geoObjects.add(myPlacemark);
		}
                
            $(document).on('click', ".vk", function() {
                var newWin = window.open("https://oauth.vk.com/authorize?<?php echo CSite::skrepka('vk'); ?>", 'example', 'width=656,height=329,left=' + (screen.availWidth - 656)/2 + ',top=' + (screen.availHeight - 328)/2);
                newWin.focus();
            });
   </script>
   <?php // var_dump(Yii::app()->session['addProd']); ?>
</body>
</html>