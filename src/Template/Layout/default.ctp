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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans Condensed:300italic,300,700" rel="stylesheet" type="text/css">

    <!--  Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.min.css') ?>
    <?= $this->Html->css('map-icons.min.css') ?>
    <?= $this->Html->css('custom.css') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?= $this->Html->script('jquery.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')); ?>
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
                    <form class="navbar-form navbar-right">
                        <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], array('class' => 'btn btn-default', 'type' => 'button')) ?>
                    </form>
                    <p class="navbar-text navbar-right">Welcome <?= $userSession['first_name'] ?></p>
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        <?= $this->Flash->render() ?>
    </nav>

<!--    <div class="container clearfix">-->
        <?= $this->fetch('content') ?>
<!--    </div>-->
    <footer>
        © <a href="http://wwww.lionelegger.com">lionelegger.com</a>
    </footer>

    <!-- AngularJS -->
    <?= $this->Html->script('angular.min.js') ?>
    <?= $this->Html->script('angular-route.min.js') ?>
    <?= $this->Html->script('moment.min.js') ?>
    <!-- Latest compiled and minified Boostrap JavaScript -->
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('bootstrap-datetimepicker.min.js') ?>
    <?= $this->Html->script('app.js') ?>
    <?= $this->Html->script('controllers.js') ?>

    <script>window.onload = initialize;</script>
</body>
</html>
