<?php
$this->beginContent('//layouts/main');
$id = Yii::app()->request->getParam('id');
$model = Items::model()->findByPk($id);

$trans = array(
    '',
    'Аренда',
    'Продажа'
);

$m_user = Users::model()->findByPk($model->owner_id);

foreach (FuncFields::model()->findAllByAttributes(array('func_id' => $model->functionality), 'type != "checkbox"') as $item) {
    $field_name[$item->id] = $item->name;
}
?>                      
<aside class="regular">
    <a href="#" class="open-sidebar active"><span class="open">Открыть меню<i class="icon-24"></i></span><span class="close">Закрыть меню<i class="icon-9"></i></span></a>
    <div class="left-sidebar">
	<div class="usersView">
	    <?php if (Yii::app()->user->isGuest) { ?>
    	    <a href="#" class="enter-register"><span class="enter">Вход</span> / <span class="register">Регистрация</span></a>
		<?php
	    } else {
		$this->renderPartial('//users/account-cart');
	    }
	    ?>
	</div>
	<div class="scroll-sidebar scroll-pane">
	    <div class="sidebar-object">
		<div class="summary">
		    <div class="title">
			<h4><?php echo $trans[$model->trans]; ?></h4>
			<span class="stars">
			    <span class="full"></span>
			    <span class="full"></span>
			    <span class="full"></span>
			    <span class="full"></span>
			    <span class="full"></span>
			</span><!-- end stars -->
		    </div>
		    <p class="intro"><?php echo $model->slogan; ?></p>
		    <ul>
			<?php if ($model->rooms != 0) { ?><li><span>Кол-во комнат</span><b><?php echo $model->rooms; ?></b></li><?php } ?>
			<li><span>Район</span><b><?php echo @Districts::model()->findByPk($model->district)->name; ?></b></li>
			<li><span>Адрес</span><b><?php echo @Streets::model()->findByAttributes(array('id' => $model->street))->name . ", " . $model->house ?></b></li>
			<!-- li><span>Тип здания</span><b>Бизнес-центр</b></li -->
			<li><span>Площадь, м<sup>2</sup></span><b><?php echo $model->area; ?></b></li>
			<?php foreach (FuncFieldsValues::model()->findAllByAttributes(array('item_id' => $id)) as $item) { ?>
				<?php if (isset($field_name[$item->field_id])) { ?><li><span><?php echo $field_name[$item->field_id]; ?></span><b><?php echo ($item->value == $field_name[$item->field_id]) ? "Да" : $item->value; ?></b></li><?php } ?>
			    <?php } ?>
		    </ul>
		    <h4>Стоимость</h4>
		    <ul class="no-margin">
			<li><span>Цена:</span><b><?php echo $model->price; ?> руб.</b></li>
			<?php if ($model->komprice != 0) { ?><li><span>Комиссия агента:</span><b><?php echo $model->komprice; ?><br/><?php echo ($model->price * $model->komprice / 100); ?> руб.</b></li><?php } ?>
		    </ul>
		</div><!-- end summary-->
		<div class="account">
		    <div class="account-card">
			<?php
			//$user_id = Yii::app()->user->id;
			$image = Users::model()->findByPk($model->owner_id)->photo;
			?>
			<img src="/images/upload/user/resize/<?php echo CImage::getCashImg($image, 70, 'user/'); ?>" alt="" />
			<div class="details">
			    <p class="account-name">
				<a class="name" href="<?php echo $this->createUrl('users/profileitemlist', array('id' => $model->owner_id)); ?>">
				    <span class="first-name"><?php echo $m_user->name; ?><span class="icon-pro">PRO</span></span>
				    <span class="last-name"><?php echo $m_user->so_name; ?></span>
				</a>
			    </p>
			    <table class="objects-rating">
				<tr><td>Объектов</td><td><?php echo CSite::getCountObjUser($model->owner_id); ?></td></tr>
				<tr><td>Рейтинг</td><td></td></tr>
			    </table>
			</div>
		    </div><!-- end account-card -->
		    <a href="#" class="button">Написать сообщение</a>
		    <a href="#" class="button show-hide-link">Показать контакты</a>
		    <ul class="hidden-block">
			<li><span>E-mail:</span><b><?php echo $m_user->e_mail; ?></b></li>
			<li><span>Телефон:</span><b><?php echo $m_user->phone; ?></b></li>
		    </ul>
		</div><!-- end account-->
		<div class="actions">
		    <h4>Действия</h4>
		    <ul class="icons">
			<li><a href="#"><i class="icon-13"></i></a></li>
			<li><a href="#"><i class="icon-14"></i></a></li>
			<li><a href="#"><i class="icon-15"></i></a></li>
			<li class="advanced-icon hidden-wrap">
			    <a href="#"><i class="icon-16"></i></a>
			    <ul class="advanced-list hidden">
				<li><a href="#">Скрытые комиссии</a></li>
				<li><a href="#">Неактуальный объект</a></li>
				<li><a href="#">Неадекватное поведение</a></li>
				<li><a href="#">Ложная информация</a></li>
				<li><a href="#">Нарушение закона или правил</a></li>
				<li><a href="#">Не оставлять жалобу</a></li>
			    </ul>
			</li>
		    </ul>
		    <h4>Поделиться</h4>
		    <ul class="social-share">
			<li><a href="#"><i class="icon-17"></i></a></li>
			<li><a href="#"><i class="icon-18"></i></a></li>
			<li><a href="#"><i class="icon-19"></i></a></li>
			<li><a href="#"><i class="icon-20"></i></a></li>
		    </ul>
		</div><!-- end actions -->
	    </div><!-- end sidebar-object -->	
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