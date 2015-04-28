<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model,'parent',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kind'); ?>
		<?php echo $form->textField($model,'kind'); ?>
		<?php echo $form->error($model,'kind'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'itemType'); ?>
		<?php echo $form->textField($model,'itemType'); ?>
		<?php echo $form->error($model,'itemType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special'); ?>
		<?php echo $form->textField($model,'special'); ?>
		<?php echo $form->error($model,'special'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_changed'); ?>
		<?php echo $form->textField($model,'status_changed'); ?>
		<?php echo $form->error($model,'status_changed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner_id'); ?>
		<?php echo $form->textField($model,'owner_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'owner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->textField($model,'district',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kind_structure'); ?>
		<?php echo $form->textField($model,'kind_structure',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kind_structure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'functionality'); ?>
		<?php echo $form->textField($model,'functionality',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'functionality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>47,'maxlength'=>47)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'class'); ?>
		<?php echo $form->textField($model,'class',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'house'); ?>
		<?php echo $form->textField($model,'house',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'house'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'housing'); ?>
		<?php echo $form->textField($model,'housing',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'housing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'storey'); ?>
		<?php echo $form->textField($model,'storey'); ?>
		<?php echo $form->error($model,'storey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'storeys'); ?>
		<?php echo $form->textField($model,'storeys'); ?>
		<?php echo $form->error($model,'storeys'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_lift'); ?>
		<?php echo $form->textField($model,'service_lift'); ?>
		<?php echo $form->error($model,'service_lift'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_item_sqr'); ?>
		<?php echo $form->textField($model,'total_item_sqr',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_item_sqr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repair'); ?>
		<?php echo $form->textField($model,'repair',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'repair'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parking'); ?>
		<?php echo $form->textField($model,'parking',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'parking'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fixed_qty'); ?>
		<?php echo $form->textField($model,'fixed_qty',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fixed_qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'video'); ?>
		<?php echo $form->textField($model,'video'); ?>
		<?php echo $form->error($model,'video'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'access'); ?>
		<?php echo $form->textField($model,'access'); ?>
		<?php echo $form->error($model,'access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pay_utilities'); ?>
		<?php echo $form->textField($model,'pay_utilities',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pay_utilities'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'internet'); ?>
		<?php echo $form->textField($model,'internet'); ?>
		<?php echo $form->error($model,'internet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'providers'); ?>
		<?php echo $form->textField($model,'providers',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'providers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephony'); ?>
		<?php echo $form->textField($model,'telephony'); ?>
		<?php echo $form->error($model,'telephony'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel_company'); ?>
		<?php echo $form->textField($model,'tel_company',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tel_company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contr_condition'); ?>
		<?php echo $form->textField($model,'contr_condition',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'contr_condition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textField($model,'about',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'welfare'); ?>
		<?php echo $form->textField($model,'welfare',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'welfare'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'heating'); ?>
		<?php echo $form->textField($model,'heating'); ?>
		<?php echo $form->error($model,'heating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pallet_capacity'); ?>
		<?php echo $form->textField($model,'pallet_capacity',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pallet_capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shelf_capacity'); ?>
		<?php echo $form->textField($model,'shelf_capacity',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'shelf_capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ceiling_height'); ?>
		<?php echo $form->textField($model,'ceiling_height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ceiling_height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_height'); ?>
		<?php echo $form->textField($model,'work_height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'work_height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cathead'); ?>
		<?php echo $form->textField($model,'cathead'); ?>
		<?php echo $form->error($model,'cathead'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flooring'); ?>
		<?php echo $form->textField($model,'flooring',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'flooring'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floor_load'); ?>
		<?php echo $form->textField($model,'floor_load',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'floor_load'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ventilation'); ?>
		<?php echo $form->textField($model,'ventilation',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ventilation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'air_condit'); ?>
		<?php echo $form->textField($model,'air_condit'); ?>
		<?php echo $form->error($model,'air_condit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firefighting'); ?>
		<?php echo $form->textField($model,'firefighting'); ?>
		<?php echo $form->error($model,'firefighting'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'can_reclame'); ?>
		<?php echo $form->textField($model,'can_reclame'); ?>
		<?php echo $form->error($model,'can_reclame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'el_power'); ?>
		<?php echo $form->textField($model,'el_power',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'el_power'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gates_qty'); ?>
		<?php echo $form->textField($model,'gates_qty'); ?>
		<?php echo $form->error($model,'gates_qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gates_height'); ?>
		<?php echo $form->textField($model,'gates_height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'gates_height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rampant'); ?>
		<?php echo $form->textField($model,'rampant'); ?>
		<?php echo $form->error($model,'rampant'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autoways'); ?>
		<?php echo $form->textField($model,'autoways'); ?>
		<?php echo $form->error($model,'autoways'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'railways'); ?>
		<?php echo $form->textField($model,'railways'); ?>
		<?php echo $form->error($model,'railways'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->