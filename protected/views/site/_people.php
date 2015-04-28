<div class="extra-blocks">
    <a href="#" class="hot-advert">
	<img src="/images/hot-advert-img.jpg" alt="" />
	<span class="title">Деловой центр</span>
	<span class="address">ул. Малышева, 36</span>
    </a><!-- end hot-advert -->
    <a href="#" class="hot-advert">
	<img src="/images/hot-advert-img.jpg" alt="" />
	<span class="title">Деловой центр</span>
	<span>ул. Малышева, 36</span>
    </a><!-- end hot-advert -->
    <a href="#" class="advert"><img src="/images/advert-1.jpg" alt="" /></a>
    <a href="#" class="advert small"></a>
</div><!-- end extra-blocks -->

<div class="main-content big-margin">
    <h2>Люди и фирмы</h2>
    <div class="content-filter">
	<div class="unit">
	    <ul class="view">
		<li><label class="checked">Люди<input type="radio" checked name="radio-people"></label></li>
		<li><label>Фирмы<input type="radio" name="radio-people"></label></li>
	    </ul>
	</div>
	<div class="unit"><a href="#" class="button refresh">Обновить список <i class="icon-36"></i></a></div>
	<div class="unit">
	    <h4>Показывать по</h4>
	    <ul class="show">
		<li><label class="checked">7<input type="radio" name="show" checked ></label></li>
		<li><label>14<input type="radio" name="show"></label></li>
		<li><label>21<input type="radio" name="show"></label></li>
	    </ul>
	</div>
	<div class="unit">
	    <h4>Сортировать</h4>
	    <h5>Дата</h5>
	    <div class="select-wrap">
		<input type="hidden" name="" value="" />
		<div class="select">
		    <span class="title">По убыванию</span>
		    <a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
		</div>
		<ul class="option-list">
		    <li data-value="1">По убыванию</li>
		    <li data-value="2">По возрастанию</li>
		</ul>
	    </div>
	    <h5>Рейтинг</h5>
	    <div class="select-wrap">
		<input type="hidden" name="" value="" />
		<div class="select">
		    <span class="title">По убыванию</span>
		    <a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
		</div>
		<ul class="option-list">
		    <li data-value="1">По убыванию</li>
		    <li data-value="2">По возрастанию</li>
		</ul>
	    </div>
	</div>
    </div><!-- content-filter -->

    <div class="main-content with-filter">
	<ul class="representatives">
	    <?php foreach ($model as $item) { ?>
	    <li>
		<div class="account-card">
		    <img src="<?php echo $item->photo; ?>" alt="" />
		    <div class="details">
			<p class="account-name">
			    <a href="<?php echo $this->createUrl('users/profileitemlist', array('id' => $item->id)) ?>" class="name">
			    <span class="first-name"><?php echo $item->name; ?></span>
			    <span class="last-name"><?php echo $item->so_name; ?></span>
			    </a>
			</p>
			<table class="objects-rating">
			    <tr><td>Объектов</td><td><?php echo CSite::getCountObjUser($item->id); ?></td></tr>
			    <tr><td>Рейтинг</td><td>+0</td></tr>
			</table>
			<p class="slogan"><b><?php echo $item->slogan; ?></b></p>
		    </div>
		    <div class="clear"></div>
		</div><!-- end account-card -->
		<div class="right-block">
		    <b>Поделиться</b>
		    <ul class="social-share dark">
			<li><a href="#"><i class="icon-17"></i></a></li>
			<li><a href="#"><i class="icon-18"></i></a></li>
			<li><a href="#"><i class="icon-19"></i></a></li>
			<li><a href="#"><i class="icon-20"></i></a></li>
		    </ul>
		</div>
		<ul class="action-list">
		    <li><a href="#"><i class="icon-13"></i></a></li>
		    <li><a href="#"><i class="icon-14"></i></a></li>
		    <li><a href="#"><i class="icon-15"></i></a></li>
		    <li class="complain advanced-icon hidden-wrap">
			<a href="#"><i class="icon-16"></i></a>
			<ul class="advanced-list left hidden">
			    <li><a href="#">Скрытые комиссии</a></li>
			    <li><a href="#">Неактуальный объект</a></li>
			    <li><a href="#">Неадекватное поведение</a></li>
			    <li><a href="#">Ложная информация</a></li>
			    <li><a href="#">Нарушение закона или правил</a></li>
			    <li><a href="#">Не оставлять жалобу</a></li>
			</ul>
		    </li>
		</ul>
	    </li>
	    <?php } ?>
	</ul>
	<a href="#" class="button bottom-button"><i class="icon-12"></i>Загрузить еще объекты</a>
    </div><!-- end main-content -->
    <div class="clear"></div>
</div><!-- end main-content -->
<div class="clear"></div>