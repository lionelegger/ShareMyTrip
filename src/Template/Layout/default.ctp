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
                <?php if($userSession): ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php endif; ?>

                <div class="navbar-header">
                    <!-- TODO: Make a logo and add the logo image below -->
                    <!-- <a class="navbar-brand"><img alt="Share my trip" src="webroot/img/briefcase.png" height="20" width="20"></a> -->
                    <div class="navigation navbar-brand">Share my trip</div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php if($userSession): ?>
                        <span class="hidden" id="userId" data-id="<?= $userSession['id'] ?>"></span>

                        <?php if ($this->fetch('navigation')): ?>
                            <ul class="nav navbar-nav">
                                <?= $this->fetch('navigation') ?>
                            </ul>
                        <?php endif; ?>

                        <ul class="nav navbar-nav navbar-right hidden-xs">
                            <li><?= $this->Html->link($userSession['first_name']." ".$userSession['last_name'], [
                                'controller' => 'Users',
                                    'action' => 'edit', $userSession['id']
                                ]) ?></li>
                            <?
                            if ($userSession['photo']) {
                                echo $this->Html->image('/' . $userSession['photo_dir'] . '/' . $userSession['photo'], [
                                    'class' => 'avatar-img',
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
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container clearfix">
            <div class="pull-left">
                <?= $this->Html->getCrumbs(' > '); ?>
            </div>
            <div class="pull-right">
                © <a href="http://wwww.lionelegger.com">lionelegger.com</a>
            </div>
        </div>
    </div>

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

</body>
</html>
