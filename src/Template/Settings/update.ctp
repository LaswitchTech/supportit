<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setSettings', '1')) : ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Updates
    <small>Site settings</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> App</li>
    <li class="active">Updates</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Script Output</h3>
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
          <pre><?= $output ?></pre>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Update Log <small>/var/log/SeeIT/update.log</small></h3>
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
          <pre><?php echo file_get_contents( "/var/log/SeeIT/update.log" ); ?></pre>
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
