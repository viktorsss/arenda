<?php
$this->breadcrumbs = array(
    'Администрирование' => array('site/admin'),
    'Поля'
);

$catid = $_GET['catid'];
?>
<style type="text/css">
    #fields input {font: normal normal 14px Arial, Helvetica, sans-serif; height: auto; width: auto;}
    #fields th, #fields td {}
</style>
<h1>Поля - <?php echo Func::model()->findByPk($catid)->name; ?></h1>
<?php if($catid == NULL) { ?>
<h2>Выберите категорию</h2>
<?php } else { ?>
<form method="POST" action="/admin/fields?catid=<?php echo $_GET['catid']; ?>">
<div id="fields">
	<?php 
	if(count($model) > 0) {
	    $i = 0;
	    foreach ($model as $key => $item) {
	    $i++;
	 ?>
	<table id="fields-<?php echo $item->id; ?>">
	    <?php if($key == 0) { ?>
	    <tr>
		<th>R</th>
		<th>Название</th>
		<th>Тип</th>
		<th>Название колонки <br/> checkbox only</th>
		<th>По умолчанию</th>
		<th>Показ</th>
		<th>Порядок</th>
		<th></th>
	    </tr>
	    <?php } ?>
	    <tr class="row">
		<td><input type="checkbox" name="field[required][<?php echo $key; ?>]" value="1" <?php echo ($item->required) ? "checked" : ""; ?> /></td>
		<td><input type="text" name="field[name][]" value="<?php echo $item->name; ?>" /></td>
		<td>
		    <select name="field[type][]">
			<option <?php echo ($item->type == "input") ? "selected" : ""; ?> value="input">Input</option>
			<option <?php echo ($item->type == "checkbox") ? "selected" : ""; ?> value="checkbox">Checkbox</option>
			<option <?php echo ($item->type == "select") ? "selected" : ""; ?> value="select">Select</option>
			<option <?php echo ($item->type == "textarea") ? "selected" : ""; ?> value="textarea">TextArea</option>
		    </select>
		</td>
		<td><input type='text' name='field[name_column][]' value="<?php echo $item->name_column; ?>" /></td>
		<td><textarea name="field[default][]" rows="5" cols="30"><?php echo $item->default; ?></textarea></td>
		<td>
		    <select name="field[trans][]">
			<option <?php echo ($item->trans == 0) ? "selected" : ""; ?> value="0">Везде</option>
			<option <?php echo ($item->trans == 1) ? "selected" : ""; ?> value="1">Аренда</option>
			<option <?php echo ($item->trans == 2) ? "selected" : ""; ?> value="2">Продажа</option>
		    </select>
		</td>
		<td>
		    <select name="field[order][]">
			<?php for($j = 0; $j < FuncFields::model()->countByAttributes(array('func_id' => $catid, 'block_id' => $item->block_id)); $j++) { ?>
			<option <?php echo ($item->orders == $j) ? "selected" : ""; ?> value="<?php echo $j ?>"><?php echo $j; ?></option>
			<?php } ?>
		    </select>
		    <input type="hidden" name='field[id][]' value='<?php echo $item->id; ?>' />
		</td>
		<td><button type="button" class="delField" id="delField-<?php echo $item->id; ?>">X</button></td>
	    </tr>
	</table>
	<?php 
	    }
	} else { ?>
	<table id="fields-1">
	    <tr>
		<th>R</th>
		<th>Название</th>
		<th>Тип</th>
		<th>Название колонки <br/> checkbox only</th>
		<th>По умолчанию</th>
		<th>Показ</th>
		<th>Порядок</th>
		<th></th>
	    </tr>
	    <td><input type="checkbox" name="field[required]" value="1" /></td>
	    <tr class="row">
		<td><input type="text" name="field[name][]" value="" /></td>
		<td>
		    <select name="field[type][]">
			<option value="input">Input</option>
			<option value="checkbox">Checkbox</option>
			<option value="select">Select</option>
			<option value="textarea">TextArea</option>
		    </select>
		</td>
		<td><input type='text' name='field[name_column][]' value="" /></td>
		<td><textarea name="field[default][]" rows="5" cols="30"></textarea></td>
		<td>
		    <select name="field[trans][]">
			<option value="0">Везде</option>
			<option value="1">Аренда</option>
			<option value="2">Продажа</option>
		    </select>
		</td>
		<td><input type="text" name="field[order][]" value="" /></td>
		<td><button type="button" class="delField" id="delField-1">X</button></td>
	    </tr>
	</table>
	<?php }
	?>
</div>
    <button id="addRow" style="padding: 0 5px;">+</button>
    <input type="submit" name="field[submit][save]" value="Сохранить" />
    
    <!-- input type="submit" name="field[submit][update]" value="Обновить" / -->
</form>

<script type="text/javascript">
    $(document).ready(function() {
	count = 100;
	$("#addRow").click(function(e) {
	    //html = $('#catFields').html;
	    //alert('aloha');
	    count++;
	    $('#fields').append('<table id="fields-'+count+'"><tbody><tr class="row"><td><input type="checkbox" name="field[required]" value="1" /></td><td><input type="text" name="field[name][]" value="" /></td><td><select name="field[type][]"><option value="input">Input</option><option value="checkbox">Checkbox</option><option value="select">Select</option><option value="textarea">TextArea</option></select></td><td><input type="text" name="field[name_column][]" value="" /></td><td><textarea name="field[default][]" rows="5" cols="30"></textarea></td><td><select name="field[trans][]"><option value="0">Везде</option><option value="1">Аренда</option><option value="2">Продажа</option></select></td><td><input type="text" name="field[order][]" value="" /></td><td><button type="button" id="delField-'+count+'" class="delField">X</button></td></tr></tbody></table>');
	    return false;
	});
    });
	$("body").on("click",".delField", function(e){
	//alert('hello');
	    data = $(this).attr('id').split('-');
	    $.post("/admin/delfield?id="+data[1]);
	    $("#fields-"+data[1]).remove();
	});
</script>
<?php } ?>