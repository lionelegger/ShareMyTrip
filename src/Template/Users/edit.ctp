<?php
$userSession = $this->request->session()->read('Auth.User');

// Breadcrumb
$this->Html->addCrumb("Trips", ['controller' => 'Trips', 'action' => 'index']);
$this->Html->addCrumb($user->first_name, ['controller' => 'Users', 'action' => 'edit', $user->id]);
$this->Html->addCrumb('Profile');

// Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
    "active_user" => true,
    "disabled_map" => true,
    "disabled_budget" => true,
    "disabled_plan" => true
]);
echo $this->fetch('navigation');
$this->end();

?>

<div class="container clearfix">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="page-header">My profile</h1>
            <p class="text-info text-center small">Your profile modification will be visible at the next login</p>
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
                    <br class="visible-xs">
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
                <p class="help-block">Select your avatar... </p>

                <input type="hidden" name="avatar" value="1">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                            echo $this->Form->radio(
                                'avatar',
                                [
                                    ['value' => '1', 'text' => '', 'class' => 'avatar avatar-1'],
                                    ['value' => '2', 'text' => '', 'class' => 'avatar avatar-2'],
                                    ['value' => '3', 'text' => '', 'class' => 'avatar avatar-3'],
                                    ['value' => '4', 'text' => '', 'class' => 'avatar avatar-4'],
                                    ['value' => '5', 'text' => '', 'class' => 'avatar avatar-5'],
                                    ['value' => '6', 'text' => '', 'class' => 'avatar avatar-6'],
                                    ['value' => '7', 'text' => '', 'class' => 'avatar avatar-7'],
                                    ['value' => '8', 'text' => '', 'class' => 'avatar avatar-8'],
                                    ['value' => '9', 'text' => '', 'class' => 'avatar avatar-9'],
                                    ['value' => '10', 'text' => '', 'class' => 'avatar avatar-10'],
                                    ['value' => '11', 'text' => '', 'class' => 'avatar avatar-11'],
                                    ['value' => '12', 'text' => '', 'class' => 'avatar avatar-12'],
                                    ['value' => '13', 'text' => '', 'class' => 'avatar avatar-13'],
                                    ['value' => '14', 'text' => '', 'class' => 'avatar avatar-14'],
                                    ['value' => '15', 'text' => '', 'class' => 'avatar avatar-15'],
                                    ['value' => '16', 'text' => '', 'class' => 'avatar avatar-16'],
                                    ['value' => '17', 'text' => '', 'class' => 'avatar avatar-17'],
                                    ['value' => '18', 'text' => '', 'class' => 'avatar avatar-18'],
                                    ['value' => '19', 'text' => '', 'class' => 'avatar avatar-19'],
                                    ['value' => '20', 'text' => '', 'class' => 'avatar avatar-20']
//                                    ['value' => '21', 'text' => '', 'class' => 'avatar avatar-21'],
//                                    ['value' => '22', 'text' => '', 'class' => 'avatar avatar-22']
                                ]
                            );
                        ?>
                    </div>
                </div>

                <p class="help-block">... or upload your own avatar </p>
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
                ], ['class' => 'btn btn-link']);
                echo ("&nbsp;");
                echo $this->Form->button(__('Save'), ['class' => 'btn btn-primary']);
                echo $this->Form->end();
                ?>
            </div>
            <br>
            <hr/>
            <div class="text-center">
                <?= $this->Html->link("<span class='glyphicon glyphicon-off'></span>&nbsp;".__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-default', 'type' => 'button', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

