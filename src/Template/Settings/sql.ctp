<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setSettings', '1')) : ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Database
    <small>Settings</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> App</li>
    <li>Settings</li>
    <li class="active">SQL</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">SQL Server</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?= $this->Form->create(null, [
            'url' => ['controller' => 'Settings', 'action' => 'sql']
            ])
          ?>
            <?= $this->Form->control('Username', ['value' => $DB_CONNECT['Username']]); ?>
            <?= $this->Form->control('Password', ['type' => 'password', 'value' => $DB_CONNECT['Password']]); ?>
            <?= $this->Form->control('Database', ['value' => $DB_CONNECT['Database']]); ?>
            <?= $this->Form->control('Host', ['value' => $DB_CONNECT['Host']]); ?>
            <?=
                $this->Form->button('<i class="fa fa-save" style="padding-right: 5px;"></i> Save',[
                    'escape' => false,
                    'type' => 'submit',
                    'class' => 'btn btn-success btn-block',
                    'style' => 'padding: 25px; font-size: 18px;',
                    'templates' => [
                        'submitContainer' => '{{content}}',
                    ],

                ]);
            ?>
          <?= $this->Form->end() ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
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
