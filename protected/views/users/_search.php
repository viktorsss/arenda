<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'so_name'); ?>
		<?php echo $form->textField($model,'so_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otchestvo'); ?>
		<?php echo $form->textField($model,'otchestvo',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_mail'); ?>
		<?php echo $form->textField($model,'e_mail',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'organization'); ?>
		<?php echo $form->textField($model,'organization',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_moder'); ?>
		<?php echo $form->textField($model,'info_moder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_order'); ?>
		<?php echo $form->textField($model,'info_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_deactivate'); ?>
		<?php echo $form->textField($model,'info_deactivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'auto_notepad'); ?>
		<?php echo $form->textField($model,'auto_notepad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_flag_phone'); ?>
		<?php echo $form->textField($model,'info_flag_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_flag_email'); ?>
		<?php echo $form->textField($model,'info_flag_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_phone'); ?>
		<?php echo $form->textField($model,'info_phone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info_email'); ?>
		<?php echo $form->textField($model,'info_email',array('size'=>39,'maxlength'=>39)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codeReg'); ?>
		<?php echo $form->textField($model,'codeReg',array('size'=>14,'maxlength'=>14)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codeDate'); ?>
		<?php echo $form->textField($model,'codeDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parag1_name'); ?>
		<?php echo $form->textField($model,'parag1_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parag2_name'); ?>
		<?php echo $form->textField($model,'parag2_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parag1_text'); ?>
		<?php echo $form->textField($model,'parag1_text',array('size'=>60,'maxlength'=>8196)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parag2_text'); ?>
		<?php echo $form->textField($model,'parag2_text',array('size'=>60,'maxlength'=>8196)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'icq'); ?>
		<?php echo $form->textField($model,'icq',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'soc_photo'); ?>
		<?php echo $form->textField($model,'soc_photo',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->