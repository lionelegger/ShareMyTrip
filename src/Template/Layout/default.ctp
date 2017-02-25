<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <base href="http://127.0.0.1:8888/UNIGE/Projects/ShareMyTrip/"/>
<!--    <base href="http://www.lionelegger.com/ShareMyTrip/"/>-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans Condensed:300italic,300,700" rel="stylesheet" type="text/css">

    <!--  Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.min.css') ?>
    <?= $this->Html->css('map-icons.min.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->css('ng-img-crop.css') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?= $this->Html->script('jquery.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')); ?>
<body ng-app="myApp" ng-controller="MainCtrl" ng-init="currentUserId='<?= $userSession['id'] ?>'">
    <div id="wrap">
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
                    <div class="navigation navbar-brand">
                        <?= $this->Html->getCrumbs(' > '); ?>
                        <?php if(!$userSession): ?>
                            <?= $this->Html->link(__('ShareMyTrip'), ['controller' => '/']) ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php if($userSession): ?>
                        <span class="hidden" id="userId" data-id="<?= $userSession['id'] ?>"></span>
                        <ul class="nav navbar-nav navbar-right">
                            <li><?= $this->Html->link($userSession['first_name']." ".$userSession['last_name'], [
                                'controller' => 'Users',
                                    'action' => 'edit', $userSession['id']
                                ]) ?></li>
<!--                            <li><a data-target="#editUserModal" data-toggle="modal">--><?//=$userSession['first_name']?><!-- --><?//=$userSession['last_name']?><!--</a></li>-->
                            <?
                            if ($userSession['photo']) {
                                echo $this->Html->image('/' . $userSession['photo_dir'] . '/' . $userSession['photo'], [
                                    'class' => 'avatar',
                                    "alt" => $userSession['first_name'] . ' ' . $userSession['last_name'],
                                    "url" => ['controller' => 'Users', 'action' => 'edit', $userSession['id']]
                                ]);
                            }
                            ?>
                        </ul>
                    <?php endif; ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
            <?= $this->Flash->render() ?>
        </nav>

        <?= $this->fetch('content') ?>
    </div>
    <div class="navbar navbar-default navbar-fixed-bottom">© <a href="http://wwww.lionelegger.com">lionelegger.com</a></div>

    <!-- AngularJS -->
    <?= $this->Html->script('angular.min.js') ?>
    <?= $this->Html->script('angular-route.min.js') ?>
    <?= $this->Html->script('moment.min.js') ?>
    <!-- Latest compiled and minified Boostrap JavaScript -->
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('bootstrap-datetimepicker.min.js') ?>
    <?= $this->Html->script('app.js') ?>
    <?= $this->Html->script('controllers.js') ?>
    <?= $this->Html->script('ng-img-crop.js') ?>

    <script>window.onload = initialize;</script>


<!--    --><?php //if($userSession): ?>
<!--        <div class="modal fade" tabindex="-1" role="dialog" id="editUserModal">-->
<!--            <div class="modal-dialog">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                        <h4 class="modal-title">Edit my details</h4>-->
<!--                    </div>-->
<!--                    <form method="post" accept-charset="utf-8" _lpchecked="1" enctype="multipart/form-data">-->
<!--                        <div class="modal-body">-->
<!--                            <div class="form-group">-->
<!--                                <label for="email">Email</label>-->
<!--                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="currentUser.email">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="password">Password</label>-->
<!--                                <input type="password" name="password" class="form-control" id="password" placeholder="Password (leave empty if you don't want to modify your password)" ng-model="currentUser.password">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="name">First Name</label>-->
<!--                                <input name="name" type="text" class="form-control" id="first_name" placeholder="First name" ng-model="currentUser.first_name">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="name">First Name</label>-->
<!--                                <input name="name" type="text" class="form-control" id="last_name" placeholder="Last name" ng-model="currentUser.last_name">-->
<!--                            </div>
<!--                            <div>Select an image file: <input type="file" id="fileInput" ng-file="currentUser.photo"/></div>-->
<!--                            <div class="cropArea">-->
<!--                                <img-crop image="myImage" result-image="myCroppedImage"></img-crop>-->
<!--                            </div>-->
<!--                            <div>Cropped Image:</div>-->
<!--                            <div><img id="avatar" ng-model="currentUser.photo" ng-src="{{myCroppedImage}}" /></div>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
<!--                            <button type="submit" class="btn btn-primary" id="editUser" ng-click="editUser()" data-dismiss="modal">Save</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    --><?php //endif; ?>

</body>
</html>
