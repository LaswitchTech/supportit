<?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Logs
    <small>Listing</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-gear"></i> Settings</li>
    <li class="active">Logs</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Logs</h3>
          <div class="pull-right">
            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text','style' => 'padding-right:5px')).'New', array('controller' => 'Logs', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?>
            <?php endif; ?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="Listing-Logs">
              <thead>
                  <tr>
                      <th style="width: 200px;">User</th>
                      <th style="width: 100px;">Type</th>
                      <th style="width: 100px;">Table</th>
                      <th>Content</th>
                      <th style="width: 100px;">Status</th>
                      <th style="width: 100px;">Date</th>
                      <th style="width: 100px;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($logs as $log): ?>
                      <tr>
                          <td><?= $this->Html->link($this->Format->getFullname($log->user_id), ['controller' => 'Users', 'action' => 'view', $log->user_id, '_full' => true]) ?></td>
                          <td>
                              <?php 
                              switch ($this->Number->format($log->type)) {
                                  case 0:
                                      echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-plus' style='padding-right:5px'></i>INSERT</a>";
                                      break;
                                  case 1:
                                      echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-edit' style='padding-right:5px'></i>UPDATE</a>";
                                      break;
                                  case 2:
                                      echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i>DELETE</a>";
                                      break;
                              } ?>
                          </td>
                          <td><?= h($log->tbl) ?></td>
                          <td><?= h($log->content) ?></td>
                          <td>
                              <?php 
                              switch ($this->Number->format($log->is_success)) {
                                  case 0:
                                      echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i>Error</a>";
                                      break;
                                  case 1:
                                      echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-check' style='padding-right:5px'></i>Success</a>";
                                      break;
                              } ?>
                          </td>
                          <td><?= h($log->created) ?></td>
                          <td>
                              <div class="btn-group">
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Logs', 'action' => 'view', $log->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '3')) : ?>
                                      <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Logs', 'action' => 'edit', $log->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                  <?php endif; ?>
                                  <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '4')) : ?>
                                      <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Logs', 'action' => 'delete', $log->id), array('confirm' => __('Are you sure you want to delete the log entry "'.$log->id.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
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
    $('#Listing-Logs').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "order": [[ 5, "desc" ]],
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