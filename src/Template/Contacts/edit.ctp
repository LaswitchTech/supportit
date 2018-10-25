<section class="content-header">
  <h1>
    Contact
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
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
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($contact, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('owner');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('phone1');
            echo $this->Form->input('ext1');
            echo $this->Form->input('phone2');
            echo $this->Form->input('ext2');
            echo $this->Form->input('phone3');
            echo $this->Form->input('ext3');
            echo $this->Form->input('is_allowed_calls');
            echo $this->Form->input('email');
            echo $this->Form->input('title');
            echo $this->Form->input('department');
            echo $this->Form->input('description');
            echo $this->Form->input('account_id', ['options' => $accounts]);
            echo $this->Form->input('user_id', ['options' => $users]);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>

