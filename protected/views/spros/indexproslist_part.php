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
    </div><!-- end request-block -->
<?php }} ?>