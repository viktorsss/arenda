<div class="extra-blocks">
    <a href="#" class="hot-advert">
	<img src="images/hot-advert-img.jpg" alt="" />
	<span class="title">Деловой центр</span>
	<span class="address">ул. Малышева, 36</span>
    </a><!-- end hot-advert -->
    <a href="#" class="hot-advert">
	<img src="images/hot-advert-img.jpg" alt="" />
	<span class="title">Деловой центр</span>
	<span>ул. Малышева, 36</span>
    </a><!-- end hot-advert -->
    <div class="widget-vk">


	<!-- VK Widget -->
	<div id="vk_groups"></div>
	<script type="text/javascript">
	    VK.Widgets.Group("vk_groups", {mode: 0, width: "240", height: "250"}, 54921886);
	</script>
    </div>
    <div class="widget-fb"><img src="images/widget-fb.jpg" alt="" /></div>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id))
		return;
	    js = d.createElement(s);
	    js.id = id;
	    js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    <a href="#" class="object-card" style="display:none">
	<span class="title">
	    <span>Продажа</span>
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	</span>
	<img src="images/object-1.jpg" alt="" />
	<b>Шоссе Энтузиастов, 21</b>
	<span class="comment">Коммерческое помещение</span>
	<span class="details">
	    <span>Цена: 6 200 000 руб.</span>
	    <span>Общая площадь: 31.1 м²</span>
	</span>
    </a><!-- end object-card -->
    <a href="#" class="object-card" style="display:none">
	<span class="title">
	    <span>Продажа</span>
	    <span class="stars">
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
		<span class="full"></span>
	    </span><!-- end stars -->
	</span>
	<img src="images/object-1.jpg" alt="" />
	<b>Шоссе Энтузиастов, 21</b>
	<span class="comment">Коммерческое помещение</span>
	<span class="details">
	    <span>Цена: 6 200 000 руб.</span>
	    <span>Общая площадь: 31.1 м²</span>
	</span>
    </a><!-- end object-card -->
    <a href="#" class="person-card" style="display:none">
	<span class="info">
	    <img src="images/avatar-1.jpg" alt="" />
	    <span class="details">
		<span>Объектов</span>
		<span class="amount">571</span>
		<span>Рейтинг</span>
		<span class="amount">+57</span>
	    </span>
	</span>
	<b class="name">Шашков Александр</b>
	<span class="text">Приветствую всех на моей странице! Наша комания занимается реализацией вашей недвижимости...</span>
	<span class="more">Подробнее ></span>
    </a><!-- end person-card -->
</div><!-- end extra-blocks -->

<div class="main-content">
    <div class="column">
	<h2>Клуб профессионалов</h2>
	<dl class="tabs">
	    <dt class="selected">Люди</dt>
	    <dd class="selected">
		<ul class="club-list">
		    <?php
		    $command = Yii::app()->db->createCommand();
		    $items = $command->select('users.id, users.name, users.so_name, users.photo')->from(array('items', 'users'))->where("users.id = items.owner_id AND users.organization ='' AND type = 1 AND photo != '' AND items.city = '$this->city_name'")->group('users.id')->limit('8')->queryAll();
		    foreach ($items as $item) {
			?>
    		    <li>
    			<a href="<?php echo $this->createUrl('users/profileitemlist', array('id' => $item['id'])); ?>" class="img-wrap"><img src="<?php echo $item['photo'] ?>" alt="" /><span></span></a>
    			<div class="info">
    			    <a href="<?php echo $this->createUrl('users/profileitemlist', array('id' => $item['id'])); ?>" class="name"><span><?php echo $item['name']; ?></span><span><?php echo $item['so_name']; ?></span></a>
    			    <table class="objects-rating">
    				<tr><td>Объектов</td><td><?php echo CSite::getCountObjUser($item['id']) ?></td></tr>
    				<tr><td>Рейтинг</td><td></td></tr>
    			    </table>
    			</div>
    		    </li>
		    <?php } ?>
		</ul>
		<a href="<?php echo $this->createUrl('site/people'); ?>" class="button"><i class="icon-43"></i>Смотреть все</a>
		<a href="#" class="button"><i class="icon-43"></i>Как сюда попасть?</a>
	    </dd>
	    <dt>Фирмы</dt>
	    <dd>
		<ul class="club-list">
		    <?php
		    $command = Yii::app()->db->createCommand();
		    $items = $command->select('users.id, users.name, users.so_name')->from(array('items', 'users'))->where("users.id = items.owner_id AND users.organization !='' AND items.city = '$this->city_name'")->group('users.id')->limit('8')->queryAll();
		    foreach ($items as $item) {
			?>
    		    <li>
    			<a href="#" class="img-wrap"><img src="<?php echo $item->photo; ?>" alt="" /><span></span></a>
    			<div class="info">
    			    <a href="#" class="name"><span><?php echo $item['name']; ?></span><span><?php echo $item['so_name']; ?></span></a>
    			    <table class="objects-rating">
    				<tr><td>Объектов</td><td><?php echo CSite::getCountObjUser($item['id']) ?></td></tr>
    				<tr><td>Рейтинг</td><td></td></tr>
    			    </table>
    			</div>
    		    </li>
		    <?php } ?>
		</ul>
		<a href="<?php echo $this->createUrl('site/people'); ?>" class="button"><i class="icon-43"></i>Смотреть все</a>
		<a href="#" class="button"><i class="icon-43"></i>Как сюда попасть?</a>
	    </dd>			
	</dl>
    </div><!-- end column -->
    <div class="column">
	<h2>Новые предложения</h2>
	<div class="switcher-box">
	    <label>
		<input type="checkbox" class="switcher"/>
		<span class="business">Коммерческая недвижимость</span>
		<span class="private">Жилая недвижимость</span>
	    </label>
	</div><!-- end switcher-box -->
	<dl id="komerc" class="tabs">
	    <dt class="selected">Аренда</dt>
	    <dd class="selected">
		<div class="scroll-column scroll-pane">
		    <ul class="newcomers-list">
			<?php
			$cr = new CDbCriteria();
			$cr->condition = "city = :city AND trans = :trans AND status = :status AND functionality < :func";
			$cr->params = array(
			    ':city' => $this->city_name,
			    ':trans' => 1,
			    ':status' => 6,
			    ':func' => 7
			);
			$cr->limit = 10;
			foreach (Items::model()->findAll($cr) as $item) {
			    $image = CSite::getImages($item->id, 1);
			    ?>
    			<li>
    			    <a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="img-wrap">
    				<img src="/images/upload/resize/<?php echo CImage::getCashImg($image, 93) ?>" alt="" /><span></span>
    			    </a>
    			    <div class="info">
    				<ul class="stars">
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				</ul><!-- end stars -->
    				<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="main"><span><?php echo (int) $item->area ?>м<sup>2</sup></span><span><?php echo (int) $item->price ?> руб.</span></a>
    				<span><?php echo @Districts::model()->findByAttributes(array('id' => $item->district))->name; ?></span>
    				<span><?php echo @Streets::model()->findByAttributes(array('id' => $item->street))->name. ", " . $item->house ?></span>
    			    </div>
    			</li>
			<?php } ?>
		    </ul>
		</div><!-- end scroll-pane-->
		<a href="#" class="button add-popup-link"><i class="icon-43"></i>Разместить ваш объект тут</a>
	    </dd>
	    <dt>Продажа</dt>
	    <dd>
		<div class="scroll-column scroll-pane">
		    <ul class="newcomers-list">
			<?php
			$cr->params = array(
			    ':city' => $this->city_name,
			    ':trans' => 2,
			    ':status' => 6,
			    ':func' => 7
			);
			$cr->limit = 10;
			foreach (Items::model()->findAll($cr) as $item) {
			    ?>
    			<li>
    			    <a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="img-wrap"><img src="<?php echo CSite::getImages($item->id, 1) ?>" alt="" /><span></span></a>
    			    <div class="info">
    				<ul class="stars">
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				</ul><!-- end stars -->
    				<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="main"><span>45м<sup>2</sup></span><span>15000 руб.</span></a>
    				<span>Академический</span>
    				<span>ул. Павла Шаманова, 32</span>
    			    </div>
    			</li>
			<?php } ?>
		    </ul>
		</div><!-- end scroll-pane-->
		<a href="#" class="button add-popup-link"><i class="icon-43"></i>Разместить ваш объект тут</a>
	    </dd>			
	</dl>
	<dl id="nokomerc" class="tabs" style="display: none;">
	    <dt class="selected">Аренда</dt>
	    <dd class="selected">
		<div class="scroll-column scroll-pane">
		    <ul class="newcomers-list">
			<?php
			$cr->condition = "city = :city AND trans = :trans AND status = :status AND functionality > :func";
			$cr->params = array(
			    ':city' => $this->city_name,
			    ':trans' => 1,
			    ':status' => 6,
			    ':func' => 6
			);
			$cr->limit = 10;
			foreach (Items::model()->findAll($cr) as $item) {
			    $image = CSite::getImages($item->id, 1);
			    ?>
    			<li>
    			    <a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="img-wrap">
    				<img src="/images/upload/resize/<?php echo CImage::getCashImg($image, 93) ?>" alt="" /><span></span>
    			    </a>
    			    <div class="info">
    				<ul class="stars">
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				</ul><!-- end stars -->
    				<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="main"><span><?php echo (int) $item->area ?>м<sup>2</sup></span><span><?php echo (int) $item->price ?> руб.</span></a>
    				<span><?php echo @Districts::model()->findByAttributes(array('id' => $item->district))->name; ?></span>
    				<span><?php echo @Streets::model()->findByAttributes(array('id' => $item->street))->name ?></span>
    			    </div>
    			</li>
			<?php } ?>
		    </ul>
		</div><!-- end scroll-pane-->
		<a href="#" class="button add-popup-link"><i class="icon-43"></i>Разместить ваш объект тут</a>
	    </dd>
	    <dt>Продажа</dt>
	    <dd>
		<div class="scroll-column scroll-pane">
		    <ul class="newcomers-list">
			<?php
			$cr->params = array(
			    ':city' => $this->city_name,
			    ':trans' => 2,
			    ':status' => 6,
			    ':func' => 6
			);
			$cr->limit = 10;
			foreach (Items::model()->findAll($cr) as $item) {
			    ?>
    			<li>
    			    <a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="img-wrap"><img src="<?php echo CSite::getImages($item->id, 1) ?>" alt="" /><span></span></a>
    			    <div class="info">
    				<ul class="stars">
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				    <li class="full"></li>
    				</ul><!-- end stars -->
    				<a href="<?php echo $this->createUrl('items/details', array('id' => $item->id)) ?>" class="main"><span>45м<sup>2</sup></span><span>15000 руб.</span></a>
    				<span>Академический</span>
    				<span>ул. Павла Шаманова, 32</span>
    			    </div>
    			</li>
			<?php } ?>
		    </ul>
		</div><!-- end scroll-pane-->
		<a href="#" class="button add-popup-link"><i class="icon-43"></i>Разместить ваш объект тут</a>
	    </dd>			
	</dl>
	<h2>Новости</h2>
	<ul class="news">
	    <li>
		<a href="#">Philosophy cannot be taught; it is the application of the sciences to truth</a>
		<span class="date">10 / Января / 2014</span>
	    </li>
	    <li>
		<a href="#">Philosophy cannot be taught; it is the application of the sciences to truth</a>
		<span class="date">10 / Января / 2014</span>
	    </li>
	    <li>
		<a href="#">Philosophy cannot be taught; it is the application of the sciences to truth</a>
		<span class="date">10 / Января / 2014</span>
	    </li>
	    <li>
		<a href="#">Philosophy cannot be taught; it is the application of the sciences to truth</a>
		<span class="date">10 / Января / 2014</span>
	    </li>
	</ul><!-- end news -->
	<a href="#" class="button"><i class="icon-43"></i>Все материалы</a>
	<a href="#" class="button"><i class="icon-43"></i>Предложите новость</a>
    </div><!-- end column -->
    <div class="clear"></div>
</div><!-- end main-content -->
<div class="clear"></div>
<div class="banner-box" style="min-height: 120px;"><a href="#" style="display: none;"><img src="images/foo.png" alt="" style="width: auto;" /></a></div>