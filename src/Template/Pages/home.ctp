
<h1>BEFORE</h1>
<?= $this->fetch('content') ?>
<h1>AFTER</h1>


<!-- ADD USER modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register a new user</h4>
            </div>
            <form method="post" accept-charset="utf-8" _lpchecked="1">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="userToAdd.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" ng-model="userToAdd.password">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="first_name" placeholder="First name" ng-model="userToAdd.first_name">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="userToAdd.last_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addUser()" data-dismiss="modal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container text-center">
    <h1><?= __("Share My Trip") ?></h1>
    <div class="col-md-4 col-md-offset-4">
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]); ?>
        <h3><?= __("Login") ?></h3>
            <div class="form-group">
                <?= $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => false]) ?>
                <br/>
                <?= $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'Password', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
                <span>&nbsp;&nbsp;&nbsp;or <button type="button" class="btn btn-link" data-toggle="modal" data-target="#addUserModal">Register</button></span>
                <?= $this->Form->end() ?>
            </div>
        </form>
    </div>
</div>






