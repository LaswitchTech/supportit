<section class="content-header">
  <h1>
    <?php echo __('Address'); ?>
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
                                            <?= h($address->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                        <dd>
                                            <?= h($address->phone) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Street') ?></dt>
                                        <dd>
                                            <?= h($address->street) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('City') ?></dt>
                                        <dd>
                                            <?= h($address->city) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Zipcode') ?></dt>
                                        <dd>
                                            <?= h($address->zipcode) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('State') ?></dt>
                                        <dd>
                                            <?= h($address->state) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Country') ?></dt>
                                        <dd>
                                            <?= h($address->country) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Owner') ?></dt>
                                <dd>
                                    <?= $this->Number->format($address->owner) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Id') ?></dt>
                                <dd>
                                    <?= $this->Number->format($address->link_id) ?>
                                </dd>
                                                                                                                <dt><?= __('Link Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($address->link_type) ?>
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
