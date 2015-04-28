<?php $this->beginContent('//layouts/main');
$act = Yii::app()->getController()->getAction()->getId();
$dsection = "";
switch ($act) {
    case 'settings': $dsection = "settings";	break;
    default : "";
}

?> 
<aside class="regular">
    <a href="#" class="open-sidebar active"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
    <div class="left-sidebar sidebar-personal">
	<?php 
	if(!Yii::app()->user->isGuest) {
	    echo $this->renderPartial('//users/account-cart');
	} ?>
	<div class="scroll-sidebar scroll-pane">
            <div class="dashboard">
                <ul>
		    <?php if(Yii::app()->user->type != 1) { ?><li><a href="<?php echo $this->createUrl('admin/index'); ?>">Админ-панель</a></li><?php } ?>
                    <li><a href="<?php echo $this->createUrl('users/index'); ?>" <?php echo ($act == "index") ? "class='active'" : ""; ?>>Стартовая страница</a></li>
                    <li><a href="<?php echo $this->createUrl('users/myobjects'); ?>" <?php echo ($act == "myobjects") ? "class='active'" : ""; ?>>Мои объекты<span><?php echo CSite::getCountObjUser(Yii::app()->user->id); ?></span></a></li>
                    <li><a href="#">Блокнот / Заявки<span>+0<b>/0</b></span></a></li>
                    <li><a href="<?php echo $this->createUrl('users/sproslist'); ?>" <?php echo ($act == "sproslist") ? "class='active'" : ""; ?>>Спрос<span><?php echo Spros::model()->countByAttributes(array('user_id' => Yii::app()->user->id)); ?></span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Сообщения<span>+0<b>/0</b></span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Баланс<span>0 руб.</span></a></li>
                </ul>
                <ul>
                    <li><a href="<?php echo $this->createUrl('users/profile'); ?>" <?php echo ($act == "profile") ? "class='active'" : ""; ?>>Моя страница</a></li>
                    <li><a href="<?php echo $this->createUrl('users/settings'); ?>" <?php echo ($act == "settings") ? "class='active'" : ""; ?>>Настройки</a></li>
                </ul>
            </div><!-- end dashboard -->
            <div class="sidebar-bottom">
		<div class="search-field">
                    <div class="search"><input type="text" class="placeholder-white" placeholder="Поиск"/><a href="#"><i class="icon-3"></i></a></div>
		</div>
		<ul class="social">
                    <li><a href="#" class="vk"><i class="icon-17"></i><span></span></a></li>
                    <li><a href="#" class="tw"><i class="icon-19"></i><span></span></a></li>
                    <li><a href="#" class="fb"><i class="icon-18"></i><span></span></a></li>
		</ul>
		<div class="copyright">
                    <p>© 2013 com-arenda.ru Администрация сайта осуществляет проверку и модерацию размещаемой информации. Сайт не является публичной офертой, информация предоставлена исключительно с целью ознакомления.</p>
		</div>
            </div><!-- end sidebar-bottom -->
	</div><!-- end scroll-pane-->
    </div><!-- end left-sidebar -->
</aside>
		<div class="page">
			<header>
				<div class="left-block">
					<a href="/" class="logo">com-arenda.ru</a>
					<a href="<?php echo $this->createUrl('site/about'); ?>" class="about-link">О проекте</a>
				</div>
				<div class="right-block">
                                    <a href="<?php echo $this->createUrl('items/addnew'); ?>" class="add-button"><i class="icon-1"></i>Разместить объявление</a>
                                    <a href="#" class="region-link" id="region-link"><span><?php echo $this->city_name; ?></span></a>
				</div>
			</header>
			<div class="tariff-version">
				<div class="tariff-short">
					<a href="#" class="close"><i class="icon-30"></i></a>
					<p>Вы используете демонстрационную версию тарифа “Профи”</p>
					<a href="#" class="tariff-more show-hide-next"><span class="show">Подробнее о тарифаx и ценах</span><span class="hide">Закрыть подробную информацию</span></a>
					<a href="#" class="plus"><i class="icon-1"></i><span>Продлить<br/>подписку</span></a>
					<div class="days-left">
						<span class="decor"></span>
						<span class="left">осталось</span>
						<span class="days"><b>17</b>дней</span>
					</div>
				</div><!-- end tarif-short -->
				<div class="tariff-detailed hidden-block">
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
				</div><!-- end tariff-detailed -->
			</div><!-- end tariff-version -->
			<section class="content <?php echo $dsection; ?>">
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
		<div class="clear"></div>
		<div class="right-sidebar">
			<div class="right-sidebar-links">
				<a href="#" class="to-top"><i class="icon-9"></i>Вверх</a>
				<a href="#" class="operator-link">Задать вопрос</a>
				<a href="#" class="information-link"><i class="icon-8"></i></a>
			</div>
		</div><!-- end right-sidebar -->
                <?php $this->endContent(); ?>