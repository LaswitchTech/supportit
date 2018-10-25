<section class="content-header">
  <h1>
    <?php echo __('Account'); ?>
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
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($account->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                        <dd>
                                            <?= h($account->phone) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Website') ?></dt>
                                        <dd>
                                            <?= h($account->website) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Status') ?></dt>
                                        <dd>
                                            <?= h($account->status) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($account->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('User Id') ?></dt>
                                <dd>
                                    <?= $this->Number->format($account->user_id) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Description') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($account->description)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Users']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($account->users)): ?>

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
                                    Role Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                    
                                    <th>
                                    First Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Last Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Password
                                    </th>
                                        
                                                                    
                                    <th>
                                    Auth Key
                                    </th>
                                        
                                                                    
                                    <th>
                                    Account Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($account->users as $users): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($users->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->owner) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($users->role_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->status) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->first_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->last_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->password) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->auth_key) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->account_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Cases']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($account->cases)): ?>

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
                                    Account Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    State
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                    
                                    <th>
                                    Priority
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                    
                                    <th>
                                    Subject
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Resolution
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($account->cases as $cases): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($cases->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->owner) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($cases->account_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->state) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->status) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->priority) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->subject) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->resolution) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cases->user_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Cases', 'action' => 'view', $cases->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cases', 'action' => 'edit', $cases->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cases', 'action' => 'delete', $cases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cases->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Contacts']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($account->contacts)): ?>

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
                                    First Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Last Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone1
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ext1
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone2
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ext2
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone3
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ext3
                                    </th>
                                        
                                                                    
                                    <th>
                                    Is Allowed Calls
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Title
                                    </th>
                                        
                                                                    
                                    <th>
                                    Department
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Account Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($account->contacts as $contacts): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($contacts->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->owner) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($contacts->first_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->last_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->phone1) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->ext1) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->phone2) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->ext2) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->phone3) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->ext3) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->is_allowed_calls) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->title) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->department) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->account_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($contacts->user_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
