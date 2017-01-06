<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $this->fetch('title') ?></title>


    <?= $this->Html->script('angular.min.js') ?>
    <?= $this->Html->script('angular-route.min.js') ?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
    <?= $this->Html->script('ng-map.min.js') ?>

    <!--  Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.min.css') ?>
    <?= $this->Html->css('custom.css') ?>


</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<body ng-app="myApp" ng-controller="MainCtrl" ng-init="currentUserId='<?= $userSession['id'] ?>'">

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand">

                <!-- TODO: Make a logo and add the logo image below
                <img alt="Brand" src="...">
                -->
                <span class="glyphicon glyphicon-globe"></span>
            </a>
            <?php if($userSession): ?>
                <a class="navbar-brand" href="#/trips"> ShareMyTrip</a>
            <?php else: ?>
                <a class="navbar-brand" href="#/home"> ShareMyTrip</a>
            <?php endif; ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if($userSession): ?>
            <ul class="nav navbar-nav">
                <li ng-class="{ active: isCurrentPath('/plan') }"><a href="#/plan">Plan</a></li>
                <li ng-class="{ active: isCurrentPath('/map') }"><a href="#/map">Map</a></li>
                <li ng-class="{ active: isCurrentPath('/cost') }"><a href="#/cost">Cost</a></li>
            </ul>
            <?php endif; ?>
            <?php if($userSession): ?>
                <span class="hidden" id="userId" data-id="<?= $userSession['id'] ?>"></span>
                <form class="navbar-form navbar-right">
                    <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], array('class' => 'btn btn-default', 'type' => 'button')) ?>
                </form>
                <p class="navbar-text navbar-right">Welcome <?= $userSession['first_name'] ?></p>
            <?php else: ?>
                <form class="navbar-form navbar-right" method="post" action="users/login" accept-charset="utf-8" _lpchecked="1">
                    <div style="display:none;">
                        <input type="hidden" name="_method" value="POST">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>&nbsp;
                    <button type="button" class="btn btn-link pull-right" data-toggle="modal" data-target="#addUserModal">Register</button>
                </form>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

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
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="newUserToAdd.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" ng-model="newUserToAdd.password">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="first_name" placeholder="First name" ng-model="newUserToAdd.first_name">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="newUserToAdd.last_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addNewUser()" data-dismiss="modal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <!--  We load the angularJS templates here (depending of ng-route defined in app.js)  -->
    <ng-view></ng-view>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('moment.min.js') ?>
<!-- Latest compiled and minified Boostrap JavaScript -->
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('bootstrap-datetimepicker.min.js') ?>
<?= $this->Html->script('app.js') ?>
<?= $this->Html->script('controllers.js') ?>
<script>window.onload = initialize;</script>
</body>
</html>
