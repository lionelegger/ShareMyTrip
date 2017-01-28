<div class="container text-center">
    <h1><?= __("Share My Trip") ?></h1>
    <div class="col-md-4 col-md-offset-4">
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create() ?>
        <h3><?= __("Login") ?></h3>
        <form class="form-horizontal">
            <div class="form-group">
                <?= $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => false]) ?>
                <br/>
                <?= $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'Password', 'label' => false]) ?>
            </div>
            <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
            <span>&nbsp;&nbsp;&nbsp;or <button type="button" class="btn btn-link" data-toggle="modal" data-target="#addUserModal">Register</button></span>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
