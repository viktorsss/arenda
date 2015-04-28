<h2>Спрос<span class="comment">всего <?php echo count($model); ?></span></h2>
<form id="filterSprosInput" method="POST" action="">
<div class="content-filter">
    <div class="unit">
	<h4>Тип сделки</h4>
	<ul class="view">
	    <li><label class="checked">Продажа <span><?php echo Spros::model()->countByAttributes(array('city' => $this->city_name, 'user_id' => $user->id, 'trans' => 2)) ?></span><input type="radio" checked name="trans" value="2"></label></li>
	    <li><label>Аренда <span><?php echo Spros::model()->countByAttributes(array('city' => $this->city_name, 'trans' => 1, 'user_id' => $user->id)) ?></span><input type="radio" name="trans" value="1"></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Вид помещения</h4>
	<ul class="view">
	    <li class="typeBuild"><label class="checked">Жилое <span><?php $cr = new CDbCriteria(); $cr->condition = "trans = 2"; $cr->addInCondition('catid', array(7,8,9,10,11)); echo Spros::model()->count($cr); ?></span><input type="radio" checked name="funcCat" value="2" ></label></li>
	    <li class="typeBuild"><label>Коммерческое <span><?php $cr = new CDbCriteria(); $cr->condition = "trans = 2"; $cr->addInCondition('catid', array(1,2,3,4,5,6)); echo Spros::model()->count($cr); ?></span><input type="radio" name="funcCat" value="1" /></label></li>
	</ul>
    </div>
    <div class="unit">
	<h4>Тип помещения</h4>
	<div class="select-wrap" id="typeBuild">
	    <input type="hidden" id="filter_funcid" name="funcid2" value="" />
	    <div class="select">
		<span class="title">Квартиры</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list func-list">
		<?php foreach (Func::model()->findAllByAttributes(array('catid' => 2)) as $item) { ?>
		<li class="func" data-value="<?php echo $item->id; ?>"><?php echo $item->name; ?></li>
		<?php } ?>
	    </ul>
	</div>
	<!-- h4>Город</h4>
	<div class="select-wrap">
	    <input type="hidden" name="" value="" />
	    <div class="select">
		<span class="title">Все</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
	    </div>
	    <ul class="option-list">
		<li data-value="test1">Все</li>
		<li data-value="test2">Санкт-Петербург</li>
		<li data-value="test3">Воронеж</li>
		<li data-value="test4">Краснодар</li>
	    </ul>
	</div -->
    </div>
    <div class="unit">
	<h4>Показывать по</h4>
	<ul class="show">
	    <li><label class="checked">7<input type="radio" name="show" checked value="7" /></label></li>
	    <li><label>14<input type="radio" name="show" value="14"></label></li>
	    <li><label>21<input type="radio" name="show" value="21"></label></li>
	</ul>
    </div>
</div><!-- content-filter -->
</form>
<div class="main-content with-filter" id="viewSpros">
    <?php foreach ($model as $item) { 
	
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
	    <?php if(count($res_items) > 0) { ?><a href="#" class="button"><span class="open">Открыть подходящие объекты (<?php echo count($res_items); ?>)</span><span class="close">Закрыть подходящие объекты (<?php echo count($res_items); ?>)</span></a><?php } ?>
	</div><!-- end request-result -->
	
    </div><!-- end request-block -->
    <?php } ?>
    
</div>
<div class="main-content with-filter">
    <a href="#" class="button bottom-button" id="moreObj"><i class="icon-12"></i>Загрузить еще объекты</a>
    <div class="content-pagination-wrap" style="">
	<ul class="content-pagination">
	    <li><a href="#" class="prev"><i class="icon-22"></i>Предыдущая</a></li>
	    <li><a href="#" class="active">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">5</a></li>
	    <li><a href="#">6</a></li>
	    <li><a href="#">7</a></li>
	    <li><a href="#">8</a></li>
	    <li><a href="#">9</a></li>
	    <li><a href="#">...</a></li>
	<li><a href="#" class="next">Следующая<i class="icon-23"></i></a></li>
	</ul><!-- end content-pagination -->
    </div><!-- end content-pagination-wrap -->
</div><!-- end main-content-->
<div class="clear"></div>

<script type="text/javascript">
    var form = "#filterSprosInput";
    var url = "<?php echo $this->createUrl('spros/viewspros'); ?>";
    
    $(document).ready(function() {
	
    });
    
    $(function() {
	$(document).on('change', "input", function() {
	    //console.log($(this).val());// - переключение кнопок
	    changeView(form, url);
	});
	
	$(document).on('click', ".func", function() {
	    id = $(".func").attr('data-value');
	    //console.log($(this).attr('data-value')); // - событие на выбор помещения
	    changeView(form, url + "?funcid=" + id);
	});
	
	$(document).on('click', "input[name=funcCat]", function() {
	    url2 = "<?php echo $this->createUrl('spros/listfuncbuild', array('catid' => NULL)); ?>"+$("input[name=funcCat]").val();
	    $.ajax({
		url: url2,
		type: "POST",
		success: function( out ) {
		    $('.func-list').html(out.data);
		    $('#typeBuild .title').text(out.title);
		    $('#filter_funcid').val(out.id)
		},
		dataType: 'json',
	    });
	});
	
    });
    
    function pagination () {
	
    }
    
    function changeView (form, url) {
	input = $(form).serialize();
	$.ajax({
	    url: url,
	    type: "POST",
	    data: input,
	    success: function(data) {
		$('#viewSpros').html(data);
		//alert(data.mess);
	    },
	    //dataType: 'json'
	});
	console.log(input);
    }
</script>