<section class="content-header">
  <h1>
    Call
    <small><?= __('Add') ?></small>
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
        <?= $this->Form->create($call, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('owner');
            echo $this->Form->input('subject');
            echo $this->Form->input('content');
            echo $this->Form->input('status');
            echo $this->Form->input('start');
            echo $this->Form->input('end');
            echo $this->Form->input('link_id');
            echo $this->Form->input('link_type');
            echo $this->Form->input('duration');
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

