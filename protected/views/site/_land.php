<aside class="regular">
			<a href="#" class="open-sidebar active"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
			<div class="left-sidebar">
			    <a href="#" class="enter-register"><span class="enter">Вход</span> / <span class="register">Регистрация</span></a>
				<div class="scroll-sidebar scroll-pane">
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
                            <li><a href="<?php echo $this->createUrl('spros/index', array('id' => $item->id, 'catid' => $item->id)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
                            <?php } ?>
			</ul><!-- end categories -->
			<span class="title">Жилая недвижимость:</span>
			<ul class="categories no-border">
                            <?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { 
                                $count = Spros::model()->countByAttributes(array('city' => $this->city_name, 'catid' => $item->id));
				//$count = 0;
                            ?>
                            <li><a href="<?php echo $this->createUrl('spros/index', array('id' => $item->id, 'catid' => $item->id)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
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
							<li><a href="#" class="vk"><i class="icon-17"></i><span>0</span></a></li>
							<li><a href="#" class="tw"><i class="icon-19"></i><span>0</span></a></li>
							<li><a href="#" class="fb"><i class="icon-18"></i><span>0</span></a></li>
						</ul>
						<div class="copyright">
							<p>© 2013 com-arenda.ru Администрация сайта осуществляет проверку и модерацию размещаемой информации. Сайт не является публичной офертой, информация предоставлена исключительно с целью ознакомления.</p>
						</div>
					</div><!-- end sidebar-bottom -->
				</div><!-- end scroll-pane -->
			</div><!-- end left-sidebar -->
		</aside>
		<div class="page">
			<div class="top-screen">
				<a href="#" class="logo"><span>com-arenda.ru</span> Больше чем сайт с объявлениями</a>
				<div class="right-block">
				    <a href="<?php echo $this->createUrl('site/index', array('land' => 1)); ?>" class="close"><i class="icon-6"></i> Закрыть и перейти на главную</a>
					<div class="checkbox-wrap"><label class="checkbox"><input type="checkbox" />Больше не открывать</label></div>
				</div>
				<p class="title">
					<span class="subtitle">Хотите снять или купить квартиру, офис или склад? Или хотите сдать или продать?</span>
					<span>Информационно социальная система,</span><br/><span>выводящая на новый уровень работу</span><br/><span>с информацией в сфере недвижимости!</span>
				</p>
				<a href="#" class="enter-register"><span class="enter">Вход</span> / <span class="register">Регистрация</span></a>
			</div><!-- end top-screen -->
			<div class="content">
				<div class="intro">
					<p><b>Com-arenda</b> - информационно социальная система, выводящая на новый уровень работу с информацией в сфере недвижимости.</p>
					<div class="try-now">
						<a href="#" class="button orange">Попробовать сейчас!</a>
						<span>14 дней бесплатно</span>
					</div>
				</div>
				<div class="module module-1">
					<p class="title">Подробный и удобный поиск<span class="arrow"></span></p>
					<p>Начните искать то, что вам нужно прямо сейчас!</p>
				</div>
				<div class="module module-2">
					<p class="title">Автоматический подбор<br/>объектов по заявкам и спросу</p>
					<p>Вы узнаете, когда появится спрос на ваше предложение.<br/>Вы первые узнаете, когда появится нужный вам объект.</p>
					<p class="text">В вашем личном кабинете вы будете видеть спрос<br/>на ваши объявления и контакты разместившего<br/>его пользователя.</p>
					<p class="text">Разместите заявку — и о ней узнает именно тот,<br/>у кого есть или появится объект с нужными<br/>вам характеристиками.</p>
				</div>
				<div class="module module-3">
					<p class="title">Личный кабинет,<br/>блокнот и SMS/e-mail <br/>информирование</p>
					<p>Ваш личный офис — следите за статусом избранных объявлений. <br/>Знайте об изменениях их актуальности.</p>
					<p class="text">Личный кабинет и блокнот позволяет хранить и управлять неограниченным количеством объектов, SMS и е-mail уведомления с портала абсолютно бесплатны и позволяют вам оперативно реагировать на ситуацию.</p>
					<p class="text">Добавляйте в блокнот личного кабинета понравившиеся объекты и получайте уведомление об изменении их статуса.</p>
					<a href="#">Начать пользоваться прямо сейчас!</a>
				</div>
				<div class="module module-4">
					<p class="title">Личная страница</p>
					<p>Ваш персональный сайт-визитка.<br/>Расскажите о себе.<br/>Покажите все свои объекты.<br/>Общайтесь с коллегами и клиентами.</p>
					<div class="try-now">
						<a href="#" class="button orange">Попробовать сейчас!</a>
						<span>14 дней бесплатно</span>
					</div>
				</div>
				<div class="module module-5">
					<div class="bottom-block">
						<p class="title">Корпоративная страница</p>
						<span class="arrow"></span>
						<p>Расскажите о своей компании и сотрудниках.<br/>Все объекты ваших сотрудников будут на одной  странице.<br/>Каждому сотруднику — личный кабинет!</p>
						<div class="try-now">
							<a href="#" class="button orange">Попробовать сейчас!</a>
							<span>14 дней бесплатно</span>
						</div>
					</div>
				</div>
				<div class="tariff">
					<p class="title">Тарифы и цены</p>
					<p class="text"><b>Мы рекомендуем<br/>подключить тариф<br/>“Премьер”</b>Вы можете выбрать любой<br/>тариф для подключения,<br/>а так же срок подключения<br/>(1мес., 3мес., 6мес., 12мес.).</p>
					<ul class="tariff-list">
						<li>
							<span class="head">Стандарт</span>
							<ul class="tariff-options">
								<li>SMS уведомления</li>
								<li>E-mail уведомления</li>
								<li>Количество объектов:10</li>
							</ul>
							<span class="foot">Бесплатно</span>
							<a href="#" class="button last">Выбрать</a>
						</li>
						<li class="pro">
							<span class="head">Профи</span>
							<ul class="tariff-options">
								<li>SMS уведомления</li>
								<li>E-mail уведомления</li>
								<li>Количество объектов: неограничено</li>
								<li>Личная страница</li>
								<li>Доступ к статистике и аналитике</li>
							</ul>
							<span class="foot">99 руб./мес.</span>
							<a href="#" class="button">Выбрать</a>
							<a href="#" class="button last">Пробная версия <span>(14 дней)</span></a>
						</li>
						<li class="premier">
							<span class="head">Премьер</span>
							<ul class="tariff-options">
								<li>SMS уведомления</li>
								<li>E-mail уведомления</li>
								<li>Количество объектов: неограничено</li>
								<li>Личная страница</li>
								<li>Доступ к статистике и аналитике</li>
								<li>Представители</li>
							</ul>
							<span class="foot">999 руб./мес.</span>
							<a href="#" class="button">Выбрать</a>
							<a href="#" class="button last">Пробная версия <span>(14 дней)</span></a>
						</li>
					</ul><!-- end tariff-list -->
					<div class="clear"></div>
				</div><!-- end tariff -->
				<div class="reviews" style="display:none;">
					<p class="title">Отзывы</p>
					<div class="reviews-slider">
						<div class="slides">
							<div class="slide">
								<a href="#" class="img-wrap"><img src="images/avatar-1.jpg" alt="" /><span></span></a>
								<div class="details">
									<a href="#">Криницын Алексей</a>
									<p><span>Генеральный директор</span><span>АН «Гармония»</span></p>
									<p>«Нас прет! Парни просто монстры! Очень удобно, бесплатно и не больно! Всем рекомендую!»</p>
								</div>
								<div class="clear"></div>
							</div>	
							<div class="slide">
								<a href="#" class="img-wrap"><img src="images/avatar-1.jpg" alt="" /><span></span></a>
								<div class="details">
									<a href="#">Криницын Алексей</a>
									<p><span>Генеральный директор</span><span>АН «Гармония»</span></p>
									<p>«Нас прет! Парни просто монстры! Очень удобно, бесплатно и не больно! Всем рекомендую!»</p>
								</div>
								<div class="clear"></div>
							</div>	
							<div class="slide">
								<a href="#" class="img-wrap"><img src="images/avatar-1.jpg" alt="" /><span></span></a>
								<div class="details">
									<a href="#">Криницын Алексей</a>
									<p><span>Генеральный директор</span><span>АН «Гармония»</span></p>
									<p>«Нас прет! Парни просто монстры! Очень удобно, бесплатно и не больно! Всем рекомендую!»</p>
								</div>
							<div class="clear"></div>
							</div>	
							<div class="slide">
								<a href="#" class="img-wrap"><img src="images/avatar-1.jpg" alt="" /><span></span></a>
								<div class="details">
									<a href="#">Криницын Алексей</a>
									<p><span>Генеральный директор</span><span>АН «Гармония»</span></p>
									<p>«Нас прет! Парни просто монстры! Очень удобно, бесплатно и не больно! Всем рекомендую!»</p>
								</div>
								<div class="clear"></div>
							</div>	
						</div><!-- end slides -->
					</div><!-- end reviews-slider -->
				</div><!-- end reviews -->
				<div class="bottom-block">
					<p class="title">Скоро</p>
					<p class="text">Статистика и аналитика. По всем крупным городам России.<br/>Средние цены и прогнозы, изменения динамики — Весь рынок недвижимости как на ладони!</p>
					<p class="text">Интеграция Каталог бизнес центров bcbook.ru и com-arenda.ru — смотрите свободные помещения в бизнес центрах.</p>
				</div>
				<div class="intro bottom">
					<p><b>Com-arenda</b> - информационно социальная система, выводящая на новый уровень работу с информацией в сфере недвижимости.</p>
					<div class="try-now">
						<a href="#" class="button orange">Попробовать сейчас!</a>
						<span>14 дней бесплатно</span>
					</div>
				</div>
			</div><!-- end content -->
			<a href="#" class="developed"></a>
		</div><!-- end page -->