<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '2')) : ?>
<section class="content-header">
  <h1>
    User
    <small><?= __('Add') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-gear"></i> Settings</li>
    <li><?= $this->Html->link(__('Users'), ['action' => 'index'], ['escape' => false]) ?></li>
    <li class="active">Add</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($user, array('role' => 'form')) ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <?= $this->Form->input('first_name'); ?>
                <?= $this->Form->input('last_name'); ?>
                <?= $this->Form->input('password'); ?>
                <?= $this->Form->control('password_confirm', ['type' => 'password']); ?>
              </div>
              <div class="col-md-6">
                <?= $this->Form->input('email'); ?>
                <?= $this->Form->input('status', array('options' => array('0' => 'Active', '1' => 'Pending', '2' => 'Locked', '3' => 'Suspended', '4' => 'Blocked'))); ?>
                <?= $this->Form->input('role_id'); ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->submit('Save', array('class' => 'btn btn-success btn-block')); ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<?php else : ?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">Permission Denied</h1>
    </div>
  </div>
</section>
<?php endif; ?>
