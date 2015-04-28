<h2>Спрос<span class="comment">всего <?php echo count($model); ?></span></h2>
<form id="filterSprosInput" method="POST" action="">
<div class="content-filter">
    <div class="unit">
	<h4>Тип сделки</h4>
	<ul class="view">
	    <li><label class="checked">Продажа <span><?php echo Spros::model()->countByAttributes(array('city' => $this->city_name, 'trans' => 2)) ?></span><input type="radio" checked name="trans" value="2"></label></li>
	    <li><label>Аренда <span><?php echo Spros::model()->countByAttributes(array('city' => $this->city_name, 'trans' => 1)) ?></span><input type="radio" name="trans" value="1"></label></li>
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
<div id="viewSpros" class="main-content with-filter">
    <?php foreach ($model as $item) {
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
		    <span class="general">Размещено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yy', $item->created); ?></span>
		    <span class="general">Активно до: </span>
		</div>
	    </div>
	    <div class="rightcol">
		<?php $data = json_decode($item->data, true);
		if(isset($data['distr'])) {
		    foreach ($data['distr'] as $d) {
			$districts[] = Districts::model()->findByPk($d)->name;
		    }
		}
		?>
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
    <?php } ?>
    <a href="#" class="button bottom-button"><i class="icon-12"></i>Загрузить еще объекты</a>
    <div class="content-pagination-wrap">
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
</div><!-- end main-content -->
<div class="clear"></div>
<script type="text/javascript">
    var form = "#filterSprosInput";
    var url = "<?php echo $this->createUrl('spros/indexviewspros'); ?>";
    
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