<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'Update Items', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Items', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>View Items #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent',
		'kind',
		'itemType',
		'status',
		'special',
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
	),
)); ?>
