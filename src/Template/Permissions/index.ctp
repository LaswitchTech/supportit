<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Permissions
    <small>Listing</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-gear"></i> Settings</li>
    <li class="active">Permissions</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Permissions</h3>
          <div class="pull-right">
            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-lock','style' => 'padding-right:5px')).'New', array('controller' => 'Permissions', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?>
            <?php endif; ?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="Listing-Permissions">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th style="width: 100px;">Level</th>
                    <th>Role</th>
                    <th>Owner</th>
                    <th style="width: 100px;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($permissions as $permission): ?>
                      <tr>
                          <td><?= h($permission->name) ?></td>
                          <td>
                              <?php 
                              switch ($this->Number->format($permission->level)) {
                                  case 0:
                                      echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-ban' style='padding-right:5px'></i>None</a>";
                                      break;
                                  case 1:
                                      echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-eye' style='padding-right:5px'></i>Read</a>";
                                      break;
                                  case 2:
                                      echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-plus' style='padding-right:5px'></i>Create</a>";
                                      break;
                                  case 3:
                                      echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-edit' style='padding-right:5px'></i>Edit</a>";
                                      break;
                                  case 4:
                                      echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-trash' style='padding-right:5px'></i>Delete</a>";
                                      break;
                              } ?>
                          </td>
                          <td><?= $this->Format->getName($permission->role_id, 'roles') ? $this->Html->link($this->Format->getName($permission->role_id, 'roles'), ['controller' => 'Roles', 'action' => 'view', $permission->role_id]) : '' ?></td>
                          <td><?= $this->Html->link($this->Format->getFullname($permission->owner), ['controller' => 'Users', 'action' => 'view', $permission->owner, '_full' => true]) ?></td>
                          <td>
                              <div class="btn-group">
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Permissions', 'action' => 'view', $permission->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '3')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Permissions', 'action' => 'edit', $permission->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '4')) : ?>
                                      <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Permissions', 'action' => 'delete', $permission->id), array('confirm' => __('Are you sure you want to delete the permission "'.$permission->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                  <?php endif; ?>
                              </div>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);
$this->Html->script([
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    $('#Listing-Permissions').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "scrollX": true,
      "processing": true,
    });
  });
</script>
<?php $this->end(); ?>
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
