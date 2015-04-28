<?php $user = Users::model()->findByPk(Yii::app()->user->id); ?>
<div class="account-card sidebar-top">
    <?php if(isset($user->photo)) { ?><img src="<?php echo $user->photo; ?>" alt="" /><?php } ?>
    <div class="details">
        <a href="<?php echo $this->createUrl('users/profile'); ?>" class="account-name">
            <span class="first-name"><?php echo $user->name; ?><!-- span class="icon-lite">LITE</span --></span>
            <span class="last-name"><?php echo $user->so_name; ?></span>
	</a>
        <a href="<?php echo $this->createUrl('site/logout'); ?>" class="exit"><span>Выход</span><!-- i class="icon-11"></i --></a>
    </div>
</div><!-- end account-card -->