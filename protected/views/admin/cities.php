<style type="text/css">
    #cities {}
    #cities .elCity {float: left; width: 180px;}
    #cities .elCity .title {float: left; margin-right: 10px;}
    #cities .elCity a {font-size: 20px; color:red; font-weight: bold; text-decoration: none;}
</style>
<div id="cities">
    <div class="addCity">
	<input type="text" name="" value="" id="nameCity" />
	<button type="button" id="addCity">Добавить</button>
    </div>
    <?php foreach ($model as $item) { ?>
        <div class="elCity">
	    <div class="title"><?php echo $item->name; ?></div>
	    <a class="delCity" data="<?php echo $item->name; ?>" href="#">X</a>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(function () {
	$(document).on('click', 'a.delCity', function () {
	    $(this).parent().remove();
	    $.post('/admin/delcity?name=' + $(this).attr('data'));
	});

	$("#addCity").on('click', function () {
	    name = $('#nameCity').val();
	    $.ajax({
		url: "/admin/addcity",
		type: "POST",
		data: {'nameCity': name},
		success: function (data) {
		    if(data == 1) {
			$("#cities").append('<div class="elCity"><div class="title">'+ name +'</div><a class="delCity" data="' + name + '" href="#">X</a></div>');
		    }
		},
	    });
	});
    });
</script>