<?php
/* @var $this SprosController */
/* @var $model Spros */

$this->breadcrumbs=array(
	'Sproses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Spros', 'url'=>array('index')),
	array('label'=>'Create Spros', 'url'=>array('create')),
	array('label'=>'Update Spros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Spros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Spros', 'url'=>array('admin')),
);
?>

<h1>View Spros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'distr',
		'area',
		'price',
		'typeprice',
		'komision',
		'hits',
		'created',
	),
)); ?>
