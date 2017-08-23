<h2></h2>

<?php echo validation_errors(); ?>

<?php
	$attributes = array('enctype' => 'multipart/form-data');
 	echo form_open('requests/create', $attributes)?>

    
    <input type="input" name="title" placeholder="Название заявки" /><br />

    <input type="input" name="phone" placeholder="Номер телефона" /><br />

    <textarea name="description" placeholder="Опишите вашу проблему"></textarea><br />

    <input type="file" name="pic" required>

    <input type="submit" name="submit" value="Create news item" />

</form>