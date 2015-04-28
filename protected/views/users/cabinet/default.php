<div class="profile minified">
    <div class="account-card">
        <img src="<?php echo $model->photo; ?>" alt="" />
	<div class="details">
            <p class="account-name">
		<span class="first-name"><?php echo $model->name; ?><!-- span class="icon-pro">PRO</span --></span>
		<span class="last-name"><?php echo $model->so_name; ?></span>
            </p>
            <table class="objects-rating">
		<tr><td>Объектов</td><td>0</td></tr>
		<tr><td>Рейтинг</td><td>0</td></tr>
            </table>
	    <?php if(isset($in_comp)) { 
		$company = UsersCompany::model()->findByPk($in_comp->comp_id);
		?>
	    <p><b>Работает в компании:</b><a href="#" class="company-name"> <?php echo $company->organization; ?> <img src="<?php echo $company->photo_org; ?>" alt="" /></a></p><?php } ?>
            <p><b><?php echo $model->slogan; ?></b></p>
            <a href="<?php echo $this->createUrl('users/profileedit'); ?>" class="button">Редактировать страницу</a>
            <!-- a href="#" class="preview-link">Просмотр страницы<i class="icon-43"></i></a -->
	</div>
    </div><!-- end account-card -->
    <div class="personal-data">
	<?php if($model->tarif > 1) { 
	    $str = explode("\n", $model->promotext);
	    ?><p><?php echo implode("<br/>", $str); ?></p><?php } ?>
	<ul>
            <li><span>Город:</span><b><?php echo $model->city; ?></b></li>
            <li><span>Телефон:</span><b><?php echo $model->phone; ?> <br/> 
		<?php foreach ($phones as $item) {echo $item->value."<br/>";} ?></b></li>
            <li><span>E-mail:</span><b><?php echo $model->e_mail ?></b></li>
	    <?php foreach($contacts as $item) { ?>
		<li><span><?php echo $item->name; ?>:</span><b><?php echo $item->value; ?></b></li>
	    <?php } ?>
	</ul>
    </div><!-- end personal-data -->
    <div class="clear"></div>
</div><!-- end profile -->