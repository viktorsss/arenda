<?php $this->beginContent('//layouts/main'); ?>                    
<aside class="regular">
    <a href="#" class="open-sidebar active"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
    <div class="left-sidebar">
        <div class="userView">
	    <?php $this->renderPartial('//users/account-cart'); ?>
        </div>
	<div class="scroll-sidebar scroll-pane">
            <div class="sidebar-content">
		<p class="subtitle">Админ-панель управления сайтом</p>
		<dl class="tabs">
                    <dt class="selected">Обьекты</dt>
                    <dd class="selected">
			<span class="title">Коммерческая недвижимость:</span>
			<ul class="categories">
                            <?php foreach (Func::model()->findAllByAttributes(array('catid' => 1)) as $item) { 
                                $count = CSite::getCountFunc($item->id, $this->city_name, 1, 3);
                            ?>
                            <li><a href="<?php echo $this->createUrl('admin/list', array('id' => $item->id, 'trans' => 1)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
                            <?php } ?>
			</ul><!-- end categories -->
			<span class="title">Жилая недвижимость:</span>
			<ul class="categories no-border">
                            <?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { 
                                $count = CSite::getCountFunc($item->id, $this->city_name, 1, 3);
                            ?>
                            <li><a href="<?php echo $this->createUrl('admin/list', array('id' => $item->id, 'trans' => 1)) ?>" <?php if($count == 0) { ?>class="disabled"<?php } ?>><?php echo $item->name; ?> <span><?php echo $count; ?></span></a></li>
                            <?php } ?>
			</ul><!-- end categories -->
                    </dd>
                    <dt>Управление</dt>
                    <dd>
			<span class="title">Первый блок</span>
			<ul class="categories">
                            <li><a href="<?php echo $this->createUrl('admin/fields'); ?>">Управление полями</a></li>
                            <li><a href="<?php echo $this->createUrl('admin/cities'); ?>">Управление городами</a></li>
			</ul><!-- end categories -->
			<span class="title">Второй блок</span>
			<ul class="categories no-border">
                            <li><a href="<?php echo $this->createUrl('admin/list', array('id' => $item->id, 'trans' => 2)) ?>"></a></li>
			</ul><!-- end categories -->
		    </dd>	
                    <dt>Поля</dt>
		    <dd>
			<span class="title">Коммерческая недвижимость:</span>
			<ul class="categories">
                            <?php foreach (Func::model()->findAllByAttributes(array('catid' => 1)) as $item) { ?>
                            <li><a href="<?php echo $this->createUrl('admin/fields', array('catid' => $item->id)) ?>"><?php echo $item->name; ?></a></li>
                            <?php } ?>
			</ul><!-- end categories -->
			<span class="title">Жилая недвижимость:</span>
			<ul class="categories no-border">
                            <?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { ?>
                            <li><a href="<?php echo $this->createUrl('admin/fields', array('catid' => $item->id)) ?>"><?php echo $item->name; ?></a></li>
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
		<div class="copyright">
                    <p>© 2013 com-arenda.ru Администрация сайта осуществляет проверку и модерацию размещаемой информации. Сайт не является публичной офертой, информация предоставлена исключительно с целью ознакомления.</p>
		</div>
            </div><!-- end sidebar-bottom -->
	</div><!-- end scroll-pane -->
    </div><!-- end left-sidebar -->
</aside>

<div class="page">
    <?php echo $this->renderPartial('/site/_header'); ?>
    <section class="content">
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
	</ul><!-- end menu -->
        <ul class="menu">
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
    <span class="content-disabled"></span>
</div><!-- end page -->
<?php $this->endContent(); ?>