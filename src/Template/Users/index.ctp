<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '1')) : ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Listing</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-gear"></i> Settings</li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Users</h3>
              <div class="pull-right">
                <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '1')) : ?>
                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-user-plus','style' => 'padding-right:5px')).'New', array('controller' => 'Users', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?>
                <?php endif; ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="users-listing" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 200px;">Name</th>
                  <th style="width: 100px;">Status</th>
                  <th style="width: 200px;">Role</th>
                  <th>Email</th>
                  <th style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= h($user->first_name) ?> <?= h($user->last_name) ?></td>
                    <td>
                        <?php 
                        switch ($this->Number->format($user->status)) {
                            case 0:
                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-check' style='padding-right:5px'></i> Active</a>";
                                break;
                            case 1:
                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-hourglass-half' style='padding-right:5px'></i> Pending</a>";
                                break;
                            case 2:
                                echo "<a class='btn btn-primary btn-sm btn-block btn-flat'><i class='fa fa-user-times' style='padding-right:5px'></i> Locked</a>";
                                break;
                            case 3:
                                echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-lock' style='padding-right:5px'></i> Suspended</a>";
                                break;
                            case 4:
                                echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i> Blocked</a>";
                                break;
                        } ?>
                    </td>
                    <td><?= $this->Format->getName($user->role_id, 'roles') ?></td>
                    <td><?= h($user->email) ?></td>
                    <td class="actions" style="white-space:nowrap">
                      <div class="btn-group">
                        <?php if(($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '1')) or ($user->id == $this->request->getSession()->read('Auth.User.id'))) : ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Users', 'action' => 'view', $user->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                        <?php endif; ?>
                        <?php if(($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '3')) or ($user->id == $this->request->getSession()->read('Auth.User.id'))) : ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Users', 'action' => 'edit', $user->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                        <?php endif; ?>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '4')) : ?>
                        <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Users', 'action' => 'delete', $user->id), array('confirm' => __('Are you sure you want to delete the user "'.$user->first_name.' '.$user->last_name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
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
    $('#users-listing').DataTable({
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
<?php else : ?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-header">Permission Denied</h1>
    </div>
  </div>
</section>
<?php endif; ?>
