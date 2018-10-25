<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setSettings', '1')) : ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Settings
    <small>Site settings</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> App</li>
    <li class="active">Settings</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number"><?= $users->count ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
	  </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-hdd"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Last Backup</span>
          <span class="info-box-number">11-09-2018 14:02:01</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
	  </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-saved"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Last Updated</span>
          <span class="info-box-number">11-09-2018 14:02:01</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
	  </div>
  </div>
  <div class="row">
    <div class="col-md-12">
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
