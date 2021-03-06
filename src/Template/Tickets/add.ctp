<section class="content-header">
  <h1>
    Ticket
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
        <?= $this->Form->create($ticket, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('owner');
            echo $this->Form->input('account_id', ['options' => $accounts]);
            echo $this->Form->input('contact_id', ['options' => $contacts]);
            echo $this->Form->input('state');
            echo $this->Form->input('status');
            echo $this->Form->input('priority');
            echo $this->Form->input('type');
            echo $this->Form->input('subject');
            echo $this->Form->input('description');
            echo $this->Form->input('resolution');
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

