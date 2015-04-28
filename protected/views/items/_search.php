<?php
/* @var $this ItemsController */
/* @var $model Items */
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
		<?php echo $form->label($model,'parent'); ?>
		<?php echo $form->textField($model,'parent',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kind'); ?>
		<?php echo $form->textField($model,'kind'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'itemType'); ?>
		<?php echo $form->textField($model,'itemType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special'); ?>
		<?php echo $form->textField($model,'special'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_changed'); ?>
		<?php echo $form->textField($model,'status_changed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_id'); ?>
		<?php echo $form->textField($model,'owner_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'district'); ?>
		<?php echo $form->textField($model,'district',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kind_structure'); ?>
		<?php echo $form->textField($model,'kind_structure',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'functionality'); ?>
		<?php echo $form->textField($model,'functionality',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>47,'maxlength'=>47)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'class'); ?>
		<?php echo $form->textField($model,'class',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'house'); ?>
		<?php echo $form->textField($model,'house',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'housing'); ?>
		<?php echo $form->textField($model,'housing',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'storey'); ?>
		<?php echo $form->textField($model,'storey'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'storeys'); ?>
		<?php echo $form->textField($model,'storeys'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_lift'); ?>
		<?php echo $form->textField($model,'service_lift'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_item_sqr'); ?>
		<?php echo $form->textField($model,'total_item_sqr',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'repair'); ?>
		<?php echo $form->textField($model,'repair',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parking'); ?>
		<?php echo $form->textField($model,'parking',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fixed_qty'); ?>
		<?php echo $form->textField($model,'fixed_qty',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'video'); ?>
		<?php echo $form->textField($model,'video'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'access'); ?>
		<?php echo $form->textField($model,'access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_utilities'); ?>
		<?php echo $form->textField($model,'pay_utilities',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'internet'); ?>
		<?php echo $form->textField($model,'internet'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'providers'); ?>
		<?php echo $form->textField($model,'providers',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telephony'); ?>
		<?php echo $form->textField($model,'telephony'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tel_company'); ?>
		<?php echo $form->textField($model,'tel_company',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contr_condition'); ?>
		<?php echo $form->textField($model,'contr_condition',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about'); ?>
		<?php echo $form->textField($model,'about',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'welfare'); ?>
		<?php echo $form->textField($model,'welfare',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'heating'); ?>
		<?php echo $form->textField($model,'heating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pallet_capacity'); ?>
		<?php echo $form->textField($model,'pallet_capacity',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shelf_capacity'); ?>
		<?php echo $form->textField($model,'shelf_capacity',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ceiling_height'); ?>
		<?php echo $form->textField($model,'ceiling_height',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'work_height'); ?>
		<?php echo $form->textField($model,'work_height',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cathead'); ?>
		<?php echo $form->textField($model,'cathead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flooring'); ?>
		<?php echo $form->textField($model,'flooring',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'floor_load'); ?>
		<?php echo $form->textField($model,'floor_load',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ventilation'); ?>
		<?php echo $form->textField($model,'ventilation',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'air_condit'); ?>
		<?php echo $form->textField($model,'air_condit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firefighting'); ?>
		<?php echo $form->textField($model,'firefighting'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'can_reclame'); ?>
		<?php echo $form->textField($model,'can_reclame'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'el_power'); ?>
		<?php echo $form->textField($model,'el_power',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gates_qty'); ?>
		<?php echo $form->textField($model,'gates_qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gates_height'); ?>
		<?php echo $form->textField($model,'gates_height',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rampant'); ?>
		<?php echo $form->textField($model,'rampant'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'autoways'); ?>
		<?php echo $form->textField($model,'autoways'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'railways'); ?>
		<?php echo $form->textField($model,'railways'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->