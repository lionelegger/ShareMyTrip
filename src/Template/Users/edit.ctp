<? $this->Html->addCrumb($user->first_name, ['controller' => 'Users', 'action' => 'edit', $user->id]) ?>
<? $this->Html->addCrumb('Profile') ?>

<div class="container clearfix">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>My profile</h1>
            <?= $this->Form->create($user, ['type' => 'file', 'class' => 'form-horizontal']) ?>
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('email', ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <?= $this->Form->input('first_name', ['class' => 'form-control']); ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Form->input('last_name', ['class' => 'form-control']); ?>
                    </div>
                </div>

                <!--  TODO: hide password fields (otherwise it changes password when submit the form -->
                <!--  TODO: http://base-syst.com/2016/09/16/password-validation-when-changing-password-in-cakephp-3/ -->
                <!--
                <div class="form-group">
                    <div class="col-sm-6">
                        <?/*= $this->Form->input('password', ['class' => 'form-control']); */?>
                    </div>
                    <div class="col-sm-6">
                        <?/*= $this->Form->input('password', ['class' => 'form-control']); */?>
                    </div>
                </div>
                -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('photo', ['type' => 'file', 'class' => 'form-control']); ?>
                        <div class="help-block">Please upload a square 300px by 300px picture...</div>
                    </div>
                </div>
            </fieldset>
            <div class="text-right">
                <?
                echo $this->Html->link(__('Cancel'), [
                    'controller' => 'Trips',
                    'action' => 'index'
                ], ['class' => 'btn btn-default']);
                echo ("&nbsp;");
                echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']);
                echo $this->Form->end();
                ?>
            </div>
            <br><hr/>
            <div class="text-center">
                <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], array('class' => 'btn btn-default', 'type' => 'button')) ?>
            </div>
        </div>
    </div>
</div>
