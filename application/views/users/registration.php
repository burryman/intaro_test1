<div class="container">
    <h2>Регистрация</h2>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Имя" required="" value="<?php echo !empty($user['name'])?$user['name']:''; ?>">
          <?php echo form_error('name','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="surname" placeholder="Фамилия" required="" value="<?php echo !empty($user['surname'])?$user['surname']:''; ?>">
          <?php echo form_error('surname','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="" value="<?php echo !empty($user['email'])?$user['email']:''; ?>">
          <?php echo form_error('email','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Пароль" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="conf_password" placeholder="Повторите пароль" required="">
          <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="regisSubmit" class="btn-primary" value="Зарегестрироваться"/>
        </div>
    </form>
    <p class="footInfo">Уже есть аккаунт? <a href="<?php $this->load->helper('url'); echo base_url('users/login'); ?>">Войдите</a></p>
</div>
