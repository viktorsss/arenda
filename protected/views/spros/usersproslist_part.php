<?php 
if(isset($model)) {
foreach ($model as $item) { 
    $user = Users::model()->findByPk($item->user_id);
    ?>
<div class="request-block">
	<div class="request request-account">
	    <div class="hidden-wrap delete-confirm">
		<a href="#" class="close"><i class="icon-30"></i></a>
		<div class="hidden"><a href="#">Удалить</a></div>
	    </div>
	    <div class="leftcol">
		<a href="#" class="img-block"><img src="<?php echo $user->photo; ?>" alt="" /><i></i></a>
		<div class="details">
		    <a href="#" class="name"><span><?php echo $user->name; ?></span><span><?php echo $user->so_name; ?></span></a>
		    <div class="account-contacts">
			<span>Тел: <b><?php echo $user->phone; ?></b></span>
			<span>E-mail: <b><a href="mailto:<?php echo $user->e_mail; ?>"><?php echo $user->e_mail; ?></a></b></span>
		    </div>
		    <span class="general">Смотрели: </span>
		    <span class="general">Размещено: <?php // echo Yii::app()->dateFormatter->format('dd.MM.yy', $item->created); ?></span>
		    <span class="general">Активно до: </span>
		</div>
	    </div>
	    <?php $data = json_decode($item->data, TRUE);
		if(isset($data['distr'])) {
		    foreach ($data['distr'] as $d) {
			$districts[] = Districts::model()->findByPk($d)->name;
		    }
		}
		?>
	    <div class="rightcol">
		<p>
		    <span>Ищет</span>
		    <b><?php echo Func::model()->findByPk($item->catid)->name; ?></b> 
		    <span class="comment">(<?php echo isset($districts) ? implode(", ", $districts) : "Все районы"; ?>)</span>
		</p>
		<b>Общая площадь: <?php echo $data['areaFrom']."-".$data['areaTo']; ?> м2</b>
		<b>Стоимость: <?php echo $data['costFrom']."-".$data['costTo']; ?> <?php echo isset($data['cost']) ? 'руб./м2' : 'руб./мес.'; ?></b>
		<!-- span class="commission">Коммисия не более 20%</span -->
	    </div>
	    <div class="clear"></div>
	</div><!-- end request -->
	<div class="request-result">
	    <?php 
	    $res_items = array();
	    $res_items = CSite::getSprosTrue($data, $this->city_name); 
	    if(count($res_items) > 0) {
	    ?>
	    <ul class="search-object">
		<?php foreach ($res_items as $res_item) { ?>
		<li class="search-object-item">
		    <div class="main-info">
			<div class="image"><img src="<?php echo CSite::getImages($res_item->id, 1); ?>" alt=""  class="object-img"/></div>
			<div class="object-details">
			    <p class="intro"><a href="<?php echo $this->createUrl('items/details', array('id' => $res_item->id, 'trans' => $res_item->trans)); ?>"><span><?php echo $res_item->slogan; ?></span><i class="icon-43"></i></a></p>	
			    <div class="cols">
				<div>
				    <b><?php echo @Districts::model()->findByPk($model->district)->name; ?></b>
				    <b><?php echo @Streets::model()->findByAttributes(array('id' => $res_item->street))->name.", ".$res_item->house ?></b>
				    <b>Цена: <?php echo $res_item->price; ?> руб.</b>
				    <span>Общая площадь: <?php echo $res_item->area; ?> м<sup>2</sup></span>
				    <span class="stars">
					<span class="full"></span>
					<span class="full"></span>
					<span class="full"></span>
					<span class="full"></span>
					<span class="full"></span>
				    </span><!-- end stars -->
				</div>
				<div>
				    <span class="commission">Комиссия <?php echo $res_item->komprice; ?>%</span>
				    <?php if($res_item->type_price == 2) {
					$price1 = $res_item->price;
				    } elseif($res_item->type_price == 1) {
					$price1 = $res_item->price / $res_item->area;
				    } else {
					$price1 = 0;
				    } ?>
				    <span>Цена за м²: <?php echo $price1; ?> руб.</span>
				    <!-- span>Комнат: 1</span>
				    <span>Этаж: 3 | Этажность: 18</span -->
				</div>
			    </div>
			</div>
		    </div><!-- end main-info -->
		</li>
		<?php } ?>
	    </ul>
	    <?php } ?>
	    <?php if(count($res_items) > 0) { ?><a class="button"><span class="open">Открыть подходящие объекты (<?php echo count($res_items); ?>)</span><span class="close">Закрыть подходящие объекты (<?php echo count($res_items); ?>)</span></a><?php } ?>
	</div><!-- end request-result -->
	
    </div><!-- end request-block -->
<?php }} ?>