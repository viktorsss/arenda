<?php
/* @var $this ItemsController */
/* @var $data Items */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo CHtml::encode($data->parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kind')); ?>:</b>
	<?php echo CHtml::encode($data->kind); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemType')); ?>:</b>
	<?php echo CHtml::encode($data->itemType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special')); ?>:</b>
	<?php echo CHtml::encode($data->special); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_changed')); ?>:</b>
	<?php echo CHtml::encode($data->status_changed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
	<?php echo CHtml::encode($data->owner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district')); ?>:</b>
	<?php echo CHtml::encode($data->district); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kind_structure')); ?>:</b>
	<?php echo CHtml::encode($data->kind_structure); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('functionality')); ?>:</b>
	<?php echo CHtml::encode($data->functionality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
	<?php echo CHtml::encode($data->class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('house')); ?>:</b>
	<?php echo CHtml::encode($data->house); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('housing')); ?>:</b>
	<?php echo CHtml::encode($data->housing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('storey')); ?>:</b>
	<?php echo CHtml::encode($data->storey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('storeys')); ?>:</b>
	<?php echo CHtml::encode($data->storeys); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_lift')); ?>:</b>
	<?php echo CHtml::encode($data->service_lift); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_item_sqr')); ?>:</b>
	<?php echo CHtml::encode($data->total_item_sqr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('repair')); ?>:</b>
	<?php echo CHtml::encode($data->repair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parking')); ?>:</b>
	<?php echo CHtml::encode($data->parking); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fixed_qty')); ?>:</b>
	<?php echo CHtml::encode($data->fixed_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video')); ?>:</b>
	<?php echo CHtml::encode($data->video); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access')); ?>:</b>
	<?php echo CHtml::encode($data->access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_utilities')); ?>:</b>
	<?php echo CHtml::encode($data->pay_utilities); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internet')); ?>:</b>
	<?php echo CHtml::encode($data->internet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('providers')); ?>:</b>
	<?php echo CHtml::encode($data->providers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephony')); ?>:</b>
	<?php echo CHtml::encode($data->telephony); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel_company')); ?>:</b>
	<?php echo CHtml::encode($data->tel_company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contr_condition')); ?>:</b>
	<?php echo CHtml::encode($data->contr_condition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('about')); ?>:</b>
	<?php echo CHtml::encode($data->about); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('welfare')); ?>:</b>
	<?php echo CHtml::encode($data->welfare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('heating')); ?>:</b>
	<?php echo CHtml::encode($data->heating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pallet_capacity')); ?>:</b>
	<?php echo CHtml::encode($data->pallet_capacity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shelf_capacity')); ?>:</b>
	<?php echo CHtml::encode($data->shelf_capacity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ceiling_height')); ?>:</b>
	<?php echo CHtml::encode($data->ceiling_height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_height')); ?>:</b>
	<?php echo CHtml::encode($data->work_height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cathead')); ?>:</b>
	<?php echo CHtml::encode($data->cathead); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flooring')); ?>:</b>
	<?php echo CHtml::encode($data->flooring); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floor_load')); ?>:</b>
	<?php echo CHtml::encode($data->floor_load); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ventilation')); ?>:</b>
	<?php echo CHtml::encode($data->ventilation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('air_condit')); ?>:</b>
	<?php echo CHtml::encode($data->air_condit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firefighting')); ?>:</b>
	<?php echo CHtml::encode($data->firefighting); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('can_reclame')); ?>:</b>
	<?php echo CHtml::encode($data->can_reclame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('el_power')); ?>:</b>
	<?php echo CHtml::encode($data->el_power); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gates_qty')); ?>:</b>
	<?php echo CHtml::encode($data->gates_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gates_height')); ?>:</b>
	<?php echo CHtml::encode($data->gates_height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rampant')); ?>:</b>
	<?php echo CHtml::encode($data->rampant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('autoways')); ?>:</b>
	<?php echo CHtml::encode($data->autoways); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('railways')); ?>:</b>
	<?php echo CHtml::encode($data->railways); ?>
	<br />

	*/ ?>

</div>