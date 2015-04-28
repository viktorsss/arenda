<?php
/* @var $this SprosController */
/* @var $model Spros */

$this->breadcrumbs=array(
	'Sproses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Spros', 'url'=>array('index')),
	array('label'=>'Manage Spros', 'url'=>array('admin')),
);
?>

<h1>Create Spros</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>