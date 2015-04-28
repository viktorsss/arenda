<?php
$id = Yii::app()->request->getParam('id');

$m_image = Images::model()->findAllByAttributes(array('item_id' => $id));
?>
<div class="extra-blocks">
    <h5>Офис расположен в БЦ</h5>
    <a href="#" class="hot-advert">
	<img src="/images/hot-advert-img.jpg" alt="" />
	<span class="title">Деловой центр</span>
	<span class="address">ул. Малышева, 36</span>
    </a><!-- end hot-advert -->
    <a href="#" class="advert"><img src="/images/advert-1.jpg" alt="" /></a>
    <a href="#" class="advert small"></a>
</div><!-- end extra-blocks -->
<div class="main-content big-margin">
    <h2><?php echo @Streets::model()->findByAttributes(array('id' => $model->street))->name ?> <span class="comment">Объявление: № <?php echo $model->id ?></span></h2>
    <div class="object-page">
	<div class="object-slider">
	    <div class="slides">
		<?php foreach ($m_image as $item) { ?>
		<div class="slide"><img src="/images/upload/<?php echo $item->name; ?>" alt="" style="max-height:500px; max-width: 587px; margin: auto; width: auto;" /></div>
		<?php } ?>
	    </div>
	    <ul class="pagination">
		<?php foreach ($m_image as $key => $item) { ?>
		<li><a href="#" <?php if ($key == 0) { ?>class="current"<?php } ?>><img src="/images/upload/resize/<?php echo CImage::getCashImg($item->name, 117); ?>" alt="" /><span></span></a></li>
		<?php } ?>
	    </ul>
	</div><!-- end object-slider -->
	<ul class="object-features">
	    <?php echo $fields; ?>
	</ul><!-- end object-featured -->
	<div class="info">
	    <p><?php echo $model->about; ?></p>
	</div>
	<div id="map" class="map"></div>
    </div><!-- end object-page -->
</div><!-- end main-content -->
<div class="clear"></div>
<div class="banner-box" style="min-height:120px"><a href="#" style="display:none;"></a></div>

<h2>Похожие предложения <!-- a href="#" class="comment">всего 8 объектов</a --></h2>
<ul class="object-list">
    <li>
	<a href="#" class="object-preview">
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	    <img src="/images/object-1.jpg" alt="" />
	    <b>Шоссе Энтузиастов, 21</b>
	    <span class="comment">Коммерческое помещение</span>
	    <span class="details">
		<span>Цена: 6 200 000 руб.</span>
		<span>Общая площадь: 31.1 м²</span>
		<span class="comment">Цена за м²: 199 000 руб.</span>
	    </span>
	</a><!-- end object-preview -->
    </li>
    <li>
	<a href="#" class="object-preview">
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	    <img src="/images/object-1.jpg" alt="" />
	    <b>Шоссе Энтузиастов, 21</b>
	    <span class="comment">Коммерческое помещение</span>
	    <span class="details">
		<span>Цена: 6 200 000 руб.</span>
		<span>Общая площадь: 31.1 м²</span>
		<span class="comment">Цена за м²: 199 000 руб.</span>
	    </span>
	</a><!-- end object-preview-->
    </li>
    <li>
	<a href="#" class="object-preview">
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	    <img src="/images/object-1.jpg" alt="" />
	    <b>Шоссе Энтузиастов, 21</b>
	    <span class="comment">Коммерческое помещение</span>
	    <span class="details">
		<span>Цена: 6 200 000 руб.</span>
		<span>Общая площадь: 31.1 м²</span>
		<span class="comment">Цена за м²: 199 000 руб.</span>
	    </span>
	</a><!-- end object-preview-->
    </li>
    <li>
	<a href="#" class="object-preview">
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	    <img src="/images/object-1.jpg" alt="" />
	    <b>Шоссе Энтузиастов, 21</b>
	    <span class="comment">Коммерческое помещение</span>
	    <span class="details">
		<span>Цена: 6 200 000 руб.</span>
		<span>Общая площадь: 31.1 м²</span>
		<span class="comment">Цена за м²: 199 000 руб.</span>
	    </span>
	</a><!-- end object-preview-->
    </li>
</ul><!-- end object-list -->