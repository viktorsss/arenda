<section class="popup enter-popup" style="display: block;">
    <div class="container">
        <div class="box-modal_close arcticmodal-close close"><i class="icon-6"></i></div>
        <div class="popup-block enter-block" style="display:block">
            <p class="title"><span>Вход / </span><a href="#" class="register-link">Регистрация</a></p>
            <form action="" method="POST" id="login-form" class="with-border">
                <p><label><span>Логин</span><input class="rfield" type="text" name="User[username]" placeholder="your@mail.ru" value="" /></label></p>
                <p><label><span>Пароль</span><input class="rfield" type="password" name="User[password]" placeholder="Пароль" value="" /></label></p>	
                <a href="#" class="forgot-pass">Напомнить пароль</a>
                <p><input id="login-form-submit" type="button" value="Вход"/></p>
                <div class="checkbox-wrap"><label class="checkbox grey"><input name="User[rememberMe]" value="1" type="checkbox" />Оставаться в системе</label></div>
            </form>
            <div class="enter-social">
                <span class="title">Войти<br/>с помощью:</span>
                <ul>
                    <li><a href="#" class="vk"><i class="icon-17"></i>В контакте</a></li>
                    <li><a href="#" class="fb"><i class="icon-18"></i>Facebook</a></li>
                    <li><a href="#" class="tw"><i class="icon-19"></i>Twitter</a></li>
                </ul>
            </div>
        </div><!-- end enter-block -->
    </div>
</section>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#login-form").submit(function() { return false; });
        });
    	$(function() {
            $('#login-form').each(function(){
            // Объявляем переменные (форма и кнопка отправки)
            var form = $(this), btn = form.find('#login-form-submit');

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
                    // Все хорошо, все заполнено, отправляем форму
                    //form.submit();
                    //btn.replaceWith("<em>отправка...</em>");
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $this->createUrl('site/login'); ?>',
                        data: form.serialize(),
                        success: function(data) {
                            out = JSON.parse(data);
                            if(out.code == 1) {
				url = "<?php echo $this->createUrl('site/enteruserview'); ?>";
				$.post( url, function(mydata) {
				    $('.enter-block').html(mydata);
				});
                                setTimeout(function(){
                                    //$.arcticmodal('close');
                                }, 5000);
                            } else {
                                alert(out.data);
                            }
                        }
                    });
                }
              });
            });
        });
    </script>