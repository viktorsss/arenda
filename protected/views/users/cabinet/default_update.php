<div class="profile">
    <div class="leftcol">
        <div class='profImg'><img src="<?php echo $model->photo; ?>" alt="" /></div>
	<a href="#" class="button file-input">Загрузить фото</a>
	<div class="delete-file">
            <a href="#" class="profile-link">Удалить фото</a>
	</div>
    </div>
    <form id="profileForm" action="" method="POST">
        <fieldset>
            <div class="centercol">
                <div class="radio-wrap">
                    <label class="radio <?php echo ($model->subj == 2) ? 'checked' : ''; ?>"><input type="radio" name="client" value='2' />Юр. лицо</label>
                    <label class="radio <?php echo ($model->subj == 1) ? 'checked' : ''; ?>"><input type="radio" name="client" <?php echo ($model->subj == 1) ? 'checked' : ''; ?> value='1' />Физ. лицо</label>
                </div>
                <p><label><input type="text" name='profile[name]' value="<?php echo $model->name; ?>" placeholder="Имя"/></label></p>
                <p><label><input type="text" name='profile[so_name]' value="<?php echo $model->so_name; ?>" placeholder="Фамилия"/></label></p>
                <p>
                    <label><span class="label">Девиз/Слоган</span>
                        <textarea id='slogan' maxlength='90' class="small" name='profile[slogan]' cols="30" rows="10" placeholder="Опишите вашу деятельность"><?php echo $model->slogan; ?></textarea>
                    </label>
                    <span id='sloganOut' class="symbols">90 осталось</span>
                </p>
		<?php if($model->tarif > 1) { ?>
		<p>
		    <label><span class="label">Рекламный текст</span>
			<textarea name="profile[promotext]" maxlength='90' id="promotext" cols="30" rows="10" class="advert-text"><?php echo $model->promotext; ?></textarea>
		    </label>
		    <span class="symbols" id="promotext_symb">90 символов</span>
		</p>
		<?php } ?>
            </div>
            <div class="rightcol">
                <span class="label">Город</span>
                <label><input id='city' type='text' name='profile[city]' value="<?php echo $this->city_name; ?>" /></label>
                <p></p>
                <span class="label">Телефон</span>
                <div class='phoneList'>
                    <p class="phone">
                        <label><input type="text" name='profile[phoneMain]' value="<?php echo $model->phone; ?>" class="mask-input"/></label>
                    </p>
		    <?php foreach($phones as $item) { ?>
                    <p class="phone">
                        <label><input type="text" name='profile[phone][]' value="<?php echo $item->value; ?>" class="mask-input"/></label>
			<a class="delete"><i class="icon-30"></i></a>
                    </p>
		    <?php } ?>
                </div>
                <a href="#" id='addPhone' class="profile-link">Добавить телефон</a>

                <span class="label">Контакты</span>
                <div class='contactList'>
		    <?php foreach($contacts as $item) { //var_dump($item->name); ?>
                    <div class="more-contacts">
                        <div class="select-wrap">
                            <input type="hidden" name="profile[contactType][]" value="<?php echo $item->name; ?>" /> 
                            <div class="select">
                                <span class="title"><?php echo $item->name; ?></span>
                                <a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
                            </div>
                            <ul class="option-list">
                                <li data-value="ICQ">ICQ</li>
                                <li data-value="Skype">Skype</li>
                                <li data-value="E-mail">E-mail</li>
                            </ul>
                        </div>
                        <label><input type="text" name='profile[contactVal][]' value="<?php echo $item->value; ?>"/></label>
                        <div class="clear"></div>
                        <a href="#" class="delete"><i class="icon-30"></i></a>
                    </div>
		    <?php } ?>
                </div>
                <a href="#" id='addCont' class="profile-link">Добавить контакт</a>
            </div>
            <div class="clear"></div>
            <a href="#" id='saveProfile' class="button">Сохранить</a>
            <!-- a href="#" class="preview-link">Предварительный просмотр <i class="icon-43"></i></a -->
        </fieldset>
    </form>
</div><!-- end profile -->
<script type="text/javascript">
    $(document).ready(function() {
	$(".delete-file a").click(function() {
	    $.post('/users/deleteuserphoto');
	    $(".profImg img").remove();
	});
	
        stringcut("#slogan", "#sloganOut");
	stringcut("#promotext", "#promotext_symb");
       
        $(".leftcol").each(function() {
            ajaxFileUploadInit(this, ".profImg");
        });
	
	$("#saveProfile").click(function() {
	    $.ajax({
                type: 'POST',
                url: '<?php echo $this->createUrl('users/profileedit'); ?>',
                data: $('#profileForm').serialize(),
                    success: function(data) {
			text = $('#saveProfile').text();
			out = JSON.parse(data);
			if(out.code == 1) {
			    $('#saveProfile').html(out.data).css({'background-color':'green', 'color':'#fff'});
			    setTimeout(function(){
				$('#saveProfile').text(text).css({'background':'#e2e2e2', 'color':'#000'});
			    }, 5000);
			} else {
			    alert(out.data);
			}
                    }
            });
	});
    });
</script>