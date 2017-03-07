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
            <span>&nbsp;&nbsp;&nbsp;or <button type="button" class="btn btn-link" data-toggle="modal" data-target="#registerModal">Register</button></span>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
<!-- ADD USER modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register me</h4>
            </div>
            <form method="post" accept-charset="utf-8" _lpchecked="1">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="userToAdd.email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" ng-model="userToAdd.password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="first_name" placeholder="First name" ng-model="userToAdd.first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="userToAdd.last_name" required>
                    </div>
                    <div class="form-group text-center" ng-init="userToAdd.avatar=16">
                        <input type="hidden" name="avatar" value="1" >
                        <label for="avatar-16">
                            <input type="radio" name="avatar" value="16" class="avatar avatar-16" ng-init="" ng-model="userToAdd.avatar" id="avatar-16">
                        </label>
                        <label for="avatar-13">
                            <input type="radio" name="avatar" value="13" class="avatar avatar-13" ng-model="userToAdd.avatar" id="avatar-13">
                        </label>
                        <label for="avatar-2">
                            <input type="radio" name="avatar" value="2" class="avatar avatar-2" ng-model="userToAdd.avatar" id="avatar-2">
                        </label>
                        <label for="avatar-11">
                            <input type="radio" name="avatar" value="11" class="avatar avatar-11" ng-model="userToAdd.avatar" id="avatar-11">
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addUser()" data-dismiss="modal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
