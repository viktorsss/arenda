<div class="profile minified personal-extended">
    <div class="account-card">
	<img src="<?php echo $m_user->photo; ?>" alt="" />
	<div class="details">
	    <p class="account-name">
		<span class="first-name"><?php echo $m_user->name; ?><span class="icon-pro">PRO</span></span>
		<span class="last-name"><?php echo $m_user->so_name; ?></span>
	    </p>
	    <table class="objects-rating">
		<tr><td>Объектов</td><td>0</td></tr>
	    </table>
	    <div class="spinbox">
		<p>Рейтинг</p>
		<a href="#" class="minus"><i class="icon-25"></i></a>
		<span class="value">0</span>
		<a href="#" class="plus"><i class="icon-1"></i></a>
	    </div> 
	    <p><b><?php echo $m_user->slogan; ?></b></p>
	    <a href="#" class="button">Написать сообщение</a>
	</div>
    </div><!-- end account-card -->
    <div class="personal-data">
	<ul>
            <li><span>Город:</span><b><?php echo $m_user->city; ?></b></li>
            <li><span>Телефон:</span><b><?php echo $m_user->phone; ?> <br/> 
		    <?php foreach ($phones as $item) {
			echo $item->value . "<br/>";
		    } ?></b></li>
            <li><span>E-mail:</span><b><?php echo $m_user->e_mail ?></b></li>
	    <?php foreach ($contacts as $item) { ?>
    	    <li><span><?php echo $item->name; ?>:</span><b><?php echo $item->value; ?></b></li>
<?php } ?>
	</ul>
    </div><!-- end personal-data -->
    <div class="personal-data right">
	<?php $str = explode("\n", $m_user->promotext); ?>
	<p><?php echo implode("<br/>", $str); ?></p>
	<?php
	if (isset($in_comp)) {
	    $company = UsersCompany::model()->findByPk($in_comp->comp_id);
	    ?>
    	<p class="works-for"><b>Работает в компании:</b><a href="#" class="company-name"> <?php echo $company->organization; ?> <img src="<?php echo $company->photo_org; ?>" alt="" /></a></p>
<?php } ?>
    </div>
    <div class="clear"></div>
</div><!-- end profile -->
<h2>Размещенные объекты<span class="comment">всего <?php echo Items::model()->count('owner_id = ' . $m_user->id); ?> объектов</span></h2>
<div class="content-filter">
    <div class="unit">
	<h4>Тип сделки</h4>
	<ul class="view">
	    <li><label class="checked">Продажа <!-- span>18</span --><input type="radio" checked name="deal-type"></label></li>
	    <li><label>Аренда <!-- span>3</span --><input type="radio" name="deal-type"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Вид помещения</h4>
	<ul class="view">
	    <li><label class="checked">Жилое <!-- span>10</span --><input type="radio" checked name="estate-type"></label></li>
	    <li><label>Коммерческое <!-- span>8</span --><input type="radio" name="estate-type"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Показано объектов</h4>
	<span class="shown">0 из 0</span>
    </div>
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
	<div class="select-wrap">
	    <input type="hidden" name="" value="created" />
	    <div class="select">
		<span class="title">Дата</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="price">Стоимость</li>
		<li data-value="created">Дата</li>
		<li data-value="hits">Рейтинг</li>
	    </ul>
	</div>

	<h5>Порядок</h5>
	<div class="select-wrap">
	    <input type="hidden" name="" value="DESC" />
	    <div class="select">
		<span class="title">По убыванию</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="DESC">По убыванию</li>
		<li data-value="ASC">По возрастанию</li>
	    </ul>
	</div>
    </div>
</div><!-- content-filter -->

<div class="main-content with-filter">
    <ul class="search-object">
<?php foreach ($m_item as $item) { 
    $image = CSite::getImages($item->id, 1);
    ?>
    	<li class="search-object-item">
    	    <div class="main-info">
		<div class="image"><img src="/images/upload/resize/<?php echo CImage::getCashImg($image, 186); ?>" alt=""  class="object-img"/></div>
    		<div class="object-details extended">
    		    <p class="intro"><a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)); ?>"><span><?php echo $item->slogan; ?></span><i class="icon-43"></i></a></p>	
    		    <div class="cols">
    			<div>
    			    <b><?php echo @Districts::model()->findByPk($item->district)->name; ?></b>
    			    <b>Шоссе Энтузиастов, 21</b>
    			    <b>Цена: <?php echo $item->price; ?> руб.</b>
    			    <span>Общая площадь: <?php echo $item->area ?> м<sup>2</sup></span>
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
    			<div class="right-block">
    			    <b>Поделиться</b>
    			    <ul class="social-share lightdark">
    				<li><a href="#"><i class="icon-17"></i></a></li>
    				<li><a href="#"><i class="icon-18"></i></a></li>
    				<li><a href="#"><i class="icon-19"></i></a></li>
    				<li><a href="#"><i class="icon-20"></i></a></li>
    			    </ul>
    			    <table class="extra-data">
    				<tr>
    				    <td>Объявление: № <?php echo $item->id; ?></td>
				    <td>Размещено: <?php echo Yii::app()->dateFormatter->format('dd-MM-yyyy', $item->created); ?></td>
    				</tr>
    				<tr>
    				    <td>Смотрели: <?php echo $item->hits; ?></td>
    				    <td>Активно до: </td>
    				</tr>
    				<tr>
    				    <td>Фотографий: <?php echo count(CSite::getImages($item->id)); ?></td>
    				    <td></td>
    				</tr>
    			    </table>
    			</div>
    			<span class="clear"></span>
    		    </div>
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
    	    </div><!-- end main-info -->
    	</li>
<?php } ?>
    </ul><!-- end search-object -->
    <a href="#" class="button bottom-button"><i class="icon-12"></i>Загрузить еще объекты</a>
</div><!-- end main-content -->
<div class="clear"></div>