<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Roles
    <small>Listing</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-gear"></i> Settings</li>
    <li class="active">Roles</li>
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
            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-lock','style' => 'padding-right:5px')).'New', array('controller' => 'Roles', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?>
            <?php endif; ?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="Listing-Roles">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Owner</th>
                      <th style="width: 100px;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($roles as $role): ?>
                      <tr>
                          <td><?= h($role->name) ?></td>
                          <td><?= $this->Html->link($this->Format->getFullname($role->owner), ['controller' => 'Users', 'action' => 'view', $role->owner, '_full' => true]) ?></td>
                          <td>
                              <div class="btn-group">
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Roles', 'action' => 'view', $role->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '3')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Roles', 'action' => 'edit', $role->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '4')) : ?>
                                      <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Roles', 'action' => 'delete', $role->id), array('confirm' => __('Are you sure you want to delete the role "'.$role->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
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
    $('#Listing-Roles').DataTable({
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
