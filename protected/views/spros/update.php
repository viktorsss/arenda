<?php
/* @var $this SprosController */
/* @var $model Spros */

$this->breadcrumbs=array(
	'Sproses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Spros', 'url'=>array('index')),
	array('label'=>'Create Spros', 'url'=>array('create')),
	array('label'=>'View Spros', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Spros', 'url'=>array('admin')),
);
?>

<h1>Update Spros <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>