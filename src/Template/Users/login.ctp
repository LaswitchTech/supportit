<?php use Cake\Core\Configure; ?>
<div class="login-box" style="padding-top:50px;margin-top:0px;">
  <div class="login-logo">
    <a href="<?php echo $this->Url->build(array('controller' => 'pages', 'action' => 'display', 'home')); ?>"><?php echo Configure::read('Theme.logo.large'); ?></a>
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?= $this->Form->create(); ?>
      <div class="form-group has-feedback">
        <?= $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
      </div>
      <div class="form-group has-feedback">
          <?= $this->Form->submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
      </div>
    <?= $this->Form->end(); ?>

    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->