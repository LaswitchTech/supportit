<?php if($loggedIn) : ?>
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">








      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 4 messages</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li><!-- start message -->
                <a href="#">
                  <div class="pull-left">
                    <img src="/lt/admin_l_t_e/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>                  </div>
                  <h4>
                    Support Team
                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <!-- end message -->
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="/LT/admin_l_t_e/img/user3-128x128.jpg" class="img-circle" alt="User Image"/>                  </div>
                  <h4>
                    AdminLTE Design Team
                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="/LT/admin_l_t_e/img/user4-128x128.jpg" class="img-circle" alt="User Image"/>                  </div>
                  <h4>
                    Developers
                    <small><i class="fa fa-clock-o"></i> Today</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="/LT/admin_l_t_e/img/user3-128x128.jpg" class="img-circle" alt="User Image"/>                  </div>
                  <h4>
                    Sales Department
                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="/LT/admin_l_t_e/img/user4-128x128.jpg" class="img-circle" alt="User Image"/>                  </div>
                  <h4>
                    Reviewers
                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">See All Messages</a></li>
        </ul>
      </li>








      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
            <?php if ( $this->Alert->getAlertcount() >= 1 ) : ?>
                <span class="label label-warning"><?= $this->Alert->getAlertcount() ?></span>
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have <?= $this->Alert->getAlertcount() ?> alerts</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <?php foreach ($this->Alert->getAlert() as $alert): ?>
                <li>
                  <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa '.$alert->icon, 'style' => 'padding-right: 5px;')).$alert->subject.'<span style="color: #000;"><br /><small class="pull-right">'.$alert->created.'</small><br /></span>', array('controller' => 'Alerts', 'action' => 'close', $alert->id), array('escape' => false, 'class'=>'')) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li class="footer">
            <?= $this->Html->link('View all alerts', array('controller' => 'Alerts', 'action' => 'index'), array('escape' => false)) ?>
          </li>
        </ul>
      </li>
      <!-- Tasks: style can be found in dropdown.less -->
      <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-flag-o"></i>
            <?php if ( $this->Task->getTaskscount() >= 1 ) : ?>
                <span class="label label-danger"><?= $this->Task->getTaskscount() ?></span>
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have <?= $this->Task->getTaskscount() ?> tasks</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <?php foreach ($this->Task->getTasks() as $task): ?>
                <li>
                  <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-server', 'style' => 'padding-right: 5px;')).$this->Format->getName($task->device_id, 'devices').'<br /><span style="color: #000;">'.$task->description.'<br /><small class="pull-right">'.$task->created.'</small><br /></span>', array('controller' => 'Devices', 'action' => 'view', $task->device_id), array('escape' => false, 'class'=>'')) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li class="footer">
            <?= $this->Html->link('View all tasks', array('controller' => 'Tasks', 'action' => 'index'), array('escape' => false)) ?>
          </li>
        </ul>
      </li>
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-user user-image" style="font-size:24px;"></i><span class="hidden-xs"><?= $this->request->getSession()->read('Auth.User.first_name'); ?> <?= $this->request->getSession()->read('Auth.User.last_name'); ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <i class="fa fa-user" style="font-size:84px;color:white;"></i>
            <p>
              <?= $this->request->getSession()->read('Auth.User.first_name'); ?> <?= $this->request->getSession()->read('Auth.User.last_name'); ?>
              <small><?= date('F jS, Y \a\t h:i:s A', strtotime($this->request->getSession()->read('Auth.User.created'))); ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-user text-white', 'style' => 'padding-right: 5px;')).'Profile', array('controller' => 'Users', 'action' => 'view', $this->request->getSession()->read('Auth.User.id')), array('escape' => false, 'class'=>'btn btn-default btn-flat')) ?>
            </div>
            <div class="pull-right">
              <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-sign-out text-white', 'style' => 'padding-right: 5px;')).'Sign out', array('controller' => 'Users', 'action' => 'logout'), array('escape' => false, 'class'=>'btn btn-default btn-flat')) ?>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="glyphicon glyphicon-option-vertical"></i></a>
      </li>
    </ul>
  </div>
</nav>
<?php endif; ?>