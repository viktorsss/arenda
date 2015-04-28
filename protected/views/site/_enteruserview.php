<div class="enter-person-block">
    <p class="title">Вы вошли как</p>
    <div class="card">
	<img src="<?php echo $model->photo; ?>" alt="" />
	<div class="details">
	    <p class="account-name">
		<span class="first-name"><?php echo $model->name; ?><!-- span class="icon-pro">PRO</span --></span>
		<span class="last-name"><?php echo $model->so_name; ?></span>
	    </p>
	    <p class="account"><a href="<?php echo $this->createUrl('users/profile'); ?>">Личный кабинет</a></p>
	</div>
	<div class="clear"></div>
    </div>
    <form action="#">
	<p class="no-data">Проверте правильность введеных данных!</p>
	<p><label><span>Имя<i>*</i>:</span><input type="text" placeholder="Ваше имя" value="<?php echo $model->name; ?>" /></label></p>
	<p><label><span>Телефон<i>*</i>:</span><input type="text" class="phone-input" placeholder="+7 (___) ___ ____" value="<?php echo $model->phone; ?>" /></label></p>	
	<p><label><span>E-mail<i>*</i>:</span><input type="text" placeholder="your@mail.ru" value="<?php echo $model->e_mail; ?>" /></label></p>
	<p><input type="submit" value="Сохранить данные"/></p>
	<a href="#" class="button remind-link">Напомнить позже</a>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
	$(".enter-person-block").parent().removeAttr('class');
    });
</script>