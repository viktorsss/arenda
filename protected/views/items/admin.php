<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Items</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'parent',
		'kind',
		'itemType',
		'status',
		'special',
		/*
		'created',
		'status_changed',
		'owner_id',
		'city',
		'district',
		'kind_structure',
		'functionality',
		'name',
		'class',
		'street',
		'house',
		'housing',
		'storey',
		'storeys',
		'service_lift',
		'total_item_sqr',
		'repair',
		'parking',
		'fixed_qty',
		'video',
		'access',
		'price',
		'pay_utilities',
		'internet',
		'providers',
		'telephony',
		'tel_company',
		'contr_condition',
		'about',
		'welfare',
		'heating',
		'pallet_capacity',
		'shelf_capacity',
		'ceiling_height',
		'work_height',
		'cathead',
		'flooring',
		'floor_load',
		'ventilation',
		'air_condit',
		'firefighting',
		'can_reclame',
		'el_power',
		'gates_qty',
		'gates_height',
		'rampant',
		'autoways',
		'railways',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
