<section class="content-header">
  <h1>
    <?php echo __('Contact'); ?>
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
                                                                                                                <dt><?= __('First Name') ?></dt>
                                        <dd>
                                            <?= h($contact->first_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Last Name') ?></dt>
                                        <dd>
                                            <?= h($contact->last_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone1') ?></dt>
                                        <dd>
                                            <?= h($contact->phone1) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ext1') ?></dt>
                                        <dd>
                                            <?= h($contact->ext1) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone2') ?></dt>
                                        <dd>
                                            <?= h($contact->phone2) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ext2') ?></dt>
                                        <dd>
                                            <?= h($contact->ext2) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone3') ?></dt>
                                        <dd>
                                            <?= h($contact->phone3) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ext3') ?></dt>
                                        <dd>
                                            <?= h($contact->ext3) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Is Allowed Calls') ?></dt>
                                        <dd>
                                            <?= h($contact->is_allowed_calls) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($contact->email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Title') ?></dt>
                                        <dd>
                                            <?= h($contact->title) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Department') ?></dt>
                                        <dd>
                                            <?= h($contact->department) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Account') ?></dt>
                                <dd>
                                    <?= $contact->has('account') ? $contact->account->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $contact->has('user') ? $contact->user->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($contact->owner) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Description') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($contact->description)); ?>
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
