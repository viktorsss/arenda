<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('so_name')); ?>:</b>
	<?php echo CHtml::encode($data->so_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otchestvo')); ?>:</b>
	<?php echo CHtml::encode($data->otchestvo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_mail')); ?>:</b>
	<?php echo CHtml::encode($data->e_mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organization')); ?>:</b>
	<?php echo CHtml::encode($data->organization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_moder')); ?>:</b>
	<?php echo CHtml::encode($data->info_moder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_order')); ?>:</b>
	<?php echo CHtml::encode($data->info_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_deactivate')); ?>:</b>
	<?php echo CHtml::encode($data->info_deactivate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('auto_notepad')); ?>:</b>
	<?php echo CHtml::encode($data->auto_notepad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_flag_phone')); ?>:</b>
	<?php echo CHtml::encode($data->info_flag_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_flag_email')); ?>:</b>
	<?php echo CHtml::encode($data->info_flag_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_phone')); ?>:</b>
	<?php echo CHtml::encode($data->info_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_email')); ?>:</b>
	<?php echo CHtml::encode($data->info_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codeReg')); ?>:</b>
	<?php echo CHtml::encode($data->codeReg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codeDate')); ?>:</b>
	<?php echo CHtml::encode($data->codeDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parag1_name')); ?>:</b>
	<?php echo CHtml::encode($data->parag1_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parag2_name')); ?>:</b>
	<?php echo CHtml::encode($data->parag2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parag1_text')); ?>:</b>
	<?php echo CHtml::encode($data->parag1_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parag2_text')); ?>:</b>
	<?php echo CHtml::encode($data->parag2_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skype')); ?>:</b>
	<?php echo CHtml::encode($data->skype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icq')); ?>:</b>
	<?php echo CHtml::encode($data->icq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('soc_photo')); ?>:</b>
	<?php echo CHtml::encode($data->soc_photo); ?>
	<br />

	*/ ?>

</div>