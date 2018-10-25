<section class="content-header">
  <h1>
    <?php echo __('Message'); ?>
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
                                            <?= h($message->subject) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($message->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Sender') ?></dt>
                                <dd>
                                    <?= $this->Number->format($message->sender) ?>
                                </dd>
                                                                                                                <dt><?= __('Receiver') ?></dt>
                                <dd>
                                    <?= $this->Number->format($message->receiver) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Is Read') ?></dt>
                            <dd>
                            <?= $message->is_read ? __('Yes') : __('No'); ?>
                            </dd>
                                                                    
                                                                        <dt><?= __('Message') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($message->message)); ?>
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
