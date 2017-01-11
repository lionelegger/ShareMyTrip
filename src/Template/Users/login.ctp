<div class="col-md-6 col-md-offset-3">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <h3 class="page-header"><?= __("Please enter your email and password to login:") ?></h3>
    <form class="form-horizontal">
        <div class="form-group">
            <?= $this->Form->input('email', ['class' => 'form-control']) ?>
            <?= $this->Form->input('password', ['class' => 'form-control']) ?>
        </div>
        <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
        <?= $this->Form->end() ?>
    </form>
</div>
