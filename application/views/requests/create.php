<h2></h2>

<?php
	echo validation_errors();
	$attributes = array('enctype' => 'multipart/form-data');
	echo form_open('requests/create', $attributes);
?>

<input type="input" name="title" value="<?php echo set_value('title'); ?>" placeholder="Название заявки" /><br />

<input type="input" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Номер телефона" /><br />

<textarea name="description" value="<?php echo set_value('description'); ?>" placeholder="Опишите вашу проблему"></textarea><br />

<input type="file" name="pic" value="<?php echo set_value('pic'); ?>" required>

<input type="submit" name="submit" value="Create news item" />

</form>