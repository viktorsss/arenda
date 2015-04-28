<section class="popup enter-popup" style="display:none">
    <div class="container">

    
    
    <div class="popup-block registration-block" style="display:none">
	<p class="title"><a href="#" class="enter-link">Вход</a><span>  /  Регистрация</span></p>
        <form action="" method="POST" id="form-registration">
            <p><label><span>Имя<i>*</i>:</span><input type="text" name="User[name]" placeholder="Ваше имя"/></label></p>
            <p><label><span>Телефон<i>*</i>:</span><input type="text" name="User[phone]" class="phone-input" placeholder="+7 (___) ___ ____"/></label></p>	
            <p><label><span>E-mail<i>*</i>:</span><input type="text" name="User[email]" placeholder="your@mail.ru"/></label></p>
            <p><label><span>Придумайте<br/>пароль<i>*</i>:</span><input type="password" name="User[pass]" placeholder="Пароль"/></label></p>	
            <p><label><span>Повторите<br/> пароль<i>*</i>:</span><input type="password" placeholder="Пароль"/></label></p>	
            <p class="activation">
                <span class="label">Акцивация <br/>аккаунта<i>*</i>:</span>
                <label class="radio"><input type="radio" checked name="User[activation]" value="sms" />SMS</label>
		<label class="radio"><input type="radio" name="User[activation]" value="email" />E-mail</label>
            </p>	
            <p><input type="submit" value="Зарегистрироваться"/></p>
            <div class="checkbox-wrap"><label class="checkbox grey"><input type="checkbox" />Согласен с правилами сайта</label></div>
	</form>
    </div><!-- end registration-block -->
    
    
    
    <div class="popup-block registration-ok-block" style="display:none">
	<p class="title"><a href="#">Вход</a><span>  /  Регистрация</span></p>
	<p class="text"><b>Спасибо! Регистрация завершена.</b>Вам отправлено sms с кодом подтверждения, введите его в поле ниже и нажмите “завершить”.</p>
        <form action="#">
            <p><label><input type="text" placeholder="123456"/></label></p>
            <p><input type="submit" value="Завершить регистрацию"/></p>
        </form>
	<a href="#" class="terms-link">Соглашение об обработке персональных данных</a>
			</div><!-- end registration-ok-block -->
			<div class="popup-block enter-person-block" style="display:none">
				<p class="title">Вы вошли как</p>
				<div class="card">
					<img src="/images/avatar-2.jpg" alt="" />
					<div class="details">
						<p class="account-name">
							<span class="first-name">Пантелеймон<span class="icon-pro">PRO</span></span>
							<span class="last-name">Хакимжанов</span>
						</p>
						<p class="account"><a href="#">Личный кабинет</a></p>
					</div>
					<div class="clear"></div>
				</div>
				<form action="#">
					<p class="no-data">Нет контактных данных!</p>
					<p><label><span>Имя<i>*</i>:</span><input type="text" placeholder="Ваше имя"/></label></p>
					<p><label><span>Телефон<i>*</i>:</span><input type="text" class="phone-input" placeholder="+7 (___) ___ ____"/></label></p>	
					<p><label><span>E-mail<i>*</i>:</span><input type="text" placeholder="your@mail.ru"/></label></p>
					<p><input type="submit" value="Сохранить данные"/></p>
					<a href="#" class="button remind-link">Напомнить позже</a>
				</form>
			</div><!-- end enter-person-block -->
			<div class="popup-block universal" style="display:none">
				<p class="title">Вы вошли как</p>
				<p class="text">
					<b>Иван Иванович</b>
					<span>+7 (912) 615-0207</span>
					<span>mail@mail.ru</span>
				</p>
				<a href="#" class="button first">Изменить данные</a>
				<a href="#" class="button">ОК</a>	
				<div class="clear"></div>
			</div><!-- end enter-person-small-block -->
			<div class="popup-block universal" style="display:none">
				<p class="title">Выстрел в ногу</p>
				<p class="text">Вы уверены, что хотите прострелить себе ногу?</p>
				<p class="big-margin"><a href="#" class="popup-link">Куда еще можно выстрелить?</a></p>
				<a href="#" class="button first">Да</a>
				<a href="#" class="button">Нет</a>	
				<div class="clear"></div>
			</div><!-- end enter-person-small-block -->
			<div class="popup-block universal" style="display:none">
				<p class="title">Нога прострелена</p>
				<p class="text">Нога прострелена! Вам вызвана <a href="#">скорая помощь</a>.<br/>Так же вы можете воспользоваться <a href="#">аптечкой</a></p>
				<p class="big-margin">
					<a href="#" class="popup-link">Куда еще можно выстрелить?</a>
					<a href="#" class="popup-link">Прострелить вторую ногу?</a>
				</p>
				<a href="#" class="button center">OK</a>
				<div class="clear"></div>
			</div><!-- end enter-person-small-block -->
		</div> <!-- end container -->
	</section><!-- end popup -->