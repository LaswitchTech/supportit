<section class="content-header">
  <h1>
    Alert
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
        <?= $this->Form->create($alert, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('owner');
            echo $this->Form->input('sender');
            echo $this->Form->input('receiver');
            echo $this->Form->input('subject');
            echo $this->Form->input('message');
            echo $this->Form->input('is_read');
            echo $this->Form->input('type');
            echo $this->Form->input('icon');
            echo $this->Form->input('controller');
            echo $this->Form->input('links_to');
            echo $this->Form->input('action');
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
