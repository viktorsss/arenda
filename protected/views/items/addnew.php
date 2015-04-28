<h2><span class="digit">1.</span> Самое главное</h2>
<div class="content-filter with-fixed-block">
    <div class="fixed-block">
	<div class="content-white rating" style="display: none;">
            <p class="title">Рейтинг вашего объекта</p>
            <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
            </span><!-- end stars -->
            <p>Чем больше информации об объекте вы запоняете, тем выше его рейтинг.</p>
	</div>
	<div class="content-white">
            <p class="heading"><span class="digit">1.</span> Самое главное</p>
            <p>Если вам лень или некогда заполните только этот блок. Модератор свяжется с вами по телефону и уточнит детали. Имейте виду что подробно заполненные объявления имеют более высокий рейтинг и показываются выше в результатах поиска.</p>
	</div>
    </div><!-- end fixed-block -->
</div><!-- end content-filter -->
<form action="" method="POST" id="addProdForm">
    <div class="main-content with-filter">
	<div class="content-white">
	    <p class="comment">Пожалуйста, введите информацию об объекте для его размещения в каталоге недвижимости. <span class="required-text"><span class="mark">*</span>- поля обязательные к заполнению</span></p>
	    <ul class="request-data-list">
		<li>
		    <span class="label">Я хочу:</span>
		    <div class="right-part new-request-popup"><a href="#" class="request-title add-popup-link">Квартиры</a></div>
		</li>
		<li class="roomsCount">
		    <span class="label">Кол-во комнат:</span>
		    <div class="right-part">
			<ul class="rooms-list">
			    <li><label class="radio"><input type="radio" name="rooms-number" value="1" />1</label></li>
			    <li><label class="radio"><input type="radio" name="rooms-number" value="2" />2</label></li>
			    <li><label class="radio"><input type="radio" name="rooms-number" value="3" />3</label></li>
			    <li><label class="radio"><input type="radio" name="rooms-number" value="4" />4</label></li>
			    <li><label class="radio"><input type="radio" name="rooms-number" value="5" />5</label></li>
			    <li><label class="radio"><input type="radio" name="rooms-number" value="40" />5+</label></li>
			</ul>
		    </div>
		</li>
		<li>
		    <span class="label textarea-label">Заголовок рекламного текста:</span>
		    <div class="right-part">
			<textarea id="titleReklText" class="small" name="addnew[slogan]" maxlength="90" placeholder="Опишите вашу недвижимость с выгодной стороны..."></textarea>
			<span class="symbols" id="outTitleRekText">90 осталось</span>
		    </div>
		</li>
		<li>
		    <span class="label">В городе: <span class="mark">*</span></span>
		    <div class="right-part">
			<input id="city" type="text" class="rfield" name="addnew[city]" value="<?php echo $this->city_name; ?>" />
		    </div>
		</li>
		<li>
		    <span class="label">В районе<span class="mark">*</span>:</span>
		    <div class="right-part">
			<input id="out_rayon" class="rfield" type="text" name="addnew[rayon]" />
			<input id="out_rayon_id" type="hidden" name="addnew[rayon_id]" />
			<a href="#" class="with-tooltip"><i class="icon-42"></i><span class="tooltip">Введите первые буквы названия района где находиться объект</span></a>
		    </div>
		</li>
		<li>
		    <span class="label">На улице<span class="mark">*</span>:</span>
		    <div class="right-part">
			<input id="out_street" class="rfield" type="text" name="addnew[street]" value="" />
			<input id="out_street_id" type="hidden" name="addnew[street_id]" value="" />
			<a href="#" class="with-tooltip"><i class="icon-42"></i><span class="tooltip">Введите первые буквы названия улицы</span></a>
		    </div>
		</li>
		<li>
		    <span class="label">В доме<span class="mark">*</span>:</span>
		    <div class="right-part">
			<label class="small-input"><input type="text" class="rfield" name="addnew[house]" value=""/></label>
		    </div>
		    <div class="clear"></div>
		</li>
		<li>
		    <span class="label">Корпус:</span>
		    <div class="right-part">
			<label class="small-input"><input type="text" name="addnew[housing]" value=""/></label>
		    </div>
		</li>
	    </ul><!-- end request-data-list -->
	</div><!-- end content-white -->
	<div class="map-container request-map-wrap">
	    <a href="#" class="button show-hide-link"><span class="open">Открыть карту <i class="icon-24"></i></span><span class="close">Закрыть карту <i class="icon-9"></i></span></a>
	    <div class="map-wrap hidden-block" style="display:none">
		<div class="map-shadow"></div>
		<div class="map" id="request-map"></div>
		<div class="map-info">
		    <div class="markers-instruction">
			<div class="markers">
			    <div class="marker">
				<i class="marker-green"></i>
				<p>Выставлен на основе введенного адреса. Яндекс сообщает о полном соответствии позиции маркера с введенным адресом.</p>
				<div class="clear"></div>
			    </div>
			    <div class="marker">
				<i class="marker-red"></i>
				<p>Выставлен на основе введенного адреса. Яндекс сообщает, что не смог найти указанный адрес и маркер выставляется на ближайшем найденном объекте.</p>
				<div class="clear"></div>
			    </div>
			    <div class="marker last">
				<i class="marker-blue"></i>
				<p>Передвинут пользователем вручную.</p>				
				<div class="clear"></div>
			    </div>
			</div>
			<p class="comment">Если в Вашем объявлении неверно указан адрес на карте, перетяните маркер вручную, чтобы указать наиболее точное месторасположение вашего объекта и маркер станет голубым.</p>
		    </div><!-- end markers-instruction -->
		</div><!-- end map-info -->
		<a href="#" class="open-legend" data-dist="277"><i class="icon-4"></i><i class="icon-5"></i></a>
	    </div><!-- end map-wrap  -->
	    <!-- div class="map-details">
		<img src="/images/hot-advert-img.jpg" alt="" />
		<div class="details">
		    <a href="#" class="name">Деловой центр</a>
		    <p class="address">ул. Малышева, 36</p>
		    <p class="question">Ваше помещение расположено <br/>в данном бизнес центре?</p>
		    <div class="answer">
			<a href="#" class="button">Да</a>
			<a href="#" class="button">Нет</a>
		    </div>
		</div>
		<div class="clear"></div>
	    </div --><!-- end map-details -->
	</div><!-- request-map-wrap -->
	<div class="content-white">
	    <ul class="request-data-list with-margin">
		<?php echo $this->actionGetOneStepFields(7); ?>
		<li class="firstField">
		    <span class="label">Площадь, м<sup>2</sup><span class="mark">*</span>:</span>
		    <div class="right-part">
			<label class="meter-input"><input id="area" name="addnew[area]" type="text" class="rfield" /></label>
		    </div>
		</li>
		<li>
		    <span class="label">Стоимость, руб.<span class="mark">*</span>:</span>
		    <div class="right-part">
			<label class="price-input with-details"><input id="price" name="addnew[price]" type="text" class="rfield" /></label>
			<ul class="radio-wrap">
			    <li><label class="radio"><input type="radio" value="1" id="onekv" name="radio-price" />За м<sup>2</sup></label></li>
			    <li><label class="radio checked"><input type="radio" value="2" id="allkv" name="radio-price" checked="checked"/>За все</label></li>
			</ul>
			<a class="with-tooltip" href="#"><i class="icon-42"></i><span class="tooltip">Укажите общую стоимоcть объекта в цифрах. Если Вы не заполните или заполните некорректно это поле (фиктивная и нереальная цена), Ваше объявление не будет размещено</span></a>
		    </div>
		</li>
		<li>
		    <span class="label">Комиссия агента, %<span class="mark">*</span>:</span>
		    <div class="right-part">
			<label class="small-input with-details"><input type="text" id="komprice" class="rfield" name="addnew[komprice]" /></label>
			<ul class="radio-wrap">
			    <li><label class="radio"><input type="radio" value="1" id="yeskom" name="radio-commission" />Да</label></li>
			    <li><label class="radio checked"><input type="radio" value="0" id="nokom" name="radio-commission" checked="checked"/>Нет</label></li>
			</ul>
		    </div>
		</li>
	    </ul>
	    <p class="summary-text" style="display: none;">Итого стоимость аренды: <b><span id="allPrice"></span> руб.</b> <span class="comment">(<span id="summPropis"></span>)</span></p>
	    <p class="summary-text" style="display: none;">Коммисия агента: <b><span id="komAgent"></span>%</b> = <b><span id="sumAgent"></span> руб.</b> <span class="comment">(<span id="summKomPropis"></span>)</span></p>
	    <p class="comment small">Если вам лень или некогда заполните только этот блок. Модератор свяжется с вами по телефону и уточнит детали. Имейте виду что подробно заполненные объявления имеют более высокий рейтинг и показываются выше в результатах поиска.</p>
	</div><!-- end content-white -->
	<h2><span class="digit">2.</span> Фотографии</h2>
	<div class="content-white">
	    <div class="request-pictures" id="ajax-file-upload">
		<div class="request-pictures-main">
		    <span class="title">Обложка</span>
		    <a href="#" class="add-new file-input"><i class="icon-1"></i></a>
		    <!-- div class="img-wrap">
			<img src="images/request-img-big.jpg" alt="" />
			<a href="#" class="delete"><i class="icon-6"></i></a>
		    </div-->
		</div>
		<div class="request-more-pictures">
		    <span class="title">Второстепенные фотографии</span>
		    <ul>
			<li>
			    <a href="#" class="add-new file-input"><i class="icon-1"></i></a>
			</li>
			<li>
			    <a href="#" class="add-new file-input"><i class="icon-1"></i></a>
			</li>
			<li>
			    <a href="#" class="add-new file-input"><i class="icon-1"></i></a>
			</li>
			<li>
			    <a href="#" class="add-new file-input"><i class="icon-1"></i></a>
			</li>
		    </ul>
		</div><!-- end request-more-pictures -->
		<div class="clear"></div>
	    </div><!-- end request-pictures -->
	</div><!-- end content-white -->
	<?php /* ?>
	  <div class="content-white">
	  <div class="request-pictures" id="ajax-file-upload">
	  <div class="request-more-pictures">
	  <span class="title" id="otherImgTitle" style="display: none;">Второстепенные фотографии</span>
	  <ul class="file-list">
	  <li class="addImg">
	  <a href="#" class="add-new file-input" name="image"><i class="icon-1"></i></a>
	  </li>
	  </ul>
	  </div><!-- end request-more-pictures -->
	  <div class="clear"></div>
	  </div><!-- end request-pictures -->
	  </div><!-- end content-white -->
	  <?php */ ?>
	<p class="recommend-note">Подробо описанные характеристикипривлекают больше внимания.<br/>Заполните как можо подробнее дополнительную информацию и у вашего объявления будет максимальный рейтинг.</p>
	<div class="services-and-conditions-wrap">
	    <a href="#" class="button services-and-conditions-link show-hide-link"><span class="digit">3. </span><span class="open">Открыть самое интересное <i class="icon-24"></i></span> <span class="close">Закрыть самое интересное <i class="icon-9"></i></span></a>
	    <div class="content-white hidden-block">
		<div class="services-and-conditions">
		    <div class="sac_checkbox_list"><?php echo $this->actionGetThreeStepFields(7); ?></div>
		    <div class="clear"></div>
		    <p class="info">Дополнительная информация</p>
		    <span class="symbols" id="addInf_view">500 осталось</span>
		    <textarea class="small" id="addInf_textarea" name="addnew[addInf]" maxlength="500" id="addInf" placeholder="Здесь вы можете уточнить или добавить детали объекта..."></textarea>
		</div><!-- services-and conditions -->
	    </div><!-- end content-white -->
	</div><!-- end services-and conditions-wrap -->

	<h2><span class="digit">4.</span> Вот и все</h2>
	<div class="request-personal">
	    <?php echo $this->renderPartial("steps/_step4"); ?>
	</div><!-- end request-personal -->
    </div><!-- end main-content -->
    <div class="clear"></div>
</form>

<script type="text/javascript" src="/js/ajaxupload.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
	
	$("#ajax-file-upload li").each(function() {
	    ajaxFileUploadInit(this);
	});
	
	$('#out_rayon').autocomplete({
	    serviceUrl: '<?php echo $this->createUrl('items/selectrayon', array('name_city' => $this->city_name)); ?>', // Страница для обработки запросов автозаполнения
	    minChars: 1, // Минимальная длина запроса для срабатывания автозаполнения
	    delimiter: /(,|;)\s*/, // Разделитель для нескольких запросов, символ или регулярное выражение
	    maxHeight: 400, // Максимальная высота списка подсказок, в пикселях
	    width: 316, // Ширина списка
	    zIndex: 9999, // z-index списка
	    deferRequestBy: 300, // Задержка запроса (мсек), на случай, если мы не хотим слать миллион запросов, пока пользователь печатает. Я обычно ставлю 300.
	    onSelect: function (data, value) {
		//data = data.data.split('-');
		$("#out_rayon_id").val(data.data);
	    },
	});
	$('#out_street').autocomplete({
	    serviceUrl: '<?php echo $this->createUrl('items/selectstreet', array('name_city' => $this->city_name)); ?>', // Страница для обработки запросов автозаполнения
	    minChars: 1, // Минимальная длина запроса для срабатывания автозаполнения
	    delimiter: /(,|;)\s*/, // Разделитель для нескольких запросов, символ или регулярное выражение
	    maxHeight: 400, // Максимальная высота списка подсказок, в пикселях
	    width: 316, // Ширина списка
	    zIndex: 9999, // z-index списка
	    deferRequestBy: 300, // Задержка запроса (мсек), на случай, если мы не хотим слать миллион запросов, пока пользователь печатает. Я обычно ставлю 300.
	    onSelect: function (data, value) {
		//data = data.data.split('-');
		$("#out_street_id").val(data.data);
	    },
	});


    });

    function ajaxFileUploadInit(node) {
	var name = $(node).find(".file-input").attr("name");
	$(node).find(".file-input").attr("name", "");
	$(node).find(".file-input").attr("_name", name);

	uploader = new AjaxUpload($(node).find(".file-input"), {
	    action: "<?php echo $this->createUrl('items/upload'); ?>",
	    name: "upload",
	    data: {
		settings: $(node).find(".file-settings").attr("value")
	    },
	    autoSubmit: true,
	    responseType: "json",
	    onSubmit: function () {
		$(node).find(".file-loading").show();
	    },
	    onComplete: function (fileNode, r) {
		$(node).find(".file-loading").hide();
		//alert(r); return;
		if (r.error) {
		    alert(r.error + "\n\nКод ошибки: " + r.error_code);
		    return;
		}
		ajaxFileUploadListAdd(node, r);
		$(fileNode).attr("value", "");
	    }
	});
    }

    function ajaxFileUploadListAdd(node, file) {
	//alert(file.url);
	//if (typeof file != "object")
	//    return;

	var div = $(node);
	var name = div.find(".file-input").attr("_name");
	var html;
	var thumb = file;

	if (file.image) {
	    //alert('dgsdfgdf');
	    var defaultKey = div.find(".file-default-key").attr("value");

	    if (file.resizes) {
		var thumb_found = false;

		for (var i = 0; i < file.resizes.length; i++) {
		    var resize = file.resizes[i];
		    if (resize.key == defaultKey) {
			thumb_found = true;
			thumb = resize;
			break;
		    }
		}

		if (!thumb_found && file.resizes.length) {
		    thumb = file.resizes[0];
		}
	    }

	    html = '<img src="' + thumb.url + '" />';
	} else {
	    html = "<a target=\"_blank\" href=\"" + thumb.url + "\">" + thumb.filename + "</a>";
	}

	html += '<span class="delete"><i class="icon-6"></i></span>';

	if ($('#ajax-file-upload').hasClass('qqq')) {
	    $(".addImg").before('<li class="file-list-item img-wrap">' + html + '<a href="#" class="make-main">Сделать главной</a></li>');
	} else {
	    x = $('#ajax-file-upload').html();
	    $('#ajax-file-upload').html('<div class="request-pictures-main"><span class="title">Обложка</span><div class="img-wrap"><img width="186" height="140" src="' + thumb.url + '" alt="" /><span class="delete"><i class="icon-6"></i></span></div></div>' + x);
	    $("#ajax-file-upload").addClass('qqq');
	    $("#otherImgTitle").show();
	}
	imageCleanUrl = thumb.url.split("/");
	$.post("/items/setparam?p=image&id=" + imageCleanUrl[3] + "&array=1");
	ajaxFileUploadInit("#ajax-file-upload");
    }

    /* data.status
     * 0 - не вошедший
     * 1 - вошедший
     * 2 - 
     */
    $(function () {
	var stat = 0;
	var interval = setInterval(function () {
	    $.get("<?php echo CHtml::encode($this->createUrl('items/stateuser')); ?>",
		    {},
		    function (data) {
			data = data.status;
			if ((data == 1) && (stat == 0)) {
			    stat = 1;
			    url = "<?php echo $this->createUrl('items/viewloginuser'); ?>";
			    $.post(url, function (data) {
				$('.request-personal').html(data);
			    });
			    //clearInterval(interval);
			}
			if ((data == 0) && (stat == 1)) {
			    stat = 0;
			    url = "<?php echo $this->createUrl('items/viewnologinuser'); ?>";
			    $.post(url, function (data) {
				$('.request-personal').html(data);
			    });
			}
		    }, 'json');
	}, 2000);

	$(document).on('click', ".without-registration", function () {
	    url = "<?php echo $this->createUrl('items/withoutreg'); ?>";
	    $.post(url, function (data) {
		$('.request-personal').html(data);
	    });
	});
	//return false;
    });
</script>