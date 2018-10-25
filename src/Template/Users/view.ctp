<section class="content-header">
  <h1>
    <?php echo __('User'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Role') ?></dt>
                                <dd>
                                    <?= $user->has('role') ? $user->role->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('First Name') ?></dt>
                                        <dd>
                                            <?= h($user->first_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Last Name') ?></dt>
                                        <dd>
                                            <?= h($user->last_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($user->email) ?>
                                        </dd>
                                                                                                                                                                                                                                            <dt><?= __('Auth Key') ?></dt>
                                        <dd>
                                            <?= h($user->auth_key) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($user->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($user->status) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Logs']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->logs)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Owner
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                    
                                    <th>
                                    Tbl
                                    </th>
                                        
                                                                    
                                    <th>
                                    Content
                                    </th>
                                        
                                                                    
                                    <th>
                                    Log File
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ipv4
                                    </th>
                                        
                                                                    
                                    <th>
                                    Is Success
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->logs as $logs): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($logs->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->owner) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($logs->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->tbl) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->content) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->log_file) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->ipv4) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($logs->is_success) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Logs', 'action' => 'view', $logs->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Logs', 'action' => 'edit', $logs->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logs', 'action' => 'delete', $logs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logs->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
