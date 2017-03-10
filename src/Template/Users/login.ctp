<style>
    html {
        background: url("webroot/img/20131123-MM-1323.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    body {
        background-color: transparent;
        color: #FFF;
    }
    .modal {
        color: #333;
    }
    h1.login {
        color: #FFF;
        opacity: 0.7;
    }
    h3.login {
        color: #337ab7;
    }
    .navbar-fixed-top {
        display: none;
    }
    .navbar-fixed-bottom {
        background-color: transparent;
        border-top: none;
        text-align: center;
    }
    @media only screen and (max-width: 768px) {
        .navbar-fixed-bottom {
            display: block;
        }
    }
    .navbar-fixed-bottom .pull-right {
        float: none !important;
    }
    .navbar-fixed-bottom a:hover {
        color: #FFF;
    }
    .form-control.input-login {
        background-color: rgba(0,0,0,0.7);
        border: 1px solid #232323;
        color: #FFF;
    }
    button.btn-link.btn-login {
        color: lightgrey;
    }
    button.btn-link.btn-login:hover {
        color: #FFF;
    }

</style>

<?= $this->Flash->render('auth') ?>
<div class="container text-center ">
    <div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3">
        <h1 class="login"><?= __("Share my trip") ?></h1>

        <?= $this->Form->create() ?>
        <p>Keeping the <i>Let's Go</i> and taking the <i>Uh-Oh</i> out of travel</p>
        <h3 class="login"><?= __("Please login") ?></h3>
        <form class="form-horizontal">
            <div class="form-group">
                <?= $this->Form->input('email', ['class' => 'form-control input-login', 'placeholder' => 'Email', 'label' => false]) ?>
                <br/>
                <?= $this->Form->input('password', ['class' => 'form-control input-login', 'placeholder' => 'Password', 'label' => false]) ?>
            </div>
            <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
            <span>&nbsp;&nbsp;&nbsp;or <button type="button" class="btn btn-link btn-login" data-toggle="modal" data-target="#registerModal">Register</button></span>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
<!-- ADD USER modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header color-lightgrey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title">Registration</h2>
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
                        <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="userToAdd.last_name">
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
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addUser()" data-dismiss="modal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
