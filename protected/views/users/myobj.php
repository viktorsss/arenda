<h2>Мои объекты<span class="comment">всего <?php echo count($model); ?> объектов</span></h2>
<div class="content-filter">
    <div class="unit">
	<h4>Тип сделки</h4>
	<ul class="view">
	    <li><label>Продажа <!-- span>18</span --><input type="radio" checked name="deal-type"></label></li>
	    <li><label>Аренда <!-- span>3</span --><input type="radio" name="deal-type"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Вид помещения</h4>
	<ul class="view">
	    <li><label>Жилое <!-- span>10</span --><input type="radio" checked name="estate-type"></label></li>
	    <li><label>Коммерческое <!-- span>8</span --><input type="radio" name="estate-type"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Тип помещения</h4>
	<div class="select-wrap">
	    <input type="hidden" name="" value="" />
	    <div class="select">
		<span class="title">Офисное</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="test1">Офисное</li>
		<li data-value="test2">Складское</li>
		<li data-value="test3">Общепит</li>
		<li data-value="test4">Автомастерская</li>
	    </ul>
	</div>
    </div>
    <div class="unit">
	<h4>Показывать по</h4>
	<ul class="show">
	    <li><label>7<input type="radio" name="show" checked ></label></li>
	    <li><label>14<input type="radio" name="show"></label></li>
	    <li><label>21<input type="radio" name="show"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Состояние</h4>
	<div class="select-wrap">
	    <input type="hidden" name="" value="" />
	    <div class="select">
		<span class="title">Все</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="test1">Все</li>
		<li data-value="test2">Все</li>
	    </ul>
	</div>
	<h4>Город</h4>
	<div class="select-wrap">
	    <input type="hidden" name="" value="" />
	    <div class="select">
		<span class="title">Все</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="test1">Все</li>
		<li data-value="test2">Санкт-Петербург</li>
		<li data-value="test3">Воронеж</li>
		<li data-value="test4">Краснодар</li>
	    </ul>
	</div>
    </div>
</div><!-- content-filter -->
<div class="main-content with-filter">
    <ul class="search-object">
	<?php foreach ($model as $item) { ?>
    	<li class="search-object-item">
    	    <div class="main-info">
		    <?php $image = CSite::getImages($item->id, 1); ?>
		    <?php if (!isset($image)) { ?>
			<div class="image no-image">Нет фотографий</div>
		    <?php } else { ?>
			<div class="image"><img src="<?php echo $image; ?>" alt=""  class="object-img"/></div>
		    <?php } ?>
    		<div class="object-details">
    		    <p class="intro"><a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)); ?>"><span><?php echo $item->slogan; ?></span><i class="icon-43"></i></a></p>	
    		    <div class="cols">
    			<div>
    			    <b><?php echo @Districts::model()->findByAttributes(array('id' => $item->district))->name; ?></b>
    			    <b><?php echo @Streets::model()->findByAttributes(array('id' => $item->street))->name ?></b>
    			    <b>Цена: <?php echo (int) $item->price ?> руб.</b>
    			    <span>Общая площадь: <?php echo (int) $item->area ?> м<sup>2</sup></span>
    			    <span class="stars">
    				<span class="full"></span>
    				<span class="full"></span>
    				<span class="full"></span>
    				<span class="full"></span>
    				<span class="full"></span>
    			    </span><!-- end stars -->
    			</div>
    			<div>
    			    <span class="commission">Комиссия <?php echo $item->komprice; ?>%</span>
    			    <span>Цена за <?php echo ($item->type_price == 1) ? "м²" : "все"; ?>: <?php echo $item->price; ?> руб.</span>
    			    <!-- span>Комнат: 1</span>
    			    <span>Этаж: 3 | Этажность: 18</span -->
    			</div>
    		    </div>
    		</div>
    		    <!-- li><a href="#"><i class="icon-29"></i></a></li>
    		    <li><a href="#"><i class="icon-27"></i></a></li>
    		    <li><a href="#"><i class="icon-28"></i></a></li -->
    		<ul class="action-list">
			<?php
			switch ($item->status) {
			    case 0:
				$link[0] = '<a href="#" class="moder-play" id="mp-' . $item->id . '"><i class="icon-29"></i></a>';
				$link[1] = '<a href="#" id="p-' . $item->id . '" class="pause chosen"><i class="icon-27"></i></a>';
				break; // DeActive
			    case 3:
				$link[0] = '<a href="#" class="moderation-icon"><i class="loader"></i></a>';
				$link[1] = '<a href="#" class="chosen"><i class="icon-27"></i></a>';
				break; // Moderate
			    case 6:
				$link[0] = '<a href="#" id="mp-' . $item->id . '" class="moder-play chosen"><i class="icon-29"></i></a>';
				$link[1] = '<a href="#" id="p-' . $item->id . '" class="pause"><i class="icon-27"></i></a>';
				break; // Publ
			}
			?>
    		    <li><?php echo $link[0]; ?></li>
    		    <li><?php echo $link[1]; ?></li>
    		    <li><a href="<?php echo $this->createUrl('items/updateitem', array('id' => $item->id)); ?>"><i class="icon-28"></i></a></li>
    		    <li class="hidden-wrap">
    			<a href="#"><i class="icon-30"></i></a>
    			<div class="hidden"><a href="#" class="button confirm">Подтвердить</a></div>
    		    </li>
    		</ul>
    	    </div><!-- end main-info -->
    	    <div class="extra-info visible">
    		<div class="buttons">
    		    <a href="#" class="button">Добавить в "Горячие"</a>
    		    <a href="#" class="button">Выделить объявление</a>
    		</div>
    		<div class="info">
    		    <span>Объявление: № <?php echo $item->id; ?></span>
    		    <span>Смотрели: <?php echo $item->hits; ?></span>
    		    <span>Фотографий: <?php echo count(CSite::getImages($item->id)); ?></span>
    		    <span>Размещено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yy', $item->created); ?></span>
    		    <span>Активно до: </span>
    		</div>
    		<div class="lastcol">
			<?php if ($item->status == 3) { ?><span class="moderation"><i class="loader"></i>На модерации</span><?php } ?>
    		    <span><i class="icon-16"></i>Жалобы <b>0</b></span>
    		    <span><i class="icon-31"></i>Вопросы <b>0</b></span>
    		</div>
    		<div class="clear"></div>
    	    </div><!-- endd extra-info -->
    	</li>
	<?php } ?>
    </ul><!-- end search-object -->
    <a href="#" class="button bottom-button"><i class="icon-12"></i>Загрузить еще объекты</a>
    <!-- div class="content-pagination-wrap">
	<ul class="content-pagination">
	    <li><a href="#" class="prev"><i class="icon-22"></i>Предыдущая</a></li>
	    <li><a href="#" class="active">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">5</a></li>
	    <li><a href="#">6</a></li>
	    <li><a href="#">7</a></li>
	    <li><a href="#">8</a></li>
	    <li><a href="#">9</a></li>
	    <li><a href="#">...</a></li>
	    <li><a href="#" class="next">Следующая<i class="icon-23"></i></a></li>
	</ul><!-- end content-pagination ->
    </div><!-- end content-pagination-wrap -->
</div><!-- end main-content -->
<div class="clear"></div>

<script type="text/javascript">
    $(function () {
	var publ_url = "/users/publitem?id=";
	var paus_url = "/users/pauseitem?id=";
	$(document).on("click", ".moder-play", function () {
	    data = $(this).attr('id').split("-");
	    if ($(this).hasClass('chosen')) {
		$("#p-" + data[1]).addClass('chosen');
		$(this).removeClass('chosen');
		$.post(paus_url + data[1], function (out) {
		    alert(out);
		});
	    } else {
		$("#p-" + data[1]).removeClass('chosen');
		$(this).addClass('chosen');
		$.post(publ_url + data[1], function (out) {
		    alert(out);
		});
	    }
	});

	$(document).on("click", ".pause", function () {
	    data = $(this).attr('id').split('-');
	    if ($(this).hasClass('chosen')) {
		$("#mp-" + data[1]).addClass('chosen');
		$(this).removeClass('chosen');
		$.post(publ_url + data[1], function (out) {
		    alert(out);
		});
	    } else {
		$("#mp-" + data[1]).removeClass('chosen');
		$(this).addClass('chosen');
		$.post(paus_url + data[1], function (out) {
		    alert(out);
		});
	    }
	});
    });
</script>