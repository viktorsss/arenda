<?php $this->beginContent('//layouts/main'); ?>
<form method="POST" action="" id="searchForm">
<aside class="regular">
    <a href="#" class="open-sidebar active"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
    <div class="left-sidebar">
	<div class="userView">
        <?php if(Yii::app()->user->isGuest) { ?>
            <a href="#" class="enter-register"><span class="enter">Вход</span> / <span class="register">Регистрация</span></a>
        <?php } else {
            $this->renderPartial('//users/account-cart');
        } ?>
        </div>
	<div class="scroll-sidebar scroll-pane">
		<input type="hidden" name="search[catid]" value="<?php echo Yii::app()->request->getParam('id'); ?>" />
		<input type="hidden" name="search[trans]" value="<?php echo Yii::app()->request->getParam('trans'); ?>" />
	    <div class="sidebar-filter" style="display:block">
		<a href="#" class="button back-to"><i class="icon-4"></i>Вернуться к быстрому выбору</a>
		<?php if(Func::model()->findByPk(Yii::app()->request->getParam('id'))->choose_rooms) { ?>
		<div class="rooms-amount">
		    <span>Количество комнат</span>
		    <ul>
			<li><label>1<input type="checkbox" name="search[rooms-amount][]" value="1" /></label></li>
			<li><label>2<input type="checkbox" name="search[rooms-amount][]" value="2" /></label></li>
			<li><label>3<input type="checkbox" name="search[rooms-amount][]" value="3" /></label></li>
			<li><label>4<input type="checkbox" name="search[rooms-amount][]" value="4" /></label></li>
			<li><label>>4<input type="checkbox" name="search[rooms-amount][]" value="40" /></label></li>
		    </ul>
		</div>
		<?php } ?>
		<?php 
			    $cr = new CDbCriteria();
			    $cr->select = "district";
			    $cr->condition = "city = :city AND district != 0 AND trans = :trans";
			    $cr->params = array(
				":city" => $this->city_name,
				":trans" => Yii::app()->request->getParam('trans'));
			    $cr->group = "district";
			    $item_districts = Items::model()->findAll($cr);
			    //var_dump($item_districts);
		?>
		<div class="advanced-filter hidden-wrap">
		    <a href="#" class="button">Выберите район (<?php echo count($item_districts); ?>/<?php echo Districts::model()->count("city = '".$this->city_name."'"); ?>)<i class="icon-5"></i><i class="icon-4"></i></a>
		    <div class="advanced-field hidden">
			<ul>
			    <?php
			    foreach ($item_districts as $item) { 
				if($item->district != 0) { 
				?>
			    <li><label class="checkbox"><input type="checkbox" name="search[distr][]" value="<?php echo $item->district; ?>" /><?php echo Districts::model()->findByPk($item->district)->name; ?></label></li>
			    <?php }} ?>
			</ul>
		    </div>
		</div>
		<div class="filter-details">
		    <span class="title">Площадь, м<sup>2</sup></span>
		    <p>
			<label>от<input type="text" name="search[areaFrom]" placeholder="0" /></label>
			<label>до<input type="text" name="search[areaTo]" placeholder="0" /></label>
		    </p>
		    <span class="title with-options">Стоимость,</span>
		    <div class="radio-wrap">
			<label class="radio checked"><input type="radio" name="cost" value="1" checked />р./м<sup>2</sup></label>
			<label class="radio"><input type="radio" name="cost" value="2" />р./мес</label>
		    </div>
		    <div class="clear"></div>
		    <p>
			<label>от<input type="text" name="search[costFrom]" placeholder="0" value="" /></label>
			<label>до<input type="text" name="search[costTo]" placeholder="0" value="" /></label>
		    </p>
		    <div class="checkbox-wrap"><label class="checkbox grey"><input type="checkbox" name="search[kom]" value="1" />Без комиссий</label></div>
		    <span class="total">Найдено <span id="searchObj"></span><span class="count_list"><?php echo $this->count_list; ?></span> объектов</span>
		</div><!-- end filter-details -->
		<a href="#" id="viewListItems" class="button">Показать</a>
		<div class="advanced-filter hidden-wrap">
		    <a href="#" class="button">Дополнительные опции<i class="icon-5"></i><i class="icon-4"></i></a>
		    <div class="advanced-field wide hidden">
			<?php 
			$html = "";
			$model = FuncFields::model()->findAllByAttributes(array('func_id' => Yii::app()->request->getParam('id'), 'type' => 'checkbox', "trans" => Yii::app()->request->getParam('trans')));
			if(count($model) > 0) {
			    foreach ($model as $item) {
				$res[$item->name_column][] = '<li><label class="checkbox"><input type="checkbox" id="adv-'.$item->id.'" name="search[field]['.$item->id.']" value="'.$item->name.'" />'.$item->name.'</label></li>';
			    }

			    foreach ($res as $key => $item) {
				$html .= '<div class="block"><span class="title">'.$key.'</span>';
				$html .= '<ul>'.implode('', $item).'</ul>';
				$html .= '</div>';
			    }
			}
			echo $html;
			?>
		    </div><!-- end advanced-field -->
		</div>
		<ul class="filter-details-extra">
		    <!-- li><a href="#" class="delete"><i class="icon-6"></i></a>Кондиционер</li -->
		</ul>
		<p class="note">Сохраните параметры поиска как заявку и получайте уведомления о поступлении подходящих объектов</p>
		<a href="#" id="saveSearching" class="button">Сохранить</a>
		<a href="#" id="resetSearch" class="button">Сбросить</a>
	    </div><!-- end sidebar-filter -->
	    <div class="sidebar-content" style="display: none;">
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
		    <li><a href="#" class="vk"><i class="icon-17"></i><span>0</span></a></li>
		    <li><a href="#" class="tw"><i class="icon-19"></i><span>0</span></a></li>
		    <li><a href="#" class="fb"><i class="icon-18"></i><span>0</span></a></li>
		</ul>
		<div class="copyright">
		    <p>© 2013 com-arenda.ru Администрация сайта осуществляет проверку и модерацию размещаемой информации. Сайт не является публичной офертой, информация предоставлена исключительно с целью ознакомления.</p>
		</div>
	    </div><!-- end sidebar-bottom -->
	</div>
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
</div><!-- end page -->
</form>
<div class="clear"></div>
<div class="right-sidebar">
    <div class="right-sidebar-links">
	<a href="#" class="to-top"><i class="icon-9"></i>Вверх</a>
	<a href="#" class="operator-link">Задать вопрос</a>
	<a href="#" class="information-link"><i class="icon-8"></i></a>
    </div>
</div><!-- end right-sidebar -->
<?php $this->endContent(); ?>