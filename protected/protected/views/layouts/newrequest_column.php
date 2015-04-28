<?php $this->beginContent('//layouts/request'); ?> 
    <aside class="min">
	<a href="#" class="open-sidebar"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
	<div class="left-sidebar">
            <div class="usersView">
                <?php if(Yii::app()->user->isGuest) { ?>
                    <a href="#" class="enter-register"><span class="enter">Вход</span> / <span class="register">Регистрация</span></a>
                <?php } else {
                    $this->renderPartial('//users/account-cart');
                } ?>
            </div>
	    <div class="scroll-sidebar scroll-pane">
		<div class="sidebar-filter" style="display:none">
		    <a href="#" class="button back-to"><i class="icon-4"></i>Вернуться к быстрому выбору</a>
		    <div class="rooms-amount">
			<span>Количество комнат</span>
			<ul>
			    <li><label>1<input type="checkbox" name="rooms-amount" /></label></li>
			    <li><label>2<input type="checkbox" name="rooms-amount" /></label></li>
			    <li><label>3<input type="checkbox" name="rooms-amount" /></label></li>
			    <li><label>4<input type="checkbox" name="rooms-amount" /></label></li>
			    <li><label>>4<input type="checkbox" name="rooms-amount" /></label></li>
			</ul>
		    </div>
		    <div class="advanced-filter hidden-wrap">
			<a href="#" class="button">Выберите район (21/40)<i class="icon-5"></i><i class="icon-4"></i></a>
			<div class="advanced-field hidden">
			    <ul>
				<li><label class="checkbox"><input type="checkbox" checked />Приморский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Центральный</label></li>
				<li><label class="checkbox"><input type="checkbox" />Адмиралтейский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Василеостровский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Петроградский</label></li>
				<li><label class="checkbox"><input type="checkbox" checked />Выборгский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Калининский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Красногвардейский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Фрунзенский</label></li>
				<li><label class="checkbox"><input type="checkbox" checked />Невский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Кировский</label></li>
				<li><label class="checkbox"><input type="checkbox" />Московский</label></li>
			    </ul>
			</div>
		    </div>
		    <div class="filter-details">
			<span class="title">Площадь, м<sup>2</sup></span>
			<p>
			    <label>от<input type="text" placeholder="0" /></label>
			    <label>до<input type="text" placeholder="0" /></label>
			</p>
			<span class="title with-options">Стоимость,</span>
			<div class="radio-wrap">
			    <label class="radio"><input type="radio" name="cost" checked="checked" />р./м<sup>2</sup></label>
			    <label class="radio"><input type="radio" name="cost" />р./мес</label>
			</div>
			<div class="clear"></div>
			<p>
			    <label>от<input type="text" placeholder="0" value="500"/></label>
			    <label>до<input type="text" placeholder="0" value="900000"/></label>
			</p>
			<div class="checkbox-wrap"><label class="checkbox grey"><input type="checkbox" checked />Без комиссий</label></div>
			<span class="total">Найдено 1235 объектов</span>
		    </div><!-- end filter-details -->
		    <a href="#" class="button">Показать</a>
		    <div class="advanced-filter">
			<a href="#" class="button">Дополнительные опции<i class="icon-5"></i><i class="icon-4"></i></a>
			<div class="advanced-field wide">
			    <div class="block">
				<span class="title">Комфорт</span>
				<ul>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Кондиционер</label></li>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Парковка</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Приведение</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Домофон</label></li>
				</ul>
			    </div>
			    <div class="block">
				<span class="title">Коммуникация</span>
				<ul>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Система вентиляции</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Интернет</label></li>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Система водоснабжения</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Телефония</label></li>
				</ul>
			    </div>
			    <div class="block">
				<span class="title">Безопасность</span>
				<ul>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Система ОПС</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Пропускная система</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Видеонаблюдение</label></li>
				</ul>
			    </div>
			    <div class="block">
				<span class="title">Оборудование</span>
				<ul>
				    <li><label class="checkbox"><input type="checkbox" />Телевизор</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Компьютер</label></li>
				    <li><label class="checkbox"><input type="checkbox"  checked="checked"/>Смотровая яма</label></li>
				    <li><label class="checkbox"><input type="checkbox" />Подъемное оборудование</label></li>
				</ul>
			    </div>
			</div><!-- end advanced-field -->
		    </div>
		    <ul class="filter-details-extra">
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Кондиционер</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Система пожаротушения</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Телевизор</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Парковка</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Привидение в мотором</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Домоучительница</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Система видеонаблюдения</li>
			<li><a href="#" class="delete"><i class="icon-6"></i></a>Домофон</li>
		    </ul>
		    <p class="note">Сохраните параметры поиска как заявку и получайте уведомления о поступлении подходящих объектов</p>
		    <a href="#" class="button">Сохранить</a>
		    <a href="#" class="button">Сбросить</a>
		</div><!-- end sidebar-filter -->
		<div class="sidebar-content">
		    <p class="subtitle">Выберите нужный вам тип<br/> и операцию с недвижимостью</p>
		    <dl class="tabs">
			<dt class="selected">Аренда</dt>
			<dd class="selected">
			    <span class="title">Коммерческая недвижимость:</span>
			    <ul class="categories">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 1)) as $item) { 
				    $count = CSite::getCountFunc($item->id, $this->city_name, 1);
				?>
				<li><a href="<?php echo $this->createUrl('items/list', array('id' => $item->id, 'trans' => 1)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			    <span class="title">Жилая недвижимость:</span>
			    <ul class="categories no-border">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { 
				    $count = CSite::getCountFunc($item->id, $this->city_name, 1);
				?>
				<li><a href="<?php echo $this->createUrl('items/list', array('id' => $item->id, 'trans' => 1)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			</dd>
			<dt>Продажа</dt>
			<dd>
			    <span class="title">Коммерческая недвижимость:</span>
			    <ul class="categories">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 1)) as $item) { 
				    $count = CSite::getCountFunc($item->id, $this->city_name, 2);
				?>
				<li><a href="<?php echo $this->createUrl('items/list', array('id' => $item->id, 'trans' => 2)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			    <span class="title">Жилая недвижимость:</span>
			    <ul class="categories no-border">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { 
				    $count = CSite::getCountFunc($item->id, $this->city_name, 2);
				?>
				<li><a href="<?php echo $this->createUrl('items/list', array('id' => $item->id, 'trans' => 2)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			</dd>	
			<dt>Спрос</dt>
			<dd>
			    <span class="title">Коммерческая недвижимость:</span>
			    <ul class="categories">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 1)) as $item) { 
				    $count = Spros::model()->countByAttributes(array('city' => $this->city_name, 'catid' => $item->id));
				    //$count = 0;
				?>
				<li><a href="<?php echo $this->createUrl('spros/index', array('id' => $item->id)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			    <span class="title">Жилая недвижимость:</span>
			    <ul class="categories no-border">
				<?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { 
				    $count = Spros::model()->countByAttributes(array('city' => $this->city_name, 'catid' => $item->id));
				    //$count = 0;
				?>
				<li><a href="<?php echo $this->createUrl('spros/index', array('id' => $item->id)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
				<?php } ?>
			    </ul><!-- end categories -->
			</dd>	
		    </dl>
		    <a href="#" class="button">Статистика и аналитика <i class="icon-10"></i></a>
		</div><!-- end sidebar-content -->
					<div class="sidebar-bottom">
						<div class="search-field">
							<div class="search"><input type="text" class="placeholder-white" placeholder="Поиск"/><a href="#"><i class="icon-3"></i></a></div>
						</div>
						<ul class="social">
							<li><a href="#" class="vk"><i class="icon-17"></i><span>89</span></a></li>
							<li><a href="#" class="tw"><i class="icon-19"></i><span>89</span></a></li>
							<li><a href="#" class="fb"><i class="icon-18"></i><span>89</span></a></li>
						</ul>
						<div class="copyright">
							<p>© 2013 com-arenda.ru Администрация сайта осуществляет проверку и модерацию размещаемой информации. Сайт не является публичной офертой, информация предоставлена исключительно с целью ознакомления.</p>
						</div>
					</div><!-- end sidebar-bottom -->
				</div><!-- end scroll-pane -->
			</div><!-- end left-sidebar -->
		</aside>
		<div class="page">
                        <header class="new-request">
				<a href="#" class="sidebar-icon"><i class="icon-44"></i></a>
				<div class="left-block">
					<a href="/" class="logo">com-arenda.ru</a>
					<a href="<?php echo $this->createUrl('site/about'); ?>" class="about-link">О проекте</a>
				</div>
				<div class="right-block">
					<a href="#" class="region-link" id="region-link"><span><?php echo $this->city_name; ?></span></a>
				</div>
			</header>
			<?php // echo $this->renderPartial('/site/_header'); ?>
			<section class="content new-request">
				<?php echo $content; ?>
			</section> <!-- end content -->			
	
			<footer>
				<ul class="menu">
					<li><a href="#">О нас</a></li>
					<li><a href="#">Реклама</a></li>
					<li><a href="#">Контакты</a></li>
				</ul><!-- end menu -->
				<ul class="menu">
					<li><a href="#">Карта сайта</a></li>
					<li><a href="#">Пользовательские условия</a></li>
					<li><a href="#">Условия размещения объявления</a></li>
				</ul><!-- end menu --><ul class="menu">
					<li><a href="#">Аренда</a></li>
					<li><a href="#">Продажа</a></li>
					<li><a href="#">Подать объявление</a></li>
				</ul><!-- end menu -->
				<ul class="counters">
					<li><img src="/images/counter-1.jpg" alt="" /></li>
					<li><img src="/images/counter-2.jpg" alt="" /></li>
					<li><img src="/images/counter-3.jpg" alt="" /></li>
				</ul>
			</footer>
			<a href="#" class="developed"></a>
		</div><!-- end page -->
<?php $this->endContent(); ?>