<section class="content-header">
  <h1>
    <?php echo __('Log'); ?>
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
                                                                                                        <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $log->has('user') ? $log->user->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Tbl') ?></dt>
                                        <dd>
                                            <?= h($log->tbl) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Log File') ?></dt>
                                        <dd>
                                            <?= h($log->log_file) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ipv4') ?></dt>
                                        <dd>
                                            <?= h($log->ipv4) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($log->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($log->type) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Is Success') ?></dt>
                            <dd>
                            <?= $log->is_success ? __('Yes') : __('No'); ?>
                            </dd>
                                                                    
                                                                        <dt><?= __('Content') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($log->content)); ?>
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

</section>
