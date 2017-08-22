<h2></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('requests/create') ?>

    
    <input type="input" name="title" placeholder="Название заявки" /><br />

    <input type="input" name="phone" placeholder="Номер телефона" /><br />

    <textarea name="description" placeholder="Опишите вашу проблему"></textarea><br />

    <input type="file" name="pic" tabindex="2" required>

    <input type="submit" name="submit" value="Create news item" />

</form>