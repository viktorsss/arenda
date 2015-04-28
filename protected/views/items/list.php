<h2>Горячие предложения <!-- a href="#" class="comment">всего 30 объектов</a --></h2>
<ul class="object-list">
    <?php foreach ($hot as $item) { 
	$image = CSite::getImages($item->id, 1);
	?>
    <li>
	<a href="#" class="object-preview">
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	    <img src="/images/upload/resize/<?php echo CImage::getCashImg($image, 186); ?>" alt="" />
	    <b><?php echo @Streets::model()->findByAttributes(array('id' => $item->street))->name. ", " . $item->house ?></b>
	    <span class="comment"><?php echo ($item->functionality < 7) ? "Коммерческое помещение" : "Жилое помещение"; ?></span>
	    <span class="details">
		<span>Цена: <?php echo (int)$item->price ?> руб.</span>
		<span>Общая площадь: <?php echo (int)$item->area ?> м²</span>
		<span class="comment">Цена за <?php echo ($item->type_price == 1) ? "м²" : "все"; ?>: <?php echo $item->price; ?> руб.</span>
	    </span>
	</a><!-- end object-preview -->
    </li>
    <?php } ?>
</ul><!-- end object-list -->

<h2>Результат поиска "<?php echo Func::model()->findByPk(Yii::app()->request->getParam('id'))->name; ?>" <a href="#" class="comment">всего <span class="count_list"><?php echo $count;  ?></span> объектов</a></h2>
<div class="content-filter">
    <div class="unit">
	<h4>Вид</h4>
	<ul class="view">
	    <li><label class="checked">Список <i class="icon-34"></i><input type="radio" checked name="view" value="list" /></label></li>
	    <li><label>Карта <i class="icon-35"></i><input type="radio" name="view" value="cart" /></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Показано объектов</h4>
	<span class="shown"><?php echo $count;  ?> из <?php echo $count;  ?></span>
	<a href="#" class="button refresh">Обновить список <i class="icon-36"></i></a>
    </div>
    <div class="unit">
	<h4>Показывать по</h4>
	<ul class="show">
	    <li><label class="checked">7<input type="radio" name="show" value="7" checked /></label></li>
	    <li><label>14<input type="radio" name="show" value="14" /></label></li>
	    <li><label>21<input type="radio" name="show" value="21" /></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Сортировать</h4>
	<div class="select-wrap">
	    <input type="hidden" name="search[sort]" value="created" />
	    <div class="select">
		<span class="title">Дата</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li class="sort-list" data-value="price">Стоимость</li>
		<li class="sort-list" data-value="created">Дата</li>
		<li class="sort-list" data-value="hits">Рейтинг</li>
	    </ul>
	</div>
	<h5>Порядок</h5>
	<div class="select-wrap">
	    <input type="hidden" name="search[orders]" value="DESC" />
	    <div class="select">
		<span class="title">По убыванию</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li class="orders-list" data-value="DESC">По убыванию</li>
		<li class="orders-list" data-value="ASC">По возрастанию</li>
	    </ul>
	</div>
    </div>
</div><!-- content-filter -->

<div class="main-content with-filter">
    <ul id="search_object" class="search-object">
        <?php foreach ($model as $item) {
            if($item->slogan != "") {
                $about = "";
                $str = explode(' ', $item->slogan);
                for($i = 0; (($i < 10) && ($i < count($str))); $i++) {$about .= $str[$i]." ";}
            } else {
                $about = "Подробнее";
            }
	    $image = CSite::getImages($item->id, 1);
        ?>
	<li class="search-object-item">
	    <div class="main-info">
		<div class="image"><img src="/images/upload/resize/<?php echo CImage::getCashImg($image, 186); ?>" alt=""  class="object-img"/></div>
		<div class="object-details">
		    <p class="intro">
			<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>"><span><?php echo $about."..."; ?></span></a>
			<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" target="_blank"><i class="icon-43"></i></a>
		    </p>	
		    <div class="cols">
			<div>
			    <b><?php echo @Districts::model()->findByAttributes(array('id' => $item->district))->name; ?></b>
			    <b><?php echo @Streets::model()->findByAttributes(array('id' => $item->street))->name. ", " . $item->house ?></b>
			    <b>Цена: <?php echo (int)$item->price ?> руб.</b>
			    <span>Общая площадь: <?php echo (int)$item->area ?> м<sup>2</sup></span>
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
		<ul class="action-list">
		    <li><a href="#"><i class="icon-13"></i></a></li>
		    <li><a href="#"><i class="icon-14"></i></a></li>
		    <li><a href="#"><i class="icon-15"></i></a></li>
		    <li><a href="#" class="show-extra"><i class="icon-24"></i><i class="icon-9"></i></a></li>
		</ul>
	    </div><!-- end main-info -->
	    <div class="extra-info">
		<div class="right-block">
		    <a href="#" class="button show-hide-link">Поделиться</a>
		    <ul class="social-share hidden-block">
			<li><a href="#"><i class="icon-17"></i></a></li>
			<li><a href="#"><i class="icon-18"></i></a></li>
			<li><a href="#"><i class="icon-19"></i></a></li>
			<li><a href="#"><i class="icon-20"></i></a></li>
		    </ul>
		</div>
		<div class="left-block">
		    <div class="account-card">
			<?php $m_user = Users::model()->findByPk($item->owner_id); ?>
			<img src="<?php echo $m_user->photo; ?>" alt="" />
			<div class="details">
			    <p class="account-name">
				<a href="<?php echo $this->createUrl('users/profileitemlist', array('id' => $item->owner_id)); ?>" class="name">
				<span class="first-name"><?php echo $m_user->name; ?></span>
				<span class="last-name"><?php echo $m_user->so_name; ?></span>
				</a>
			    </p>
			    <table class="objects-rating">
				<tr><td>Объектов</td><td><?php echo CSite::getCountObjUser($item->owner_id); ?></td></tr>
				<tr><td>Рейтинг</td><td>+0</td></tr>
			    </table>
			</div>
		    </div><!-- end account-card -->
		    <div class="info">
			<span>Объявление: № <?php echo $item->id; ?></span>
			<span>Смотрели: <?php echo $item->hits; ?></span>
			<span>Фотографий: <?php echo count(CSite::getImages($item->id)); ?></span>
			<span>Размещено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yy', $item->created); ?></span>
			<span>Активно до: </span>
		    </div>
		</div>
		<div class="clear"></div>
		<div class="complain advanced-icon hidden-wrap">
		    <a href="#"><i class="icon-16"></i></a>
		    <ul class="advanced-list hidden">
			<li><a href="#">Скрытые комиссии</a></li>
			<li><a href="#">Неактуальный объект</a></li>
			<li><a href="#">Неадекватное поведение</a></li>
			<li><a href="#">Ложная информация</a></li>
			<li><a href="#">Нарушение закона или правил</a></li>
			<li><a href="#">Не оставлять жалобу</a></li>
		    </ul>
		</div>
	    </div><!-- end extra-info -->
	</li>
        <?php } ?>
    </ul><!-- end search-object -->
    <input type="hidden" name="search[upMore]" id="upMoreInput" value="0" />
    <a href="#" class="button bottom-button" id="upMore"><i class="icon-12"></i>Загрузить еще объекты</a>
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
    $(document).ready(function() {
	
    });
    
    $(function() {
	
    });
</script>