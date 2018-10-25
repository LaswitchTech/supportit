<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane active" id="control-sidebar-settings-tab">
      <?php $options="1" ?>
      <?= $this->Form->create($options, ['url' => '/settings/personalize']) ?>
        <h3 class="control-sidebar-heading">General Settings</h3>
        <div class="form-group">
          <label class="control-sidebar-subheading">
            Display Device Status
            <input name="graph-device-icmp" type="checkbox" class="pull-right" checked>
          </label>
          <p>This controls weither the ICMP graphs is displayed or not. Disabling the graph may increase performance.</p>
        </div>
        <!-- /.form-group -->
        <?= $this->Form->button('<i class="fa fa-save" style="padding-right: 5px;"></i>Save',[
                'escape' => false,
                'type' => 'submit',
                'class' => 'btn btn-success btn-block',
                'templates' => [
                    'submitContainer' => '{{content}}',
                ],

            ]); ?>
      <?= $this->Form->end() ?>
      <h3 class="control-sidebar-heading">Administration Settings</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="/settings/site">
            <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Customisation</h4>
                <p>Site Customisation Settings</p>
            </div>
          </a>
        </li>
        <li>
          <a href="/settings/sql">
            <i class="menu-icon fa fa-database bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Database</h4>
                <p>SQL Settings</p>
            </div>
          </a>
        </li>
        <li>
          <a href="/logs">
            <i class="menu-icon fa fa-file-text bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Logs</h4>
                <p>View complete logs</p>
            </div>
          </a>
        </li>
        <li>
          <a href="/roles">
            <i class="menu-icon fa fa-lock bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Roles</h4>
                <p>Manage Security Access</p>
            </div>
          </a>
        </li>
        <li>
          <a href="/settings/update">
            <i class="menu-icon glyphicon glyphicon-save bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Updates</h4>
                <p>Install latest updates</p>
            </div>
          </a>
        </li>
        <li>
          <a href="/users">
            <i class="menu-icon fa fa-users bg-light-blue"></i>
            <div class="menu-info">
                <h4 class="control-sidebar-subheading">Users</h4>
                <p>Currently <?= $this->User->getUsercount(); ?> Users</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
