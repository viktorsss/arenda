<div class="content-white">
    <p class="entered-as">Вы вошли как</p>
    <div class="card">
        <a href="<?php echo $this->createUrl('users/profile'); ?>"><img src="<?php echo $model->photo; ?>" alt="" /></a>
	<div class="details">
            <p class="account-name">
                <span class="first-name"><?php echo $model->name; ?><!-- span class="icon-pro">PRO</span><i class="icon-19"></i --></span>
                <span class="last-name"><?php echo $model->so_name; ?></span>
            </p>
            <a class="exit"><span>Выход</span> <i class="icon-11"></i></a>
	</div>
	<div class="clear"></div>
    </div>
    <form action="<?php echo $this->createUrl('users/profileedit'); ?>" method="POST">
	<p><label><span>Имя<i>*</i>:</span><b class="input-data"><?php echo $model->name; ?></b></label></p>
	<p><label><span>Телефон<i>*</i>:</span><b class="input-data"><?php echo $model->phone; ?></b></label></p>	
	<p><label><span>E-mail<i>*</i>:</span><b class="input-data"><?php echo $model->e_mail; ?></b></label></p>
	<p>Проверьте свои данные. <br/>Их можно изменить нажав кнопку “изменить данные”.</p>
	<p><input type="submit" value="Изменить данные"/></p>
    </form>
</div><!-- end content-white -->

<div class="right-part">
    <span class="title">Разместить объект на</span>
    <div class="leftcol-990">
	<div class="select-wrap">
            <input type="hidden" id="placing" name="placing" value="1" />
            <div class="select">
		<span class="title">1 неделю</span>
		<a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
            </div>
            <ul class="option-list">
		<li data-value="1">1 неделю</li>
		<li data-value="2">2 недели</li>
		<li data-value="3">3 недели</li>
		<li data-value="4">4 недели</li>
            </ul>
	</div>
	<a class="add-button disabled disabled-f" id="addProdButt">Разместить объявление</a>
        <p><label class="checkbox grey"><input type="checkbox" id="police" /><b>Согласен с </b><a href="#">правилами сайта</a></label></p>
    </div>
    <div class="rightcol-990">
        <p>Перед размещением объявления наш администратор, быстро проверит детали и исправит мелкие ошибки. После публикации объявления вы получите уведомление.</p>
        <p class="send-to-moderation" style="display: none;"><span>Объявление </span><span>отправлено на модерацию.</span></p>
        <p class="fieldEmpty_mess" style="display: none;"><span>Ошибка </span><span>Заполните обязательные поля.</span></p>
    </div>
    <div class="clear"></div>
</div><!-- end right-part -->
<script type="text/javascript">
    $(document).ready(function () {
	$("#police").on('click', function () {
	    $("#addProdButt").removeClass('disabled');
	});

	$('#addProdButt').on('click', function () {
	    //alert('pipipi');
	    if ($('#police').is(':checked')) {
		if (!$(this).hasClass('disabled-f')) {
		    place = $("#placing").val();
		    $.ajax({
			type: 'POST',
			url: '/items/saveaddnew?place=' + place,
			data: $("#addProdForm").serialize(),
			success: function (data) {
			    out = JSON.parse(data);
			    if (out.code == 1) {
				$("#addProdForm").find("input[type=text], textarea").val("");
				$(".send-to-moderation").show('slow');
				$("#addProdButt").addClass('disabled');
				$('input[type=checkbox]').attr('checked', false).parent().removeClass('checked');
				$('input[type=radio]').attr('checked', false).parent().removeClass('checked');
				$('.hidden-block').hide();
				$(".request-pictures-main").remove();
				$("#otherImgTitle").remove();
				$(".file-list-item.img-wrap").remove();
				timer = setTimeout(function () {
				    $("html, body").animate({scrollTop: 0}, "slow");
				}, 2000);

				/*url = "";
				 $.post( url, function(mydata) {
				 $('.enter-block').html(mydata);
				 });
				 setTimeout(function(){
				 //$.arcticmodal('close');
				 }, 5000); */
			    } else {
				alert(out.data);
			    }
			}
		    });
		} else {
		    $(".fieldEmpty_mess").show('slow');
		    lightEmpty();
		}
	    } else {
		alert("Согласитесь с правилами пользования сайтом");
	    }


	});
	$(".exit").click(function () {
	    $.post("/site/logout");
	});
    });


    $(function () {
	var form = $("#addProdForm"), btn = form.find("#addProdButt");

	form.find('.rfield').addClass('empty_field');

	// Функция проверки полей формы

	// Проверка в режиме реального времени
	setInterval(function () {
	    // Запускаем функцию проверки полей на заполненность
	    checkInput();
	    // Считаем к-во незаполненных полей
	    var sizeEmpty = form.find('.empty_field').size();
	    // Вешаем условие-тригер на кнопку отправки формы
	    if (sizeEmpty > 0) {
		if (btn.hasClass('disabled-f')) {
		    return false
		} else {
		    btn.addClass('disabled-f')
		}
	    } else {
		btn.removeClass('disabled-f')
	    }
	}, 500);
    });

    function checkInput() {
	form = $("#addProdForm");
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
	form = $("#addProdForm");
	form.find('.empty_field').css({'border-color': '#d8512d'});
	// Через полсекунды удаляем подсветку
	/*setTimeout(function () {
	    form.find('.empty_field').removeAttr('style');
	}, 500); */
    }
</script>