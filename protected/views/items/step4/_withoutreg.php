<div class="content-white">
    <p class="entered-as">Введите ваши данные</p>
	<p class="no-data">Нет контактных данных!</p>
	<p><label class="error form-error"><span>Имя<i>*</i>:</span><input type="text" id="userName" name="User[name]" class="empty" placeholder="Ваше имя"/><!-- span class="error">Произошла какая-то неведомая херня!</span --></label></p>
	<p><label class="error form-error"><span>Телефон<i>*</i>:</span><input type="text" id="userPhone" name="User[phone]" class="phone-input empty" placeholder="+7 (___) ___ ____"/></label></p>	
	<p><label class="error form-error"><span>E-mail<i>*</i>:</span><input type="text" id="userEmail" name="User[e_mail]" class="empty" placeholder="your@mail.ru"/></label></p>
	<!-- p><input type="submit" value="Сохранить данные"/></p -->
</div><!-- end content-white -->
<div class="right-part">
    <div class="rightcol-990">
	<p class="send-to-moderation" style="display: none;"><span>Объявление </span><span>отправлено на модерацию.</span></p>
	<p class="center">На ваш почтовый будет выслано письмо содержащие ссылки для управления объектом.</p>
    </div>
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
	<a class="add-button disabled" id="addProdButt">Разместить объявление</a>
	<p><label class="checkbox grey"><input type="checkbox" id="police" /><b>Согласен с </b><a href="#">правилами сайта</a></label></p>
    </div>
    <div class="rightcol-990">
	<p>Перед размещением объявления наш администратор, быстро проверит детали и исправит мелкие ошибки. После публикации объявления вы получите уведомление.</p>
    </div>
    <div class="clear"></div>
</div><!-- end right-part -->
<script type="text/javascript">
    $(document).ready(function() {
	$(".form-error input").keypress(function() {
	    if($(this).val() != "") {
		$(this).removeClass('empty').parent().removeClass("error").removeClass("form-error");
		if(($("#userName").val() != "") && ($("#userPhone").val() != "") && ($("#userEmail").val() != '')) {
		    $("#addProdButt").removeClass('disabled').addClass('active');
		    $(".no-data").hide('slow');
		}
	    }
	});
	
	$("#police").on('click', function() {
		$("#addProdButt").removeClass('disabled');
	    });
    
	$('#addProdButt').on('click', function() {
	    if($('#police').is(':checked')) {
		if($(this).hasClass('active')) {
		    place = $("#placing").val();
		    $.ajax({
			type: 'POST',
			url: '/items/saveaddnew?place='+place,
			data: $("#addProdForm").serialize(),
			success: function(data) {
			    console.log(data);
			    out = JSON.parse(data);
			    if(out.code == 1) {
				$("#addProdForm").find("input[type=text], textarea").val("");
				$(".send-to-moderation").show('slow');
				$("#addProdButt").addClass('disabled');
				$('input[type=checkbox]').attr('checked', false).parent().removeClass('checked');
				$('input[type=radio]').attr('checked', false).parent().removeClass('checked');
				$('.hidden-block').hide();
				$(".request-pictures-main").remove();
				$("#otherImgTitle").remove();
				$(".file-list-item.img-wrap").remove();
				timer = setTimeout(function() {
				    $("html, body").animate({scrollTop:0},"slow");
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
		}
	    }
	});
    });
</script>