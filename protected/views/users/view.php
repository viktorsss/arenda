<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'state',
		'username',
		'password',
		'role',
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
	),
)); ?>
