<section class="content-header">
  <h1>
    <?php echo __('Alert'); ?>
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
                                    <?= $alert->has('user') ? $alert->user->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Subject') ?></dt>
                                        <dd>
                                            <?= h($alert->subject) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($alert->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Sender') ?></dt>
                                <dd>
                                    <?= $this->Number->format($alert->sender) ?>
                                </dd>
                                                                                                                <dt><?= __('Receiver') ?></dt>
                                <dd>
                                    <?= $this->Number->format($alert->receiver) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Message') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($alert->message)); ?>
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
