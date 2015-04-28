<form id="settings_form" action="" method="POST">
    <div class="leftcol">
	<h2>Уведомления</h2>
	<div class="content-white">
	    <p class="comment">Спам и прочую ересь не рассылаем.</p>
	    <h4>Уведомлять меня о новых объектах по моим заявкам</h4>
	    <ul class="notification-list">
		<li><label class="checkbox grey <?php echo isset($params['new_sms']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[new][sms]" value="1"<?php echo isset($params['new_sms']) ? " checked" : ""; ?> />SMS</label></li>
		<li><label class="checkbox grey <?php echo isset($params['new_email']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[new][email]" value="1"<?php echo isset($params['new_email']) ? " checked" : ""; ?> />E-mail</label></li>
		<li><label class="checkbox grey <?php echo isset($params['new_viewSobst']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[new][viewSobst]" value="1" <?php echo isset($params['new_viewSobst']) ? "checked" : ""; ?> />Показывать мои заявки собственникам</label></li>
		<li><label class="checkbox grey <?php echo isset($params['new_autoAddNP']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[new][autoAddNP]" value="1" <?php echo isset($params['new_autoAddNP']) ? "checked" : ""; ?> />Автоматически добавлять объекты в мой блокнот</label></li>
		<li><label class="checkbox grey <?php echo isset($params['new_editNP']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[new][editNP]" value="1" <?php echo isset($params['new_editNP']) ? "checked" : ""; ?> />Уведомлять меня об изменении объектов в моем блокноте</label></li>
	    </ul>
	    <h4>Уведомлять меня о спросе на мои объекты</h4>
	    <ul class="notification-list">
		<li><label class="checkbox grey <?php echo isset($params['spros_sms']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[spros][sms]" value='1' <?php echo isset($params['spros_sms']) ? "checked" : ""; ?> />SMS</label></li>
		<li><label class="checkbox grey <?php echo isset($params['spros_email']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[spros][email]" value="1" <?php echo isset($params['spros_email']) ? "checked" : ""; ?> />E-mail</label></li>
	    </ul>
	    <h4>Уведомлять меня об изменении статуса моих объектов</h4>
	    <ul class="notification-list">
		<li><label class="checkbox grey <?php echo isset($params['status_sms']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[status][sms]" value="1" <?php echo isset($params['status_sms']) ? "checked" : ""; ?> />SMS</label></li>
		<li><label class="checkbox grey <?php echo isset($params['status_email']) ? "checked" : ""; ?>"><input type="checkbox" name="Sett[status][email]" value="1" <?php echo isset($params['status_email']) ? "checked" : ""; ?> />E-mail</label></li>
	    </ul>
	</div>
    </div>
    <div class="rightcol">
	<h2>Контактные данные</h2>
	<div class="content-white">
	    <span class="label">Телефон для SMS</span>
	    <p class="phone"><label><input type="text" name="Sett[phone]" value="<?php echo $model->phone; ?>" class="mask-input"/></label></p>
	    <span class="label">E-mail для уведомлений</span>
	    <p><label><input type="text" name="Sett[e_mail]" value="<?php echo $model->e_mail ?>"/></label></p>
	</div>
	<h2>Смена пароля доступа</h2>
	<div class="content-white">
	    <span class="label">Введите новый пароль</span>
	    <p><label class="password-label"><input name="Sett[pass]" id="pass" class="" type="password" value=""/><!-- i class="icon-32"></i --></label></p>
	    <span class="label">Повторите пароль</span>
	    <p><label class="password-label"><input id="pass_ret" name="" class="" type="password" value=""/><!-- span class="error">Пароли не совпадают</span><i class="icon-30"></i --></label></p>
	</div>
    </div>
</form>
<div class="clear"></div>
<a href="#" id="sendForm" class="button bottom-button">Сохранить изменения</a>

<script type="text/javascript">
    /*
     $(function () {
     $(document).on('click', '#sendForm', function () {
     $.ajax({
     url: "/users/savesettings",
     type: "POST",
     data: $("#settings_form").serialize(),
     success: function (data) {
     console.log(data);
     //alert(data.mess);
     },
     dataType: 'json'
     });
     });
     });
     */

    $(function () {
	$('#settings_form').each(function () {
	    // Объявляем переменные (форма и кнопка отправки)
	    var form = $(this), btn = $('#sendForm');

	    // Добавляем каждому проверяемому полю, указание что поле пустое
	    form.find('.rfield').addClass('empty_field');

	    // Функция проверки полей формы
	    function checkInput() {
		form.find('.rfield').each(function () {
		    if ($(this).val() != '') {
			// Если поле не пустое удаляем класс-указание
			$(this).removeClass('empty_field');
		    } else {
			// Если поле пустое добавляем класс-указание
			$(this).addClass('empty_field');
		    }
		});
	    }

	    // Функция подсветки незаполненных полей
	    function lightEmpty() {
		form.find('.empty_field').css({'border-color': '#d8512d'});
		// Через полсекунды удаляем подсветку
		setTimeout(function () {
		    form.find('.empty_field').removeAttr('style');
		}, 500);
	    }
	    // Проверка в режиме реального времени
	    setInterval(function () {
		// Запускаем функцию проверки полей на заполненность
		checkInput();
		// Считаем к-во незаполненных полей
		var sizeEmpty = form.find('.empty_field').size();
		// Вешаем условие-тригер на кнопку отправки формы
		if (sizeEmpty > 0) {
		    if (btn.hasClass('disable')) {
			return false
		    } else {
			btn.addClass('disable')
		    }
		} else {
		    btn.removeClass('disable')
		}
	    }, 500);

	    // Событие клика по кнопке отправить
	    btn.click(function () {
		if ($(this).hasClass('disable')) {
		    // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
		    lightEmpty();
		    return false
		} else {
		    // Все хорошо, все заполнено, отправляем форму
		    //form.submit();
		    //btn.replaceWith("<em>отправка...</em>");
		    $.ajax({
			url: "/users/savesettings",
			type: "POST",
			data: $("#settings_form").serialize(),
			success: function (out) {
			    text = btn.text();
			    if (out.code == 1) {
				btn.text(out.mess).css({'background-color': '#0f0', 'color': '#000'});
				setTimeout(function () {
				    btn.text(text).css({'background': '#e2e2e2', 'color': '#000'});
				}, 2000);
			    } else {
				alert(out.mess);
			    }
			},
			dataType: 'json'
		    });
		}
	    });
	});
    });
</script>