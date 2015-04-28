<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'so_name'); ?>
		<?php echo $form->textField($model,'so_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'so_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otchestvo'); ?>
		<?php echo $form->textField($model,'otchestvo',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'otchestvo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'e_mail'); ?>
		<?php echo $form->textField($model,'e_mail',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'e_mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organization'); ?>
		<?php echo $form->textField($model,'organization',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'organization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_moder'); ?>
		<?php echo $form->textField($model,'info_moder'); ?>
		<?php echo $form->error($model,'info_moder'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_order'); ?>
		<?php echo $form->textField($model,'info_order'); ?>
		<?php echo $form->error($model,'info_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_deactivate'); ?>
		<?php echo $form->textField($model,'info_deactivate'); ?>
		<?php echo $form->error($model,'info_deactivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auto_notepad'); ?>
		<?php echo $form->textField($model,'auto_notepad'); ?>
		<?php echo $form->error($model,'auto_notepad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_flag_phone'); ?>
		<?php echo $form->textField($model,'info_flag_phone'); ?>
		<?php echo $form->error($model,'info_flag_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_flag_email'); ?>
		<?php echo $form->textField($model,'info_flag_email'); ?>
		<?php echo $form->error($model,'info_flag_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_phone'); ?>
		<?php echo $form->textField($model,'info_phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'info_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_email'); ?>
		<?php echo $form->textField($model,'info_email',array('size'=>39,'maxlength'=>39)); ?>
		<?php echo $form->error($model,'info_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codeReg'); ?>
		<?php echo $form->textField($model,'codeReg',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'codeReg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codeDate'); ?>
		<?php echo $form->textField($model,'codeDate'); ?>
		<?php echo $form->error($model,'codeDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parag1_name'); ?>
		<?php echo $form->textField($model,'parag1_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'parag1_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parag2_name'); ?>
		<?php echo $form->textField($model,'parag2_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'parag2_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parag1_text'); ?>
		<?php echo $form->textField($model,'parag1_text',array('size'=>60,'maxlength'=>8196)); ?>
		<?php echo $form->error($model,'parag1_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parag2_text'); ?>
		<?php echo $form->textField($model,'parag2_text',array('size'=>60,'maxlength'=>8196)); ?>
		<?php echo $form->error($model,'parag2_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icq'); ?>
		<?php echo $form->textField($model,'icq',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'icq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'soc_photo'); ?>
		<?php echo $form->textField($model,'soc_photo',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'soc_photo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->