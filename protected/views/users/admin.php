<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'created',
		'state',
		'username',
		'password',
		'role',
		/*
		'name',
		'so_name',
		'otchestvo',
		'e_mail',
		'phone',
		'organization',
		'info_moder',
		'info_order',
		'info_deactivate',
		'auto_notepad',
		'info_flag_phone',
		'info_flag_email',
		'info_phone',
		'info_email',
		'codeReg',
		'codeDate',
		'parag1_name',
		'parag2_name',
		'parag1_text',
		'parag2_text',
		'city',
		'skype',
		'icq',
		'photo',
		'soc_photo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
