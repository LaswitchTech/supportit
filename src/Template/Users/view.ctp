<?php if(($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '1')) or ($user->id == $this->request->getSession()->read('Auth.User.id'))) : ?>
<section class="content-header">
  <h1>
    User
    <small><?= __('View') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-gear"></i> Settings</li>
    <li><?= $this->Html->link(__('Users'), ['action' => 'index'], ['escape' => false]) ?></li>
    <li>View</li>
    <li class="active"><?= h($user->first_name) ?> <?= h($user->last_name) ?></li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <p class="text-center"><i class="fa fa-user" style="font-size:120px"></i></p>

            <h3 class="profile-username text-center"><a style="cursor:pointer;"><?= h($user->first_name) ?> <?= h($user->last_name) ?></a></h3>

          <p class="text-muted text-center"></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Status</b>
                <?php 
                switch ($this->Number->format($user->status)) {
                    case 0:
                        echo "<a class='btn btn-success btn-xs pull-right'><i class='fa fa-check' style='padding-right:5px'></i> Active</a>";
                        break;
                    case 1:
                        echo "<a class='btn btn-default btn-xs pull-right'><i class='fa fa-hourglass-half' style='padding-right:5px'></i> Pending</a>";
                        break;
                    case 2:
                        echo "<a class='btn btn-primary btn-xs pull-right'><i class='fa fa-user-times' style='padding-right:5px'></i> Locked</a>";
                        break;
                    case 3:
                        echo "<a class='btn btn-warning btn-xs pull-right'><i class='fa fa-lock' style='padding-right:5px'></i> Suspended</a>";
                        break;
                    case 4:
                        echo "<a class='btn btn-danger btn-xs pull-right'><i class='fa fa-times' style='padding-right:5px'></i> Blocked</a>";
                        break;
                } ?>
            </li>
            <li class="list-group-item">
              <b>Email</b> <a class="pull-right"><?= $user->email; ?></a>
            </li>
            <li class="list-group-item">
              <b>Created</b> <a class="pull-right"><?= date("d F, Y \a\\t g:i:sA", strtotime($user->created)); ?></a>
            </li>
          </ul>
        <?php if(($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setUsers', '3')) or ($user->id == $this->request->getSession()->read('Auth.User.id'))) : ?>
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white', 'style' => 'padding-right:5px')).'Edit', array('controller' => 'Users', 'action' => 'editUser', $user->id), array('escape' => false, 'class'=>'btn btn-default btn-block')) ?>
        <?php endif; ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '1')) : ?>
            <li class="active"><a href="#tasks" data-toggle="tab"><i class="fa fa-tasks" style="padding-right:5px"></i>Tasks</a></li>
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '1')) : ?>
            <li><a href="#devices" data-toggle="tab"><i class="fa fa-server" style="padding-right:5px"></i>Devices</a></li>
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '1')) : ?>
            <li><a href="#nics" data-toggle="tab"><i class="fa fa-sitemap" style="padding-right:5px"></i>NICs</a></li>
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
            <li><a href="#roles" data-toggle="tab"><i class="fa fa-lock" style="padding-right:5px"></i>Roles</a></li>
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
            <li><a href="#permissions" data-toggle="tab"><i class="fa fa-lock" style="padding-right:5px"></i>Permissions</a></li>
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
            <li><a href="#logs" data-toggle="tab"><i class="fa fa-file-text" style="padding-right:5px"></i>Logs</a></li>
          <?php endif; ?>
        </ul>
        <div class="tab-content">
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '1')) : ?>
          <div class="active tab-pane" id="tasks">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of Tasks</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '2')) : ?>
                            <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-tasks','style' => 'padding-right:5px')).'New', array('controller' => 'Tasks', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Tasks">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;">Type</th>
                                <th>Description</th>
                                <th style="width: 100px;">Created</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->tasks as $tasks): ?>
                                <tr>
                                    <td><?= $this->Format->getName($tasks->device_id, 'devices') ? $this->Html->link($this->Format->getName($tasks->device_id, 'devices'), ['controller' => 'Devices', 'action' => 'view', $tasks->device_id]) : '' ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($tasks->status)) {
                                            case 0:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-sticky-note' style='padding-right:5px'></i>Closed</a>";
                                                break;
                                            case 1:
                                                echo "<a class='btn btn-primary btn-sm btn-block btn-flat'><i class='fa fa-sticky-note-o' style='padding-right:5px'></i>Open</a>";
                                                break;
                                            case 2:
                                                echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-lock' style='padding-right:5px'></i>Locked</a>";
                                                break;
                                        } ?>
                                    </td>
                                    <td><?= h($tasks->type) ?></td>
                                    <td><?= h($tasks->description) ?></td>
                                    <td><?= h($tasks->created) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '1')) : ?>
                                            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Tasks', 'action' => 'view', $tasks->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '3')) : ?>
                                            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Tasks', 'action' => 'edit', $tasks->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setTasks', '4')) : ?>
                                            <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Tasks', 'action' => 'delete', $tasks->id), array('confirm' => __('Are you sure you want to delete the task "'.$tasks->id.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '1')) : ?>
          <div class="tab-pane" id="devices">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of Devices</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '2')) : ?>
                        <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-server','style' => 'padding-right:5px')).'New', array('controller' => 'Devices', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Devices">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;">Location</th>
                                <th style="width: 100px;">Type</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->devices as $devices): ?>
                                <tr>
                                    <td><?= h($devices->name) ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($devices->status)) {
                                            case 0:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-hourglass-half' style='padding-right:5px'></i>Checking</a>";
                                                break;
                                            case 1:
                                                echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i>Check Failed</a>";
                                                break;
                                            case 2:
                                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-check' style='padding-right:5px'></i>Check Success</a>";
                                                break;
                                            case 3:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-hourglass-half' style='padding-right:5px'></i>Benching</a>";
                                                break;
                                            case 4:
                                                echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i>Bench Failed</a>";
                                                break;
                                            case 5:
                                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-check' style='padding-right:5px'></i>Bench Success</a>";
                                                break;
                                            case 6:
                                                echo "<a class='btn btn-info btn-sm btn-block btn-flat'><i class='fa fa-lock' style='padding-right:5px'></i>Reserved</a>";
                                                break;
                                            case 7:
                                                echo "<a class='btn btn-primary btn-sm btn-block btn-flat'><i class='fa fa-server' style='padding-right:5px'></i>Delivered</a>";
                                                break;
                                            case 8:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-recycle' style='padding-right:5px'></i>Recycling</a>";
                                                break;
                                            case 9:
                                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-recycle' style='padding-right:5px'></i>Recycled</a>";
                                                break;
                                            case 10:
                                                echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-bug' style='padding-right:5px'></i>Hacked</a>";
                                                break;
                                            case 11:
                                                echo "<a class='btn btn-warning btn-sm btn-block btn-flat'><i class='fa fa-ban' style='padding-right:5px'></i>Suspended</a>";
                                                break;
                                            case 12:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-archive' style='padding-right:5px'></i>Unrack</a>";
                                                break;
                                            case 13:
                                                echo "<a class='btn btn-default btn-sm btn-block btn-flat'><i class='fa fa-anchor' style='padding-right:5px'></i>Racked</a>";
                                                break;
                                        } ?>
                                    </td>
                                    <td><?= h($devices->location) ?> <?= h($devices->room) ?>/<?= h($devices->rack) ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($devices->type)) {
                                            case 0:
                                                echo "Server";
                                                break;
                                            case 1:
                                                echo "VPS";
                                                break;
                                            case 2:
                                                echo "VDE";
                                                break;
                                            case 3:
                                                echo "Workstation";
                                                break;
                                            case 4:
                                                echo "Printer";
                                                break;
                                            case 5:
                                                echo "Camera";
                                                break;
                                            case 6:
                                                echo "Cellphone";
                                                break;
                                            case 7:
                                                echo "Laptop";
                                                break;
                                            case 8:
                                                echo "Router";
                                                break;
                                            case 9:
                                                echo "Switch";
                                                break;
                                            case 10:
                                                echo "Desktop";
                                                break;
                                        } ?>
                                    </td>
                                    <td><?= h($devices->brand) ?></td>
                                    <td><?= h($devices->model) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '1')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Devices', 'action' => 'view', $devices->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '3')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Devices', 'action' => 'edit', $devices->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setDevices', '4')) : ?>
                                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Devices', 'action' => 'delete', $devices->id), array('confirm' => __('Are you sure you want to delete the device "'.$devices->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '1')) : ?>
          <div class="tab-pane" id="nics">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of NICs</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '2')) : ?>
                            <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-sitemap','style' => 'padding-right:5px')).'New', array('controller' => 'Nics', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Nics">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Name</th>
                                <th>Device</th>
                                <th style="width: 100px;">IPv4</th>
                                <th>MAC</th>
                                <th style="width: 200px;">Network</th>
                                <th style="width: 100px;">ICMP</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->nics as $nics): ?>
                                <tr>
                                    <td><?= h($nics->name) ?></td>
                                    <td><?= $this->Format->getName($nics->device_id, 'devices') ? $this->Html->link($this->Format->getName($nics->device_id, 'devices'), ['controller' => 'Devices', 'action' => 'view', $nics->device_id]) : '' ?></td>
                                    <td><?= h($nics->ipv4) ?></td>
                                    <td><?= h($nics->mac) ?></td>
                                    <td><?= h($nics->router_ip) ?> => <?= h($nics->switch_ip) ?> (<?= h($nics->switch_port) ?>)</td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($nics->icmp)) {
                                            case 0:
                                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-eye' style='padding-right:5px'></i>Enable</a>";
                                                break;
                                            case 1:
                                                echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-eye-slash' style='padding-right:5px'></i>Disable</a>";
                                                break;
                                        } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '1')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Nics', 'action' => 'view', $nics->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '3')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Nics', 'action' => 'edit', $nics->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setNics', '4')) : ?>
                                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Nics', 'action' => 'delete', $nics->id), array('confirm' => __('Are you sure you want to delete the nic "'.$nics->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
          <div class="tab-pane" id="roles">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of Roles</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '2')) : ?>
                            <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-lock','style' => 'padding-right:5px')).'New', array('controller' => 'Roles', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Roles">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->roles as $roles): ?>
                                <tr>
                                    <td><?= h($roles->name) ?></td>
                                    <td><?= $this->Html->link($this->Format->getFullname($roles->owner), ['controller' => 'Users', 'action' => 'view', $roles->owner, '_full' => true]) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '1')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Roles', 'action' => 'view', $roles->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '3')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Roles', 'action' => 'edit', $roles->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setRoles', '4')) : ?>
                                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Roles', 'action' => 'delete', $nics->id), array('confirm' => __('Are you sure you want to delete the role "'.$roles->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
          <div class="tab-pane" id="permissions">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of Permissions</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '2')) : ?>
                            <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-lock','style' => 'padding-right:5px')).'New', array('controller' => 'Permissions', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Permissions">
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
                            <?php foreach ($user->permissions as $permissions): ?>
                                <tr>
                                    <td><?= h($permissions->name) ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($permissions->level)) {
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
                                    <td><?= $this->Format->getName($permissions->role_id, 'roles') ? $this->Html->link($this->Format->getName($permissions->role_id, 'roles'), ['controller' => 'Roles', 'action' => 'view', $permissions->role_id]) : '' ?></td>
                                    <td><?= $this->Html->link($this->Format->getFullname($permissions->owner), ['controller' => 'Users', 'action' => 'view', $permissions->owner, '_full' => true]) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '1')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Permissions', 'action' => 'view', $permissions->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '3')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Permissions', 'action' => 'edit', $permissions->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setPermissions', '4')) : ?>
                                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Permissions', 'action' => 'delete', $nics->id), array('confirm' => __('Are you sure you want to delete the permission "'.$permissions->name.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
          <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
          <div class="tab-pane" id="logs">
              <div class="row">
                <div class="col-xs-6">
                    <div>
                      <h3>List of Logs</h3>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div>
                        <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
                        <span class="pull-right"><?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text','style' => 'padding-right:5px')).'New', array('controller' => 'Logs', 'action' => 'add'), array('escape' => false, 'class'=>'btn btn-success btn-sm')) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="User-Logs">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Type</th>
                                <th>Table</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th style="width: 100px;">Date</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->logs as $logs): ?>
                                <tr>
                                    <td><?= $this->Html->link($this->Format->getFullname($logs->user_id), ['controller' => 'Users', 'action' => 'view', $logs->user_id, '_full' => true]) ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($logs->type)) {
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
                                    <td><?= h($logs->tbl) ?></td>
                                    <td><?= h($logs->content) ?></td>
                                    <td>
                                        <?php 
                                        switch ($this->Number->format($logs->is_success)) {
                                            case 0:
                                                echo "<a class='btn btn-danger btn-sm btn-block btn-flat'><i class='fa fa-times' style='padding-right:5px'></i>Error</a>";
                                                break;
                                            case 1:
                                                echo "<a class='btn btn-success btn-sm btn-block btn-flat'><i class='fa fa-check' style='padding-right:5px'></i>Success</a>";
                                                break;
                                        } ?>
                                    </td>
                                    <td><?= h($logs->created) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '1')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-text-o text-white')), array('controller' => 'Logs', 'action' => 'view', $logs->id), array('escape' => false, 'class'=>'btn btn-primary btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '3')) : ?>
                                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit text-white')), array('controller' => 'Logs', 'action' => 'edit', $logs->id), array('escape' => false, 'class'=>'btn btn-default btn-sm')) ?>
                                            <?php endif; ?>
                                            <?php if($this->Roles->getRole($this->request->getSession()->read('Auth.User.id'), 'setLogs', '4')) : ?>
                                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash text-white')), array('controller' => 'Logs', 'action' => 'delete', $logs->id), array('confirm' => __('Are you sure you want to delete the log entry "'.$logs->id.'"?'),'escape' => false, 'class'=>'btn btn-danger btn-sm')) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
          </div>
          <!-- /.tab-pane -->
          <?php endif; ?>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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
    $('#User-Nics').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "processing": true,
    });
    $('#User-Devices').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "processing": true,
    });
    $('#User-Roles').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "processing": true,
    });
    $('#User-Permissions').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "processing": true,
    });
    $('#User-Tasks').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "processing": true,
      "scrollX": true,
    });
    $('#User-Logs').DataTable({
      "paging": true,
      "pageLength": 25,
      "lengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "searching": true,
      "ordering": true,
      "order": [[ 5, "desc" ]],
      "info": true,
      "autoWidth": true,
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
