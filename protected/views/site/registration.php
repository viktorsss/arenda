<section class="popup enter-popup" style="display:block">
    <div class="container">    
        <div class="box-modal_close arcticmodal-close close"><i class="icon-6"></i></div>
        <div class="popup-block registration-block" style="display:block">
                <p class="title"><a href="#" class="enter-link">Вход</a><span>  /  Регистрация</span></p>
                <form action="" method="POST" id="form-registration">
                    <p><label><span>Имя<i>*</i>:</span><input type="text" name="User[name]" class="rfield" placeholder="Ваше имя"/></label></p>
                    <p><label><span>Телефон<i>*</i>:</span><input type="text" name="User[phone]" class="phone-input rfield" placeholder="+7 (___) ___ ____"/></label></p>	
                    <p><label><span>E-mail<i>*</i>:</span><input type="text" name="User[e_mail]" class="rfield email" placeholder="your@mail.ru"/></label></p>
                    <p><label><span>Придумайте<br/>пароль<i>*</i>:</span><input id="pass" type="password" name="User[password]" class="rfield" placeholder="Пароль"/></label></p>	
                    <p><label><span>Повторите<br/> пароль<i>*</i>:</span><input id="retpass" type="password" class="rfield" placeholder="Пароль"/></label></p>	
                    <p class="activation">
                        <span class="label">Акцивация <br/>аккаунта<i>*</i>:</span>
                        <label class="radio"><input id="r_sms" type="radio" name="activation" value="sms" />SMS</label>
                        <label class="radio checked"><input id="r_email" type="radio" checked name="activation" value="email" />E-mail</label>
                    </p>
                    <p><input type="submit" id="reg-form-submit" value="Зарегистрироваться"/></p>
                    <div class="checkbox-wrap"><label class="checkbox grey"><input id="police" type="checkbox" name="police" value="1" />Согласен с правилами сайта</label></div>
                </form>
            </div><!-- end registration-block -->
    </div>
</section>
    <script type="text/javascript">
        $(document).ready(function(){
            $('label input[type=radio]').each(function(){
		if ($(this).is(':checked')) $(this).closest('label').addClass('checked');
		$(this).change(function(){
			var nm = $(this).attr('name');
			$('label input[name='+nm+']').each(function(){
				if ($(this).is(':checked')){
					$(this).closest('label').addClass('checked');
				} else {
					$(this).closest('label').removeClass('checked');
				}
			});
		});
            });
            
            $("#form-registration").submit(function() { return false; });
            //validate("#form-registration", '#reg-form-submit');
        });
        
    	$(function() {
            $('#form-registration').each(function(){
            // Объявляем переменные (форма и кнопка отправки)
                var form = $(this), btn = form.find('#reg-form-submit');

                // Добавляем каждому проверяемому полю, указание что поле пустое
                form.find('.rfield').addClass('empty_field');

                // Функция проверки полей формы
                function checkInput(){
                    form.find('.rfield').each(function(){
                        if($(this).val() != ''){
                            // Если поле не пустое удаляем класс-указание
                            $(this).removeClass('empty_field');
                        } else {
                            // Если поле пустое добавляем класс-указание
                            $(this).addClass('empty_field');
                        }
                    });
                }

                // Функция подсветки незаполненных полей
                function lightEmpty(){
                    form.find('.empty_field').css({'border-color':'#d8512d'});
                    // Через полсекунды удаляем подсветку
                    setTimeout(function(){
                        form.find('.empty_field').removeAttr('style');
                    },500);
                }
                // Проверка в режиме реального времени
                setInterval(function(){
                // Запускаем функцию проверки полей на заполненность
                checkInput();
                    // Считаем к-во незаполненных полей
                    var sizeEmpty = form.find('.empty_field').size();
                    // Вешаем условие-тригер на кнопку отправки формы
                    if(sizeEmpty > 0){
                        if(btn.hasClass('disabled')){
                            return false
                        } else {
                            btn.addClass('disabled')
                        }
                    } else {
                        btn.removeClass('disabled')
                    }
                },500);

                // Событие клика по кнопке отправить
                btn.click(function(){
                    if($(this).hasClass('disabled')){
                        // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
                        lightEmpty();
                        return false
                    } else {
			    //url = "site/checkemail"+$('.email').val();
			    //$.post( url, function(data) {
				email = 0;
			    //});
			if(!email) {
			    $(".email").removeAttr('style');
			    if($('#police').is(":checked")) {
				if($('#pass').val() == $('#retpass').val()) {
				    $.ajax({
					type: 'POST',
					url: '<?php echo $this->createUrl('site/registration') ?>',
					data: form.serialize(),
					success: function(data) {
					    //alert(data);
					    $(".registration-block").html(data);
					    setTimeout(function(){
						$.arcticmodal('close');
					    }, 3000);
					}
				    });
				} else {
				    alert('Пароль и повтор пароля не совпадает');
				    $('#pass, #retpass').css({'border-color':'#d8512d'});
				    setTimeout(function(){
					$('#pass, #retpass').removeAttr('style');
				    },500);
				}
			    } else {
				alert('Вы не согласились с правилами сайта');
			    }
			} else {
			    $(".email").css({'border-color':'#d8512d'}).focus();
			}
                    }
                });
            });
        });
    </script>