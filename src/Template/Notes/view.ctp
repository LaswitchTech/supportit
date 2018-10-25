<section class="content-header">
  <h1>
    <?php echo __('Note'); ?>
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
                                                                                                                <dt><?= __('Email Id') ?></dt>
                                        <dd>
                                            <?= h($note->email_id) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Subject') ?></dt>
                                        <dd>
                                            <?= h($note->subject) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($note->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Id') ?></dt>
                                <dd>
                                    <?= $this->Number->format($note->link_id) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($note->link_type) ?>
                                </dd>
                                                                                                                <dt><?= __('Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($note->type) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Content') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($note->content)); ?>
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
