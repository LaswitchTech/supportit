<section class="content-header">
  <h1>
    <?php echo __('Call'); ?>
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
                                                                                                                <dt><?= __('Subject') ?></dt>
                                        <dd>
                                            <?= h($call->subject) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Duration') ?></dt>
                                        <dd>
                                            <?= h($call->duration) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $call->has('user') ? $call->user->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($call->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($call->status) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Id') ?></dt>
                                <dd>
                                    <?= $this->Number->format($call->link_id) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($call->link_type) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                                <dt><?= __('Start') ?></dt>
                                <dd>
                                    <?= h($call->start) ?>
                                </dd>
                                                                                                                    <dt><?= __('End') ?></dt>
                                <dd>
                                    <?= h($call->end) ?>
                                </dd>
                                                                                                    
                                            
                                                                        <dt><?= __('Content') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($call->content)); ?>
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
